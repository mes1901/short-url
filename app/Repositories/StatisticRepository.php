<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Stat;

class StatisticRepository
{
    public function getRedirectCountByUrlId(int $id): int
    {
        return Stat::where('url_id', $id)->count();
    }
}