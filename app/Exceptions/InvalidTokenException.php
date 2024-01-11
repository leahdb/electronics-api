<?php

namespace App\Exceptions;

//use App\Http\Responses\Dashboard\GeneralErrorResponse;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class InvalidTokenException extends UnauthorizedHttpException
{
    public function __construct($message = null, \Exception $previous = null, $code = 0)
    {
        parent::__construct('jwt-auth', $message, $previous, $code);
    }

    public function render()
    {
        // return GeneralErrorResponse::new('Invalid Token')
        //     ->type(GeneralErrorResponse::TYPE_AUTH)
        //     ->json();
        return response()->json(['error' => 'Invalid token'], 401);
    }
}


