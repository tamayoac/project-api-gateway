<?php

namespace App\Exceptions;

use App\Traits\ApiResponser;
use ErrorException;
use Throwable;
use Illuminate\Http\Response;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    use ApiResponser;
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


        $this->reportable(function (Throwable $e) {
        });
        $this->renderable(function (ValidationException $exception, $request) {
            $message = $exception->validator->getMessageBag();

            if ($request->wantsJson()) {
                return $this->errorResponse($message, Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            return redirect()->back()->withErrors($message);
        });

        $this->renderable(function (NotFoundHttpException $e, $request) {
            dd("2");
            return response()->json(
                "tst"
            );
        });
        $this->renderable(function (AuthenticationException $exception, $request) {
            if ($request->wantsJson()) {
                return $this->errorResponse($exception->getMessage(), Response::HTTP_UNAUTHORIZED);
            }
            return redirect()->back()->withErrors($exception->getMessage());
        });
        $this->renderable(function (GuzzleException $exception, $request) {

            $code = $exception->getCode();

            $message = json_decode($exception->getResponse()->getBody()->getContents());

            return $this->errorResponse($message, $code);
        });
        $this->renderable(function (BadResponseException $exception, $request) {

            return $this->errorResponse($exception->getMessage(), $exception->getStatusCode());
        });
        $this->renderable(function (ClientException $exception, $request) {
            dd("5");
            $message = $exception->getResponse()->getBody();

            $code = $exception->getCode();

            return $this->errorResponse($message, $code);
        });
        $this->renderable(function (HttpException $exception, $request) {

            if ($request->wantsJson()) {
                $message = $exception->getMessage();
                $code = Response::$statusTexts[$message];
                return $this->errorResponse($message, $code);
            }
            return parent::render($request, $exception);
        });
        $this->renderable(function (ModelNotFoundException $exception, $request) {
            dd("7");
            $model = strtolower(class_basename($exception->getModel()));

            return $this->errorResponse("Does not exist any instance of {$model} with the given id", $exception->getStatusCode());
        });
    }
}
