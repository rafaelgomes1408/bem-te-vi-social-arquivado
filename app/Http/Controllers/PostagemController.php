<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postagem;
use App\Models\Denuncia;
use Illuminate\Support\Facades\Auth;

class PostagemController extends Controller
{
    public function create(Request $request)
{
    $request->validate([
        'conteudo' => 'required|max:250', // Limite de 250 caracteres
    ]);

    \Log::info('Iniciando criação da postagem.', ['usuario' => Auth::user()->email]);

    $resultadoAnalise = $this->analisarTexto($request->input('conteudo'));

    \Log::info('Saída bruta do script Python.', ['resultado' => $resultadoAnalise]);

    // Verificar se a análise retornou o esperado
    if (
        isset($resultadoAnalise['status']) &&
        $resultadoAnalise['status'] === 'success' &&
        isset($resultadoAnalise['result'][0]['label'])
    ) {
        $label = $resultadoAnalise['result'][0]['label'];

        if ($label === 'Ofensivo') {
            \Log::warning('Postagem considerada ofensiva.', ['resultado' => $resultadoAnalise]);
            return redirect()->route('home')->withErrors([
                'custom_error' => 'Sua postagem viola os termos da comunidade, poste outra mensagem.',
            ]);
        }

        \Log::info('Postagem aprovada pela análise.', ['resultado' => $resultadoAnalise]);
    } else {
        // Log de erro detalhado se o script Python não retornar o esperado
        \Log::error('Erro na análise de texto. Saída inesperada do script Python.', ['resultado' => $resultadoAnalise]);
        return redirect()->route('home')->withErrors([
            'custom_error' => 'Houve um erro ao analisar sua postagem. Tente novamente mais tarde.',
        ]);
    }

    // Criar a postagem no banco de dados
    Postagem::create([
        'conteudo' => $request->input('conteudo'),
        'dataHora' => now(),
        'idUsuario' => Auth::user()->idUsuario,
    ]);

    \Log::info('Postagem criada com sucesso.');
    return redirect()->route('home')->with('success', 'Postagem criada com sucesso.');
}


    public function edit(Request $request, $id)
    {
        $request->validate([
            'conteudo' => 'required|max:250',
        ]);

        $postagem = Postagem::findOrFail($id);

        if ($postagem->idUsuario !== Auth::user()->idUsuario) {
            \Log::warning('Usuário tentou editar postagem que não pertence a ele.', [
                'usuario' => Auth::user()->email,
                'postagem_id' => $id,
            ]);
            return redirect()->route('feed')->with('error', 'Você não tem permissão para editar esta postagem.');
        }

        \Log::info('Iniciando edição da postagem.', ['postagem_id' => $id, 'usuario' => Auth::user()->email]);

        $resultadoAnalise = $this->analisarTexto($request->input('conteudo'));

        \Log::info('Saída bruta do script Python.', ['resultado' => $resultadoAnalise]);

        if (
            isset($resultadoAnalise['status']) &&
            $resultadoAnalise['status'] === 'success' &&
            isset($resultadoAnalise['result'][0]['label'])
        ) {
            $label = $resultadoAnalise['result'][0]['label'];

            if ($label === 'Ofensivo') {
                \Log::warning('Postagem considerada ofensiva durante a edição.', ['resultado' => $resultadoAnalise]);
                return redirect()->back()->withErrors([
                    'custom_error' => 'Sua postagem contém conteúdo ofensivo e não foi atualizada.',
                ]);
            }

            \Log::info('Postagem aprovada pela análise.', ['resultado' => $resultadoAnalise]);
        } else {
            \Log::error('Erro na análise de texto. Saída inesperada do script Python.', ['resultado' => $resultadoAnalise]);
            return redirect()->back()->withErrors([
                'custom_error' => 'Erro ao analisar o conteúdo. Tente novamente mais tarde.',
            ]);
        }

        $postagem->update([
            'conteudo' => $request->input('conteudo'),
        ]);

        \Log::info('Postagem editada com sucesso.', ['postagem_id' => $id]);
        return redirect()->route('feed')->with('success', 'Postagem editada com sucesso.');
    }

    public function delete($id)
    {
        $postagem = Postagem::findOrFail($id);

        if ($postagem->idUsuario !== auth()->user()->idUsuario) {
            return redirect()->route('home')->with('error', 'Você não tem permissão para excluir esta postagem.');
        }

        $postagem->delete();

        return redirect()->route('home')->with('success', 'Postagem excluída com sucesso.');
    }

    public function denunciar(Request $request, $id)
    {
        $request->validate([
            'categoria' => 'required|string',
            'descricao' => 'nullable|string|max:250',
        ]);

        \Log::info('Iniciando o processo de denúncia.');

        $postagem = Postagem::findOrFail($id);
        $usuario = Auth::user();

        \Log::info('Dados da denúncia recebidos.', [
            'idPostagem' => $postagem->idPostagem,
            'idUsuario' => $usuario->idUsuario,
            'categoria' => $request->input('categoria'),
            'descricao' => $request->input('descricao'),
        ]);

        try {
            Denuncia::create([
                'idPostagem' => $postagem->idPostagem,
                'idUsuario' => $usuario->idUsuario,
                'categoria' => $request->input('categoria'),
                'descricao' => $request->input('descricao'),
            ]);

            \Log::info('Denúncia registrada com sucesso.');
            return redirect()->back()->with('success', 'Denúncia registrada com sucesso.');
        } catch (\Exception $e) {
            \Log::error('Erro ao registrar a denúncia.', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors(['message' => 'Ocorreu um erro ao registrar sua denúncia. Tente novamente mais tarde.']);
        }
    }

    private function analisarTexto(string $conteudo): array
{
    #$pythonPath = 'C:\\Users\\rafae\\AppData\\Local\\Programs\\Python\\Python313\\python.exe';
    $pythonPath = 'C:\\bertimbau\\venv\\Scripts\\python.exe';
    $scriptPath = 'C:\\bertimbau\\scripts\\analyze.py';

    $command = escapeshellcmd("$pythonPath \"$scriptPath\" \"$conteudo\"");

    \Log::info('Comando executado para análise de texto.', ['command' => $command]);

    // Captura a saída do script Python
    $output = mb_convert_encoding(shell_exec($command), 'UTF-8', 'auto');

    // Garantir que a saída seja tratada como UTF-8
    $output = mb_convert_encoding($output, 'UTF-8', 'UTF-8');

    \Log::info('Saída bruta do script Python.', ['output' => $output]);

    if (empty($output)) {
        \Log::error('Saída do script Python está vazia.');
        return [
            'status' => 'error',
            'message' => 'Erro ao analisar o texto.',
        ];
    }

    $result = json_decode($output, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        \Log::error('Erro ao decodificar JSON retornado pelo script Python.', ['json_error' => json_last_error_msg()]);
        return [
            'status' => 'error',
            'message' => 'Erro ao analisar o texto.',
        ];
    }

    return $result;
}

}
