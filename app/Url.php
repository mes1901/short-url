<?php

declare(strict_types=1);

namespace App;

use Carbon\Traits\Date;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Url extends Model
{
    protected $table = 'urls';

    protected $fillable = ['href', 'slug', 'user_id', 'active'];

    protected $appends = ['short_href', 'date'];

    public function getShortHrefAttribute(): string
    {
        return $this->slug ? Config::get('app.url') . '/i/' . $this->slug : '';
    }

    public function getDateAttribute(): string
    {
        return $this->created_at ? $this->created_at->format('Y-m-d') : '';
    }
}