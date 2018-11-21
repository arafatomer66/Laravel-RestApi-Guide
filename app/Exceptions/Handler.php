<?php

namespace App\Exceptions;




use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Traits\ApiResponser ;

class Handler extends ExceptionHandler
{
    use ApiResponser ;
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

        if($exception instanceof ValidationException){
            return $this->convertValidationExceptionToResponse($exception,$request);
        }
        return parent::render($request, $exception);
    }

     /**
     * Create a response object from the given validation exception.
     *
     * @param  \Illuminate\Validation\ValidationException  $e
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    // protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    // {
    //     if ($e->response) {
    //         return $e->response;
    //     }

    //     return $request->expectsJson()
    //                 ? $this->invalidJson($request, $e)
    //                 : $this->invalid($request, $e);

    //     // $errors = $e->validator->errors()->getMessages();

    //     // return $this->errorResponse($errors,422);
    // }

    // protected function invalidJson($request, ValidationException $exception)
    // {
    //     return response()->json([
    //         'message' => $exception->getMessage(),
    //         'errors' => $exception->errors(),
    //     ], $exception->status);
    // }

    // protected function invalid($request, ValidationException $exception)
    // {
    //     return redirect($exception->redirectTo ?? url()->previous())
    //                 ->withInput($request->except($this->dontFlash))
    //                 ->withErrors($exception->errors(), $exception->errorBag);
    // }
}
