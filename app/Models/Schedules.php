<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedules extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'practitioner_id',
        'start_time',
        'end_time',
        'is_available',
    ];
}
