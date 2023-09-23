<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
        $this->renderable(function (ThrottleRequestsException $e) {
            return $this->jsonResponse('errors.rate_limit_exceeded', 429);
        });

        $this->renderable(function (AppException $e) {
            return $this->jsonResponse($e->errorCode, $e->getCode());
        });

        $this->renderable(function (NotFoundHttpException $exception) {
            return $this->jsonResponse('errors.not_found', 404);
        });

        $this->renderable(function (HttpExceptionInterface $e) {
            return $this->jsonResponse('errors.generic', $e->getStatusCode());
        });

        $this->renderable(function (Throwable $exception) {
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
                500,
                $data
            );
        });
    }

    private function jsonResponse(string $errorCode, int $httpStatusCode, array $data = [], string $message = null): JsonResponse
    {
        $response = [
            'code' => $errorCode,
            'message' => trans($errorCode),
            'data' => $data,
        ];

        return response()->json($response, $httpStatusCode);
    }
}
