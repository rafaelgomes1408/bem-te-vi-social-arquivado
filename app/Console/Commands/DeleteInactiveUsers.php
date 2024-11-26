<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Usuario;
use Carbon\Carbon;

class DeleteInactiveUsers extends Command
{
    protected $signature = 'usuarios:delete-inactive';
    protected $description = 'Exclui usuários inativos após 30 dias';

    public function handle()
    {
        $usuarios = Usuario::where('is_ativo', false)
            ->where('updated_at', '<', Carbon::now()->subDays(30))
            ->get();

        foreach ($usuarios as $usuario) {
            $usuario->delete();
        }

        $this->info('Usuários inativos excluídos com sucesso.');
    }
}
