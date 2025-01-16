@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center mb-4">Termos de Utilização</h3>

                <!-- Início dos Termos de Uso (container com scroll) -->
                <div 
                    id="termsContainer" 
                    class="mb-4" 
                    style="max-height: 400px; overflow-y: auto; border: 1px solid #ccc; padding: 15px;"
                >
                <h3><strong>TERMOS DE USO - REDE SOCIAL BEM-TE-VI</strong></h3>
    <p>
        Bem-vindo(a) à rede social <strong>Bem-te-vi</strong>. A seguir, apresentamos os Termos de Uso que
        regem o acesso e a utilização de nossos serviços. Ao utilizar a Plataforma, você declara ter lido e
        concordado com todas as disposições aqui descritas.
    </p>

    <h4>1. OBJETIVO E PROPÓSITO DA PLATAFORMA</h4>
    <p>
        <strong>1.1.</strong> A Plataforma tem como objetivo oferecer um ambiente digital para publicação de
        mensagens curtas, visando promover um convívio respeitoso e positivo entre os Usuários.<br>
        <strong>1.2.</strong> Para garantir um ambiente seguro, a Plataforma utiliza a rede neural
        <strong>BERTimbau</strong>, treinada para detectar e barrar postagens contendo linguagem ofensiva ou
        discurso de ódio.
    </p>

    <h4>2. CADASTRO E USO DA PLATAFORMA</h4>
    <p>
        <strong>2.1.</strong> Para acessar a Plataforma, é necessário criar uma conta, fornecendo informações verídicas e completas.<br>
        <strong>2.2.</strong> O Usuário é responsável pela segurança de suas credenciais de acesso e por todas as ações realizadas em sua conta.<br>
        <strong>2.3.</strong> O uso de identidades falsas, contas fraudulentas ou qualquer tentativa de acessar contas de terceiros resultará no encerramento da conta e, se aplicável, em medidas legais.
    </p>

    <h4>3. CONTEÚDO E REGRAS DE POSTAGEM</h4>
    <p>
        <strong>3.1.</strong> O Usuário pode criar postagens em texto, respeitando as regras de convivência da Plataforma e as leis aplicáveis.<br>
        <strong>3.2. Proibições de Conteúdo:</strong> É proibido publicar postagens que incluam:
    </p>
    <ul>
        <li>Discurso de ódio (por exemplo, racismo, homofobia, intolerância religiosa).</li>
        <li>Conteúdo explícito, ofensivo ou impróprio.</li>
        <li>Assédio ou incitação à violência.</li>
    </ul>
    <p>
        <strong>3.3.</strong> Todas as postagens são analisadas automaticamente pela BERTimbau. Caso a postagem seja classificada como ofensiva, o Usuário será notificado imediatamente, e a postagem será barrada.<br>
        <strong>3.4.</strong> Usuários reincidentes em postagens proibidas poderão ter suas contas suspensas ou encerradas.
    </p>

    <h4>4. LIMITAÇÕES E RESPONSABILIDADE DO USUÁRIO</h4>
    <p>
        <strong>4.1.</strong> O Usuário compromete-se a:
    </p>
    <ul>
        <li>Utilizar a Plataforma de maneira ética e responsável.</li>
        <li>Respeitar as regras de postagem e convívio estabelecidas nestes Termos.</li>
    </ul>
    <p>
        <strong>4.2.</strong> O Usuário é responsável pelo conteúdo que publica e por eventuais violações legais decorrentes de suas ações.
    </p>

    <h4>5. MODERAÇÃO E FUNCIONAMENTO DA PLATAFORMA</h4>
    <p>
        <strong>5.1.</strong> A moderação de conteúdo é realizada automaticamente pela rede neural BERTimbau.<br>
        <strong>5.2.</strong> A Plataforma não permite edição de postagens. Usuários podem excluir suas postagens diretamente.<br>
        <strong>5.3.</strong> Não há suporte a curtidas ou comentários em postagens.
    </p>

    <h4>6. PRIVACIDADE E DADOS PESSOAIS</h4>
    <p>
        <strong>6.1.</strong> Os dados do Usuário serão tratados em conformidade com a legislação vigente e conforme descrito na nossa <a href="{{ route('privacidade') }}" target="_blank">Política de Privacidade</a>.<br>
        <strong>6.2.</strong> Informações fornecidas durante o uso da Plataforma, como postagens e interações, são armazenadas para fins de operação e segurança do sistema.
    </p>

    <h4>7. SUSPENSÃO E ENCERRAMENTO DE CONTAS</h4>
    <p>
        O Usuário pode solicitar o encerramento de sua conta, mas algumas informações poderão ser retidas para cumprir obrigações legais.
    </p>

    <h4>8. ALTERAÇÕES NOS TERMOS DE USO</h4>
    <p>
        <strong>8.1.</strong> A Plataforma reserva-se o direito de atualizar estes Termos para refletir mudanças no serviço ou na legislação aplicável.<br>
        <strong>8.2.</strong> O Usuário será informado sobre alterações significativas, e o uso continuado dos serviços após tais mudanças configurará aceitação dos novos Termos.
    </p>

    <h4>9. DISPOSIÇÕES GERAIS</h4>
    <p>
        <strong>9.1.</strong> A eventual invalidade de qualquer cláusula destes Termos não prejudicará a validade das demais disposições.<br>
        <strong>9.2.</strong> Estes Termos são regidos pela legislação brasileira, sendo eleito o foro da
        Comarca de Ituiutaba para dirimir quaisquer controvérsias.
    </p>

    <p><strong>Última atualização:</strong> 15/01/2025</p>

    <p>
        Ao continuar utilizando a Plataforma, o Usuário declara ter lido, compreendido e aceitado todos os Termos aqui descritos. Caso não concorde com algum item, recomenda-se a interrupção imediata do uso da Plataforma.
    </p>

</div>
                <!-- Fim dos Termos de Uso -->

                <!-- Formulário para Concordar ou Não Concordar -->
                <form action="{{ route('concluirCadastro') }}" method="POST">
                    @csrf
                    <div class="d-flex justify-content-around">
                        <!-- Botão Não Concordo -->
                        <button type="submit" name="concordo" value="nao" class="btn btn-danger">
                            Não Concordo
                        </button>

                        <!-- Botão Concordo (desabilitado inicialmente) -->
                        <button 
                            type="submit" 
                            name="concordo" 
                            value="sim" 
                            class="btn btn-success" 
                            id="agreeBtn" 
                            disabled
                        >
                            Concordo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Script para habilitar o botão quando o usuário chegar ao final do texto --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const termsContainer = document.getElementById('termsContainer');
        const agreeBtn = document.getElementById('agreeBtn');

        termsContainer.addEventListener('scroll', function() {
            // Quando o scroll chegar ao final, habilita o botão de Concordo
            if (termsContainer.scrollTop + termsContainer.clientHeight >= termsContainer.scrollHeight) {
                agreeBtn.disabled = false;
            }
        });
    });
</script>
@endsection
