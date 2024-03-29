<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
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
        $this->renderable(function (Throwable $exception, $request) {
            $code = 500;

            if ($exception instanceof HttpExceptionInterface) {
                $code = $exception->getStatusCode();
            }

            if ($exception instanceof AppException) {
                $code = $exception->getCode();
            }

            if ($exception instanceof ValidationException) {
                return $this->convertValidationExceptionToResponse($exception, $request);
            }

            $isApiRequests = in_array('api', request()?->route()?->middleware() ?? []);

            if (! $isApiRequests) {
                return $this->prepareResponse(request(), $exception);
            }

            $errorCode = 'errors.generic';

            $data = [];

            if (config('app.debug')) {
                $data = [
                    'original_message' => $exception->getMessage(),
                    'trace' => $exception->getTrace(),
                ];
            }

            return $this->jsonResponse(
                $errorCode,
                $code,
                $data
            );
        });
    }

    private function jsonResponse(string $errorCode, int $httpStatusCode, array $data = [], ?string $message = null): JsonResponse
    {
        $response = [
            'code' => $errorCode,
            'message' => trans($errorCode),
            'data' => $data,
        ];

        return response()->json($response, $httpStatusCode);
    }
}
