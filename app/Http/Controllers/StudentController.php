<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\StudentCourseController;
class StudentController extends Controller
{
    public function index()
    {
        // Retrieve all students
        $students = Student::all();
        return response()->json($students);
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            // Add more validation rules if needed
        ]);

        // Create a new student instance and fill it with the request data
        $student = new Student();
        $student->name = $request->input('name');
        // Assign other fields as needed

        // Save the student to the database
        $student->save();

        // Return a success response with the created student data
        return response()->json($student, 201);
    }

    public function show($id)
    {
        // Retrieve a specific student by ID
        $student = Student::findOrFail($id);
        return response()->json($student);
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            // Add more validation rules if needed
        ]);

        // Find the student by ID
        $student = Student::findOrFail($id);

        // Update the student with the request data
        $student->name = $request->input('name');
        // Update other fields as needed

        // Save the updated student to the database
        $student->save();

        // Return a success response with the updated student data
        return response()->json($student);
    }

    public function destroy($id)
    {
        // Find the student by ID and delete it
        $student = Student::findOrFail($id);
        $student->delete();

        // Return a success response
        return response()->json(['message' => 'Student deleted successfully']);


    }


    //student added multiple courses
    public function attachCourses(Request $request,Student $student)
    {
        $studentId = 2; // Assuming this is the ID of the student
        $courseId = [1, 2, 3]; // Array of course IDs to attach

        $student = Student::find($studentId);

        // Attach multiple courses to the student
        $student->courses()->attach($courseId);
        return response()->json($student);
    

    
    }
    public function detachCourses(Request $request,Student $student)
    {
        $studentId = 1;
        $courseId = [1, 2, 3];
        $student = Student::find($studentId);
        $student->courses()->detach($courseId);
        return response()->json($student);
    }
    
}
