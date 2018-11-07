<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Newsletter;
use Illuminate\Http\Request;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //
    public function test(Request $request)
    {
    
    	Log::info($request->post(),['test']);
    }
}
