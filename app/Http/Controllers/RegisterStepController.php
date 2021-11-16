<?php

namespace App\Http\Controllers;

use App\Http\Requests\FirstStepRequest;
use App\Traits\Stepable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class RegisterStepController extends Controller
{
    use Stepable;

    public function firstStepview()
    {
        return view('app.auth.steps.first');
    }

    public function firstStepstore(FirstStepRequest $request)
    {
        $data = $request->validated();

        $this->storeFirstStep($request);

        return redirect()->route('step.second');
    }

    public function secondStepview()
    {

        return view('app.auth.steps.second');
    }
}
