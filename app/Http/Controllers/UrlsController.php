<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\AddNewUrlAction;
use App\Actions\AddNewUrlRequest;
use App\Actions\DeleteUserUrlAction;
use App\Actions\GetRedirectCountAction;
use App\Actions\GetUserUrlListAction;
use App\Http\Requests\AddNewUrlHttpRequest;
use App\Http\Resources\UrlResource;
use App\Http\Responses\ApiResponse;
use Illuminate\Database\Eloquent\Collection;

class UrlsController extends Controller
{
    private $getUserUrlListAction;
    private $getRedirectCountAction;
    private $addNewUrlAction;
    private $deleteUserUrlAction;

    public function __construct(
        GetUserUrlListAction $getUserUrlListAction,
        GetRedirectCountAction $getRedirectCountAction,
        AddNewUrlAction $addNewUrlAction,
        DeleteUserUrlAction $deleteUserUrlAction
    ) {
        $this->getUserUrlListAction = $getUserUrlListAction;
        $this->getRedirectCountAction = $getRedirectCountAction;
        $this->addNewUrlAction = $addNewUrlAction;
        $this->deleteUserUrlAction = $deleteUserUrlAction;
    }

    public function all(): Collection
    {
        return $this->getUserUrlListAction->execute();
    }

    public function redirectCount(int $id): int
    {
        return $this->getRedirectCountAction->execute($id);
    }

    public function save(AddNewUrlHttpRequest $request): ApiResponse
    {
        $response = $this->addNewUrlAction->execute(AddNewUrlRequest::fromRequest($request));

        return ApiResponse::success(new UrlResource($response));
    }

    public function delete(int $id): ApiResponse
    {
        $this->deleteUserUrlAction->execute($id);

        return ApiResponse::deleted();
    }
}