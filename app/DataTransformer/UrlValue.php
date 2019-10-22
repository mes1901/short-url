<?php

declare(strict_types=1);

namespace App\DataTransformer;

class UrlValue
{
    private $id;
    private $href;
    private $shortHref;
    private $date;

    public function __construct(int $id, string $href, string $shortHref, string $date)
    {
        $this->id = $id;
        $this->href = $href;
        $this->shortHref = $shortHref;
        $this->date = $date;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function href(): string
    {
        return $this->href;
    }

    public function shortHref(): string
    {
        return $this->shortHref;
    }

    public function date(): string
    {
        return $this->date;
    }
}