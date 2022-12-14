<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\DatesTrait;

class User extends Model
{
    // DatesTrait format: d-m-Y H:i
    use HasFactory, DatesTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'fname',
        'lname',
        'avatar',
    ];
}