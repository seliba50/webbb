<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Institute;

class AdminController extends Controller
{
    // Show all users
    public function indexUsers()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Add a new institution
    public function createInstitute(Request $request)
    {
        $institute = Institute::create($request->all());
        return redirect()->back()->with('success', 'Institution created successfully!');
    }

    // Update course information
    public function updateCourse(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $course->update($request->all());
        return redirect()->back()->with('success', 'Course updated successfully!');
    }
}
