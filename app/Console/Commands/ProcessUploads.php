<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Farmer\Models\Upload;

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
        $uploads = Upload::oldest()->take($this->arguments('bag'))->get();

        $uploads->each(function ($upload) {
            dispatch(new ProcessFailedUpload($upload));
        });
    }
}
