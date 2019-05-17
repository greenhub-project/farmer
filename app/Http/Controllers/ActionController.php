<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Farmer\Models\Upload;
use Illuminate\Support\Facades\Log;
use App\Jobs\ProcessFailedUpload;
use App\Farmer\Models\Protocol\Device;

class ActionController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
}
