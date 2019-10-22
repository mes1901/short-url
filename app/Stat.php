<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    protected $table = 'redirect_stats';

    protected $fillable = ['url_id', 'user_location', 'user_agent', 'user_ip'];
}