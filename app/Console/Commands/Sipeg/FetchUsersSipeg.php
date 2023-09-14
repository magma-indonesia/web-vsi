<?php

namespace App\Console\Commands\Sipeg;

use Illuminate\Console\Command;

class FetchUsersSipeg extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sipeg:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mendapatkan data pegawai dari API SIPEG';

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
