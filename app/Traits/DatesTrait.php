<?php

namespace App\Traits;
use Carbon\Carbon;


trait DatesTrait
{
    protected $newDateFormat = 'd.m.Y H:i';

    public function getUpdatedAtAttribute($value) {
       return Carbon::parse($value)->format($this->newDateFormat);
    }

    public function getCreatedAtAttribute($value) {
        return Carbon::parse($value)->format($this->newDateFormat);
    }
}