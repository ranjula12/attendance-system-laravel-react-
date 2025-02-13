<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\AttendanceStatus;

class AttendanceController extends Controller
{
    
    public function getAttendance(Request $request)
    {
        // Get the year and month from query parameters or use current year and month by default
        $year = $request->query('year', now()->year);
        $month = $request->query('month', now()->month);

        // Fetch attendances based on the year and month
        $attendances = Attendance::with('employee.department')
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->get();

        // Return the attendances as JSON
        return response()->json($attendances);
    }

    /**
     * Update attendance for the current month and date only.
     */
    public function updateAttendance(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,short leave,on duty,sick leave',
        ]);

        // Get the current date and month
        $currentDate = now()->toDateString();
        $currentMonth = now()->month;
        $currentYear = now()->year;

        // Ensure that the date being updated is from the current month and year
        $attendanceDate = $validated['date'];
        $attendanceMonth = date('m', strtotime($attendanceDate));
        $attendanceYear = date('Y', strtotime($attendanceDate));

        if ($attendanceYear != $currentYear || $attendanceMonth != $currentMonth) {
            return response()->json([
                'error' => 'You can only update attendance for the current month and date.'
            ], 400);
        }

        // Update or create the attendance record
        $attendance = Attendance::updateOrCreate(
            ['employee_id' => $validated['employee_id'], 'date' => $attendanceDate],
            ['status' => $validated['status']]
        );

        // Return the updated attendance record
        return response()->json($attendance);
    }
}
