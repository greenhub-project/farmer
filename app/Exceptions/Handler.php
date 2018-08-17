<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param \Exception $exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception               $exception
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if (strpos($request->getUri(), '/api/v') !== false) {
            if ($exception instanceof NotFoundHttpException) {
                return response()->json([
                    'message' => 'Requested route is invalid.',
                ], 400);
            } elseif ($exception instanceof AuthenticationException) {
                return response()->json([
                    'message' => 'Unable to authenticate request, check if your access token is correct.',
                ], 401);
            } elseif ($exception instanceof HttpException) {
                if ($exception->getMessage() == 'Too Many Attempts.') {
                    return response()->json([
                        'message' => "The rate limit has been exceeded, please wait before sending more requests",
                    ], 429);
                } else {
                    //Maybe this should be logged?
                    return response()->json([
                        'message' => "Internal server error",
                    ], 500);
                }
            } elseif ($exception instanceof ModelNotFoundException) {
                //This should be revised if routes are changed
                $pathArray = explode("/", $request->getUri());
                $objectId = explode("?", $pathArray[6])[0];
 
                return response()->json([
                    'message' => 'There is no object with ' . $objectId . ' in ' . $pathArray[5],
                ], 404);
            } else{
                \Log::info($exception);
                return response()->json([
                    'message' => 'Interval server error',
                ], 500);
            }
        }
        else{
            return parent::render($request, $exception);
        }
        
    }
}
