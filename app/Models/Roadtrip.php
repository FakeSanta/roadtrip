<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roadtrip extends Model
{
    protected $table = 'roadtrip';
    use HasFactory;
    protected $fillable = [
        "name",
        "date",
        "gps",
        "url",
    ];
}
