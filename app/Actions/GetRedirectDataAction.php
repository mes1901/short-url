<?php

declare(strict_types=1);

namespace App\Actions;

use App\Repositories\StatisticRepository;
use App\Repositories\UrlRepository;
use App\Stat;
use Illuminate\Http\RedirectResponse;
use Stevebauman\Location\Facades\Location;
use Exception;

class GetRedirectDataAction
{
    private $urlRepository;
    private $statRepository;

    public function __construct(UrlRepository $urlRepository, StatisticRepository $statRepository)
    {
        $this->urlRepository = $urlRepository;
        $this->statRepository = $statRepository;
    }

    public function execute(GetRedirectDataRequest $request, string $slug): RedirectResponse
    {
        $url = $this->urlRepository->getBySlug($slug);
        if(!$url) {
            throw new Exception("There is no such url.");
        }

        $statistic = new Stat();
        $ip = $request->getUserIp();
        $statistic->url_id = $url->id;
        $statistic->user_agent = $request->getUserAgent();
        $statistic->user_ip = $ip;
        $statistic->user_location = Location::get($ip);

        $statistic->save();

        return redirect($url->href);
    }
}