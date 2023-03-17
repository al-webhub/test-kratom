<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Browsershot\Browsershot;

class MakeScreenshots extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'screenshots:make';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make Facebook and Instagram pages screenshots';

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
     * @return mixed
     */
    public function handle()
    {
        Browsershot::url('https://www.facebook.com/kratomhelp')
            ->noSandbox()
            // ->device('iPad Pro')
            // ->windowSize(1366, 1024)
            // ->landscape(true)
            // ->type('input[type=email]', 'kratomsocial@gmail.com')
            // ->type('input[type=password]', 'ss22rr44')
            // ->click('button[name=login]')
            // ->delay(1000)
            ->save(public_path('img/fb_tablet.png'));

        Browsershot::url('https://www.facebook.com/kratomhelp')
            ->noSandbox()
            ->device('iPhone X')
            ->windowSize(375, 812)
            // ->type('input#email', 'kratomsocial@gmail.com')
            // ->type('input#pass', 'ss22rr44')
            // ->click('button[name=login]')
            // ->delay(1000)
            ->save(public_path('img/fb_mobile.png'));
    }
}
