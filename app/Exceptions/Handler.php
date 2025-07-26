<?php

namespace App\Exceptions;

use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Throwable;

class Handler extends ExceptionHandler
{
   
    protected $dontReport = [
        //
    ];

    
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function(QueryException $ex) {
            session()->flash('error', trans('backend.parent_has_childs'));
            return redirect()->back();
        });
    }
}
