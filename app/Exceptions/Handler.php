<?php

namespace App\Exceptions;

use App\Traits\APIResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use App\Traits\MessageReturn;
use Illuminate\Support\Facades\Log;


class Handler extends ExceptionHandler
{
    use APIResponse;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (AuthenticationException $e,$request) {
            if ($request->expectsJson) {
                return $this->responseError('unauthenticated', Response::HTTP_UNAUTHORIZED);
            }
        });

        $this->renderable(function (QueryException $e,$request) {
            if ($request->expectsJson) {
                return $this->responseError('error_query', Response::HTTP_BAD_REQUEST);
            }
        });

        $this->renderable(function (NotFoundHttpException $e,$request) {
            if ($request->expectsJson) {
                return $this->responseError('not_found', Response::HTTP_NOT_FOUND);
            }
        });

        $this->renderable(function (ModelNotFoundException $e,$request) {
            if ($request->expectsJson) {
                return $this->responseError('not_found', Response::HTTP_NOT_FOUND);
            }
        });

        $this->renderable(function (ValidationException $e,$request) {
            if ($request->expectsJson) {
                $errors = MessageReturn::convertArrayMessage($e->errors());
                return $this->responseError($errors, Response::HTTP_UNPROCESSABLE_ENTITY); 
            }
        });

        $this->renderable(function (Throwable $e,$request) {
            if ($request->expectsJson()) {
                Log::debug(now() . ' > ' . $e->getMessage() . ' > '. \request()->url());
                return $this->responseError('process_failed', Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }); 

    }
}
