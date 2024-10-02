<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    public function unauthenticated($request, \Illuminate\Auth\AuthenticationException $exception)
{
    return response()->json([
        'message' => 'You are not authenticated.',
        'code' => 401,
        'status'=>'error',
    ], 401);
}

 // Render method for handling all exceptions as JSON


 // Get the appropriate status code based on the exception type
 protected function getStatusCode(Throwable $exception)
 {
     // Return 500 if the exception does not provide a specific status code
     return method_exists($exception, 'getStatusCode')
         ? $exception->getCode()
         : 500;
 }
}
