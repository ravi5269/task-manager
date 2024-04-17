<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Course;

class StudentCourseController extends Controller

{


    public function assignCourseToStudent(Request $request) {
        // Validate input data
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
        ]);

        $student = Student::findOrFail($request->student_id);
        $course = Course::findOrFail($request->course_id);

        // Attach course to student
        $student->courses()->attach($course);

        return response()->json(['message' => 'Course assigned to student successfully'], 200);
        }
    public function count() {
        $count_student = Student::count();
        $count_course = Course::count();

        return response()->json(['count_student' => $count_student,'count_course'=> $count_course],200);


    }
  
    
}
