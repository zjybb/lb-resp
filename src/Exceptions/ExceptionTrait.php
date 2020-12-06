<?php

namespace Zjybb\Response\Exceptions;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Routing\Router;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Throwable;
use Zjybb\Response\Resp;
use Zjybb\Response\BaseCode;

trait ExceptionTrait
{
    protected $notReport = [
        ApiException::class,
        UnauthorizedHttpException::class,
        PermissionException::class,
    ];

    public function render($request, Throwable $e)
    {
        if (method_exists($e, 'render') && $response = $e->render($request)) {
            return Router::toResponse($request, $response);
        } elseif ($e instanceof Responsable) {
            return $e->toResponse($request);
        }

        $e = $this->prepareException($this->mapException($e));

        foreach ($this->renderCallbacks as $renderCallback) {
            if (is_a($e, $this->firstClosureParameterType($renderCallback))) {
                $response = $renderCallback($e, $request);

                if (!is_null($response)) {
                    return $response;
                }
            }
        }

        $msg = $e->getMessage() ?: 'server error';
        $httpCode = BaseCode::HTTP_INTERNAL_SERVER_ERROR;
        $code = $e->getCode() ?: BaseCode::HTTP_INTERNAL_SERVER_ERROR;
        $header = [];

        if ($e instanceof HttpExceptionInterface) {
            $code = $httpCode = $e->getStatusCode();
            $header = $e->getHeaders();
        }

        return Resp::responseJson($this->convertExceptionToArray($e), $code, $httpCode, $msg, $header);
    }

    public function register()
    {
        $this->setValidationDefault();
    }

    public function setValidationDefault()
    {
        $this->renderable(function (ValidationException $exception, $request) {
            return Resp::error(BaseCode::VALIDATION_FAIL, '', $exception->errors());
        });
    }

    protected function shouldntReport(Throwable $e)
    {
        $dontReport = array_merge($this->dontReport, $this->internalDontReport, $this->notReport);

        return !is_null(Arr::first($dontReport, function ($type) use ($e) {
            return $e instanceof $type;
        }));
    }
}
