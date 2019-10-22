<?php

declare(strict_types=1);

namespace App\Actions;

class GetRedirectDataRequest
{
    private $ip;
    private $agent;

    public function __construct(string $ip, string $agent)
    {
        $this->agent = $agent;
        $this->ip = $ip;
    }

    public function getUserIp(): string
    {
        return $this->ip;
    }

    public function getUserAgent(): string
    {
        return $this->agent;
    }
}