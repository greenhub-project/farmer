<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ProcessUploads extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'uploads:process {bag}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manually process failed uploads';

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
        $uploads = DB::table('uploads')->take($this->arguments('bag'))->get();
        echo 'Uploads fetched...';

        $uploads->each(function ($upload) {
            dispatch(new ProcessFailedUpload($upload));
            echo 'Dispatched.';
        });
        echo 'Done!';
    }
}
