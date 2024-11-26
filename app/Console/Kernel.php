<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define os comandos Artisan disponíveis na aplicação.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\DeleteInactiveUsers::class, // Registra o comando para excluir usuários inativos
    ];

    /**
     * Registra agendamentos de comandos.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Configura o agendamento do comando para rodar diariamente
        $schedule->command('usuarios:delete-inactive')->daily();
    }

    /**
     * Registra comandos Artisan na aplicação.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands'); // Carrega automaticamente comandos da pasta "Commands"

        require base_path('routes/console.php'); // Carrega comandos adicionais a partir do arquivo de rotas
    }
}
