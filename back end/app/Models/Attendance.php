<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendance';
    protected $fillable = ['employee_id', 'date', 'status'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
