<?php

declare(strict_types=1);

namespace App\Actions;

use App\Repositories\UrlRepository;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class DeleteUserUrlAction
{
    private $urlRepository;

    public function __construct(UrlRepository $urlRepository)
    {
        $this->urlRepository = $urlRepository;
    }

    public function execute(int $id): void
    {
        try {
            $url = $this->urlRepository->getUrlById($id);
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }

        if ($url->user_id !== Auth::id()) {
            throw new AuthenticationException();
        }

        $url->delete();
    }
}