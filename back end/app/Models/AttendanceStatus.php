<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttendanceStatus extends Model
{
    use HasFactory;

    protected $fillable = ['status'];
}
