<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class VercelDeploy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vercel:deploy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Trigger deploy hook';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
      $url = env('VERCEL_DEPLOY_HOOK', null);

      if(!$url) {
        return 0;
      }

      $response = Http::get($url);
      return $response->status();
    }
}
