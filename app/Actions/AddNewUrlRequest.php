<?php

declare(strict_types=1);

namespace App\Actions;

use App\Http\Requests\AddNewUrlHttpRequest;

class AddNewUrlRequest
{
    private $href;
    private $slug;

    public function __construct(string $href, string $slug)
    {
        $this->href = $href;
        $this->slug = $slug;
    }

    public function getHref(): string
    {
        return $this->href;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public static function fromRequest(AddNewUrlHttpRequest $request): self
    {
        return new static(
            $request->href(),
            $request->slug()
        );
    }
}