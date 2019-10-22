<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Url;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class UrlRepository
{
    public function getBySlug(string $slug): Url
    {
        return Url::where('slug', $slug)
            ->where('active', true)
            ->first();
    }

    public function getAllByUser(int $id): Collection
    {
        return Url::where('user_id', $id)
            ->where('active', true)
            ->get();
    }

    public function getUrlById(int $id): Url
    {
        return Url::where('id', $id)
            ->where('active', true)
            ->where('user_id', Auth::id())
            ->first();
    }

    public function isUniqueHref(string $href): bool
    {
        return !Url::where('href', $href)
            ->where('user_id', Auth::id())
            ->exists();
    }

    public function isUniqueSlug(string $slug): bool
    {
        return !Url::where('slug', $slug)->exists();
    }
}