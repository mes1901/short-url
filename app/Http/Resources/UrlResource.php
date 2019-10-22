<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Contracts\ApiResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class UrlResource extends JsonResource implements ApiResponse
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id(),
            'href' => $this->href(),
            'short_href' => $this->shortHref(),
            'date' => $this->date(),
        ];
    }
}