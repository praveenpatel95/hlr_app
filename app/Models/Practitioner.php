<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Practitioner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
        'address',
        'telecom',
        'birthDate',
        'active',
    ];
    public $timestamps =false;
}
