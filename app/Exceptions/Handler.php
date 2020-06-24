<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
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
     * @param  \Exception $exception
     * @return void
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
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($request->is('api', 'api/*')) {
            if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
                return response(['error' => 'Unauthenticated'], 401);
            }

            if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return response(['error' => 'Not Found'], 404);
            }

            if ($exception instanceof \Illuminate\Validation\ValidationException) {
                return response([
                    'error' => 'Validation',
                    'validation_fields' => $exception->validator->errors(),
                ], 422);
            }

            if (method_exists($exception, 'getStatusCode')) {
                if ($exception->getStatusCode() === 404) {
                    return response(['error' => 'Not Found'], 404);
                }

                if ($exception->getStatusCode() === 403) {
                    return response(['error' => 'Forbidden'], 403);
                }
            }

            return response([
                'error' => 'Internal Error',
                'message' => $exception->getMessage(),
                'code' => $exception->getCode(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'trace' => $exception->getTrace(),
            ]);

            return parent::render($request, $exception);
        }

        if ($exception instanceof TokenExpiredException) {
            header("Set-Cookie: api-token=; Domain=" . env('SESSION_DOMAIN') . "; EXPIRES 1;path=/");
            return redirect('/');
            //return response()->json(['token_expired'], $exception->getStatusCode());
        } else if ($exception instanceof TokenInvalidException) {
            header("Set-Cookie: api-token=; Domain=" . env('SESSION_DOMAIN') . "; EXPIRES 1;path=/");
            return redirect('/');
            //return response()->json(['token_invalid'], $exception->getStatusCode());
        }

        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Illuminate\Auth\AuthenticationException $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        return redirect()->guest(route('login'));
    }
}
