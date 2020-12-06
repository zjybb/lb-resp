<?php

namespace Zjybb\Response;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Arr;

class ApiResponse
{
    public function msg(string $msg, array $data = []): \Illuminate\Http\JsonResponse
    {
        return $this->responseJson($data, BaseCode::MSG_ERROR, BaseCode::HTTP_OK, $msg);
    }

    public function success(string $msg = '', array $data = []): \Illuminate\Http\JsonResponse
    {
        return $this->responseJson($data, BaseCode::SUCCESS, BaseCode::HTTP_OK, $msg);
    }

    public function error(int $error, string $msg = '', array $data = []): \Illuminate\Http\JsonResponse
    {
        return $this->responseJson($data, $error, BaseCode::HTTP_OK, $msg);
    }

    public function unauthorized(): \Illuminate\Http\JsonResponse
    {
        return $this->responseJson([], BaseCode::UNAUTHORIZED, BaseCode::HTTP_UNAUTHORIZED);
    }

    public function noPermission(): \Illuminate\Http\JsonResponse
    {
        return $this->responseJson([], BaseCode::PERMISSION_DENIED);
    }

    public function responseJson(
        $data,
        $errCode = BaseCode::SUCCESS,
        $httpCode = BaseCode::HTTP_OK,
        $msg = '',
        array $headers = [],
        $option = 0
    ): \Illuminate\Http\JsonResponse {
        return response()->json($this->format($data, $errCode, $msg), $httpCode, $headers, $option);
    }

    protected function format($data, $errCode, $msg = ''): array
    {
        return [
            'traceId' => request()->server->get('X-REQUEST-ID', ''),
            'code' => $errCode,
            'errMsg' => blank($msg) ? trans('lb-resp::code.' . $errCode) : $msg,
            'data' => $data ?: (object)$data
        ];
    }

    public function resource($data)
    {
        if (!$data instanceof JsonResource) {
            return $this->responseJson($data);
        }

        if ($data instanceof ResourceCollection && ($data->resource instanceof AbstractPaginator)) {
            return $this->formatPaginatedResourceResponse($data);
        }

        return tap(
            $this->responseJson($this->parseDataFrom($data)),
            function ($response) use ($data) {
                $response->original = $data->resource;

                $data->withResponse(request(), $response);
            }
        );
    }

    protected function formatPaginatedResourceResponse(JsonResource $resource): \Illuminate\Support\HigherOrderTapProxy
    {
        $paginated = $resource->resource->toArray();

        $paginationInformation = [
            'meta' => [
                'pagination' => [
                    'total' => $paginated['total'] ?? null,
                    'count' => $paginated['to'] ?? null,
                    'per_page' => $paginated['per_page'] ?? null,
                    'current_page' => $paginated['current_page'] ?? null,
                    'total_pages' => $paginated['last_page'] ?? null,
                    'links' => [
                        'previous' => $paginated['prev'] ?? null,
                        'next' => $paginated['next_page_url'] ?? null,
                    ],
                ],
            ],
        ];

        $data = array_merge_recursive(['data' => $this->parseDataFrom($resource)], $paginationInformation);

        return tap(
            $this->responseJson($data),
            function ($response) use ($resource) {
                $response->original = $resource->resource->map(
                    function ($item) {
                        return is_array($item) ? Arr::get($item, 'resource') : $item->resource;
                    }
                );

                $resource->withResponse(request(), $response);
            }
        );
    }

    protected function parseDataFrom(JsonResource $data): array
    {
        return array_merge_recursive($data->resolve(request()), $data->with(request()), $data->additional);
    }
}