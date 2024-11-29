<?php

namespace App\Exceptions;

use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register()
    {

    }
    public function render($request, Throwable $e)
    {
        if ($e instanceof ModelNotFoundException) {
            return response()->json([
                'status' => 'error',
                'message' => 'The requested model was not found.',
            ], 404);
        }
        if($e instanceof NotFoundHttpException){
            return response()->json([
                'status'=>'error',
                'message'=>'The requested route could not be found.'
            ],404);
        }
        if($e instanceof MethodNotAllowedHttpException){
            return response()->json([
                'status'=>'error',
                'message'=>'The Http Method is not Allowed for this route.'
            ],405);
        }
        if($e instanceof AuthenticationException){
            return response()->json([
                'status'=>'error',
                'message'=>'UnAuthenticated.  Please Log in '
            ],401);
        }
        if($e instanceof AccessDeniedHttpException){
            return response()->json([
                'status'=>'error',
                'message'=>'access denied to this resource'
            ],403);
        }
        if($e instanceof ValidationException){
            return response()->json([
                'status'=>'error',
                'message'=>'validation failed',
                'errors'=> $e->validator->errors()->toArray(),
            ],422);
        }
            return response()->json([
                'status'=>'error',
                'message'=>'An unexpected error occurred.',
            ],500);
    }
}
