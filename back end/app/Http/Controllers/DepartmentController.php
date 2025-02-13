<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function getAllDepartmentsWithEmployees()
    {
        $departments = Department::with('employees')->get();
        return response()->json($departments);
    }
}
