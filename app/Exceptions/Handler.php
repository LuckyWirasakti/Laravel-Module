<?php

namespace Smartedu\Exceptions;

use Exception;
use ErrorException;
use Illuminate\Database\QueryException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

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
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        // if($exception instanceof MethodNotAllowedHttpException) {
        //     return $this->response($exception);
        // } else if($exception instanceof NotFoundHttpException){
        //     return $this->response($exception);
        // } else if ($exception instanceof UnauthorizedHttpException) {
        //     $preException = $exception->getPrevious();
        //     if ($preException instanceof
        //         TokenExpiredException) {
        //         return $this->response($preException);
        //     } else if ($preException instanceof
        //         TokenInvalidException) {
        //         return $this->response($preException);
        //     } else if ($preException instanceof
        //         TokenBlacklistedException) {
        //         return $this->response($preException);;
        //     } else if ($exception->getMessage() === 'Token not provided') {
        //         return $this->response($preException);
        //     }
        // } else if($exception instanceof HttpException){
        //     return $this->response($exception);
        // } else if($exception instanceof QueryException){
        //     return $this->response($exception);
        // } else if($exception instanceof AccessDeniedHttpException){
        //     return $this->response($exception);
        // } else if($exception instanceof ErrorException){
        //     return $this->response($exception);
        // }

        return parent::render($request, $exception);
    }

    private function response($exception)
    {
        if (method_exists($exception, 'getStatusCode')) {
            $statusCode = $exception->getStatusCode();
        } else {
            $statusCode = 500;
        }

        switch ($statusCode) {
            case 401:
                $response['message'] = 'Unauthorized';
                break;
            case 403:
                $response['message'] = 'Forbidden';
                break;
            case 404:
                $response['message'] = 'Not Found';
                break;
            case 405:
                $response['message'] = 'Method Not Allowed';
                break;
            case 422:
                $response['message'] = $exception->original['message'];
                $response['errors'] = $exception->original['errors'];
                break;
            default:
                $response['message'] = ($statusCode == 500) ? 'Whoops, looks like something went wrong' : $exception->getMessage();
                break;
        }

        if (config('app.debug')) {
            $response['trace'] = $exception->getTrace();
            $response['code'] = $exception->getCode();
        }

        $response['status'] = $statusCode;

        return response()->json([
            'data' => $response
        ], $statusCode);
    }
}
