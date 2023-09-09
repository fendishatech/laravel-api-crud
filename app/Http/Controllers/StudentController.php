<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::paginate(10);

        if ($students->count() > 0) {
            return response()->json([
                'status' => 200,
                'students' => $students
            ], 200);
        }

        return response()->json([
            'status' => 404,
            'message' => "No records Found!"
        ], 404);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:30',
            'last_name' => 'required|string|max:30',
            'email' => 'required|email|max:30',
            'dept' => 'required|string|max:60',
            'phone_no' => 'required|string|max:30',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $student = Student::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'dept' => $request->dept,
                'phone_no' => $request->phone_no,
            ]);

            if ($student) {
                return response()->json([
                    'status' => 200,
                    'message' => "Student Created Successfully!"
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => "Something went wwrong creating Student!"
                ], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
}
