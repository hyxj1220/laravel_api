<?php

namespace App\Http\Controllers\Client\V1;

use Illuminate\Routing\Controller as FrameController;

class BaseController extends FrameController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//         $this->middleware('auth');
    }
}
