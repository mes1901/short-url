<?php

declare(strict_types=1);

namespace App\Actions;

use App\DataTransformer\UrlValue;
use App\Repositories\UrlRepository;
use App\Url;
use Exception;
use Illuminate\Support\Facades\Auth;

class AddNewUrlAction
{
    private $urlRepository;

    public function __construct(UrlRepository $urlRepository)
    {
        $this->urlRepository = $urlRepository;
    }

    public function execute(AddNewUrlRequest $request): UrlValue
    {
        $href = $request->getHref();
        $slug = $request->getSlug();

        if (empty($href)) {
            throw new Exception("Href is required");
        }

        if (!$this->urlRepository->isUniqueHref($href)) {
            throw new Exception("This link is already exists");
        }

        if (empty($slug)) {
            throw new Exception("Slug is required");
        }

        if (!$this->urlRepository->isUniqueSlug($slug)) {
            throw new Exception("This slug is already exists");
        }

        $url = new Url;
        $url->href = $href;
        $url->slug = $slug;
        $url->user_id = Auth::id();
        $url->active = true;

        $url->save();

        $response = new UrlValue(
                $url->id,
                $url->href,
                $url->getShortHrefAttribute(),
                $url->getDateAttribute()
            );

        return $response;
    }
}