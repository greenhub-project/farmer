<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
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
        if (app()->bound('sentry') && $this->shouldReport($exception)) {
            app('sentry')->captureException($exception);
        }

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception $exception
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if (!$request->is("api/*")) {
            return parent::report($request, $exception);
        }
        $exceptionClass = get_class($exception);


        switch ($exceptionClass) {
            case NotFoundHttpException::class:
                return response()->json(['message' => 'Requested route was not found.',], 404);
            case AuthenticationException::class:
                return response()->json([
                    'message' => 'Unable to authenticate request, check if your access token is correct.',
                ], 401);
            case HttpException::class:
                if ($exception->getStatusCode() == 429) {
                    return response()->json([
                        'message' => "The rate limit has been exceeded, please wait before sending more requests.",
                    ], 429);
                }
                break;
            case ModelNotFoundException::class:
                return response()->json([
                    'message' => 'Requested object not found in ' . $exception->getModel() . '.',
                ], 404);
            case HttpResponseException::class:
                if ($exception->getStatusCode() == 422) {
                    return response()->json([
                        'message' => 'Error validating requested object.',
                    ], 422);
                }
                break;
        }
        parent::report($exception);
        return response()->json([
            'message' => 'Interval server error.',
        ], 500);
    }
}
