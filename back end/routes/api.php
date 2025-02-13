<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DepartmentController;


Route::get('/attendance', [AttendanceController::class, 'getAttendance'])->name('attendance.get');
Route::post('/attendance/update', [AttendanceController::class, 'updateAttendance'])->name('attendance.update');
Route::get('/departments', [DepartmentController::class, 'getAllDepartmentsWithEmployees'])->name('departments.get');