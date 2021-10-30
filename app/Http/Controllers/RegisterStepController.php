<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class RegisterStepController extends Controller
{
    public function firstStepview()
    {

    }

    public function firstStepstore()
    {
        Cookie::queue('hasDoneFirstStep', true, 60 * 60 * 24 * 365 * 10);
    }
}
