<?php

declare(strict_types=1);

namespace App\Actions;

use App\Repositories\StatisticRepository;

class GetRedirectCountAction
{
    private $statRepository;

    public function __construct(StatisticRepository $statRepository)
    {
        $this->statRepository = $statRepository;
    }
    public function execute(int $id)
    {
        return $this->statRepository->getRedirectCountByUrlId($id);
    }
}