<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
class CourseController extends Controller
{
    public function index()
    {
        // Retrieve all courses
        $courses = Course::all();
        return response()->json($courses);
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            // Add more validation rules if needed
        ]);

        // Create a new course instance and fill it with the request data
        $course = new Course();
        $course->title = $request->input('title');
        // Assign other fields as needed

        // Save the course to the database
        $course->save();

        // Return a success response with the created course data
        return response()->json($course, 201);
    }

    public function show($id)
    {
        // Retrieve a specific course by ID
        $course = Course::findOrFail($id);
        return response()->json($course);
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            // Add more validation rules if needed
        ]);

        // Find the course by ID
        $course = Course::findOrFail($id);

        // Update the course with the request data
        $course->title = $request->input('title');
        // Update other fields as needed

        // Save the updated course to the database
        $course->save();

        // Return a success response with the updated course data
        return response()->json($course);
    }

    public function destroy($id)
    {
        // Find the course by ID and delete it
        $course = Course::findOrFail($id);
        $course->delete();

        // Return a success response
        return response()->json(['message' => 'Course deleted successfully']);
    }
}
