<?php

namespace App\Console\Commands\Magma;

use Illuminate\Console\Command;

class FetchUsersMagma extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'magma:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mendapatkan data pegawai dari API servis MAGMA';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return 0;
    }
}
