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
            //
        });
        $this->renderable(function (ValidationException $exception, $request) 
        {    
            
            $message = $exception->validator->getMessageBag();
        
            if($request->wantsJson())
            {   
                return $this->errorResponse($message, Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            return redirect()->back()->withErrors($message);
        });
        $this->renderable(function (AuthenticationException $exception, $request) 
        {
            return $this->errorResponse($exception->getMessage(), Response::HTTP_UNAUTHORIZED);
        });
        $this->renderable(function(BadResponseException $exception, $request) {
          
            return $this->errorResponse($exception->getMessage(), $exception->getCode());
        });
        $this->renderable(function (HttpException $exception, $request) {
            
            if($request->wantsJson()) 
            {
                $code = $exception->getStatusCode();
                $message = Response::$statusTexts[$code];
                return $this->errorResponse($message, $code);
            }
            return parent::render($request, $exception);
          
        });
        $this->renderable(function (ModelNotFoundException $exception, $request) {
            $model = strtolower(class_basename($exception->getModel()));
            
            return $this->errorResponse("Does not exist any instance of {$model} with the given id", Response::HTTP_NOT_FOUND);
        });
        
    }
}
