<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skater extends Model
{
    use HasFactory;
    protected $fillable = [
        'firstName',
        'lastName',
        'country',
        'sponsors',
        'boardWidth'
    ];
}
