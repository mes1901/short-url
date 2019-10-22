<?php

declare(strict_types=1);

namespace App\Actions;

use App\Repositories\UrlRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class GetUserUrlListAction
{
    private $urlRepository;

    public function __construct(UrlRepository $urlRepository)
    {
        $this->urlRepository = $urlRepository;
    }

    public function execute(): Collection
    {
        $response = $this->urlRepository->getAllByUser(Auth::id());
        $response->map(function ($item) {
            return [
                'id' => $item->id,
                'href' => $item->href,
                'short_href' => $item->short_href,
                'date' => $item->date,
            ];
        });
        return $response;
    }
}