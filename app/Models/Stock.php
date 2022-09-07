<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\DatesTrait;


class Stock extends Model
{
    use HasFactory, DatesTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'accentColor',
        'bgColor',
        'icon',
        'price',
        'isActive',
    ];
}
