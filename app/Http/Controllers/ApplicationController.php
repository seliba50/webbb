<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Course;
use Arr;
use Auth;
use Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Redirect;

class ApplicationController extends Controller
{
    public function create($id)
    {
        

        if (Gate::denies('student')) {
            return redirect('/dashboard');
        }
        $course = Course::findOrFail($id);
        if ($course->faculty->institute->control->applications !== 'open') {
            return redirect('/dashboard');
        }
        

        $passed = explode(',',$course->passed_subject);
        $credits = explode(',',$course->credits);
        return view('application.create', ['course' => $course,'passed'=>$passed,'credits'=>$credits]);
    }
    public function show(Request $request,$id): View 
    {
        $application = Application::findOrFail($id);
        $results = json_decode($application->grades);
        $student_applications = $application->student->application;
        $status = '';

        foreach ($student_applications as $app) {
            if ($app->status === 'admitted') {
                $status = $app->status;
            } 
        }
        if (Auth::user()?->admin) {
            return view('admin.application.show', ['application' => $application, 'results' => $results, 'status' => $status]);
        }
        return view('application.show', ['application' => $application, 'results' => $results,'status'=>$status]);
    }
    public function index(): View
    {
         $applications =[];
        if(Gate::allows('student')) {
            $applications = Auth::user()?->student?->application;
        }
        if(Gate::allows('institute')) {
            $institute = Auth::user()->institute;
            $courses = [];
            $institute_applications = [];
            foreach ($institute->faculty as $faculty) {
                if (count($faculty->course) > 0)
                    array_push($courses, $faculty->course);
            }

            foreach ($courses as $course_in_faculty) {
                foreach ($course_in_faculty as $course) {
                    foreach ($course->application as $app) {
                        if (count($course->application) > 0) {
                            array_push($institute_applications, $app);
                        }
                    }
                }

            }

            $applications_pending =  Arr::where($institute_applications,function($app){
                return $app->status === 'pending';
            });
            $applications_admitted =  Arr::where($institute_applications,function($app){
                return $app->status === 'admitted';
            });

            $applications_waitlisted =  Arr::where($institute_applications,function($app){
                return $app->status === 'waitlisted';
            });

            $applications_rejected =  Arr::where($institute_applications,function($app){
                return $app->status === 'rejected';
            });
            $applications = [$applications_pending,$applications_admitted,$applications_waitlisted, $applications_rejected];
        }
        if(Gate::allows('admin')) {
            $all_applications = iterator_to_array(Application::all()) ;
            
            $applications_pending =  Arr::where($all_applications,function($app){
                return $app->status === 'pending';
            });
            $applications_admitted =  Arr::where($all_applications,function($app){
                return $app->status === 'admitted';
            });
            $applications_waitlisted =  Arr::where($all_applications,function($app){
                return $app->status === 'waitlisted';
            });
            $applications_rejected =  Arr::where($all_applications,function($app){
                return $app->status === 'rejected';
            });
            $applications = [$applications_pending,$applications_admitted,$applications_waitlisted, $applications_rejected];
        }
        if (Auth::user()?->admin) {
            return view('admin.application.index', ['applications' => $applications]);
        }
        return view('application.index', ['applications' => $applications]);
    }

    public function store(Request $request,$id): RedirectResponse
    {
        $course = Course::findOrFail($id);
        $passed_chars = ['A','B','C,','D', 'a', 'b', 'c', 'd'];
        $credit_chars = ['A','B','C,','a','b','c'];
        $data =[];
        $data_credits =[];
        $validated =[];
        //validation for passed_subject and passed_grade
        for($i=0;$i< $course->pass;$i++) {
         $validated += $request->validate([
            "passed_subject_".$i+1 => ['required', 'string'],
            "passed_grade_" . $i + 1 => ['required', 'string', 'max:1']
            ]);
            $data = Arr::add($data,$i, "passed_subject_" . $i + 1);
            
        }
        

        //validation for credit_subject and credit_grade
        for ($i = 0; $i < $course->credit_amount; $i++) {
            $validated +=$request->validate([
                "credit_subject_" . $i + 1 => ['required', 'string'],
                "credit_grade_" . $i + 1 => ['required', 'string', 'max:1']
            ]);
            $data_credits = Arr::add($data_credits, $i, "credit_subject_" . $i + 1);
        }

        //validation for passed_grades are characters in pass characters array 
        for($i=0;$i<$course->pass;$i++) {
            $field ="passed_subject_".$i+1;
            $f = Arr::where ($data, function($sub)use ($field) {
                return $field !== $sub;
            });
            $m = Arr::map ($f, function($sub)use ($request,$field) {
                return strtolower($request->$sub);
            });
            $char = strtolower($request->$field);
            if(in_array($char,$m,true)){
               throw ValidationException::withMessages([
                $field => "The subject is already added($char)."
               ]);
            }
        }
        for($i=0;$i<$course->credit_amount;$i++) {
            $field ="credit_subject_".$i+1;
            $f = Arr::where ($data_credits, function($sub)use ($field) {
                return $field !== $sub;
            });
            $m = Arr::map ($f, function($sub)use ($request,$field) {
                
                return strtolower($request->$sub);
            });
            $char = strtolower($request->$field);
            if(in_array($char,$m,true)){
               throw ValidationException::withMessages([
                $field => "The subject is already added($char)."
               ]);
            }
        }

        for($i=0;$i<$course->pass;$i++) {
            $field ="passed_grade_".$i+1;
            $char = $request->$field;
            if(!in_array($char,$passed_chars,true)){
               throw ValidationException::withMessages([
                $field => "Sorry, you do not meet the requirements."
               ]);
            }
        }
        
        for($i=0;$i<$course->credit_amount;$i++) {
            $f ="credit_grade_".$i+1;
            $char = $request->$f;
            if(!in_array($char,$credit_chars,true)){
               throw ValidationException::withMessages([
                $f => 'Sorry, you do not meet the requirements.'
               ]);
            }
        }
        for($i=0;$i<$course->pass;$i++) {
            $passed_subject ="passed_subject_".$i+1;
            $passed_grade ="passed_grade_".$i+1;
            $passed_subject_value = $request->$passed_subject;
            $passed_grade_value = $request->$passed_grade;

            for ($j = 0; $j < $course->credit_amount; $j++) {
                $credit_subject = "credit_subject_" . $j + 1;
                $credit_grade = "credit_grade_" . $j + 1;
                $credit_subject_value = $request->$credit_subject;
                $credit_grade_value = $request->$credit_grade;

                if (strtolower($passed_subject_value)===strtolower($credit_subject_value) && strtolower($credit_grade_value) !== strtolower($passed_grade_value)) {
                    $subject =strtolower($passed_subject_value);
                    throw ValidationException::withMessages([
                        $credit_grade => "The grades for $subject do not match.",
                        $passed_grade => "The grades for $subject do not match."
                    ]);
                }
            }
        }


        $student =Auth::user()->student;
        $application = (count($student->application) > 0) ? $student->application : [];
        
        
        $student_applications =iterator_to_array($application) ;
        //$application = $course->application ?: [];
        //status -> pending,wait-listed,rejected,admitted
        $pending_student_applications = Arr::where($student_applications,function($app) use ($id){
            return $app->course_id==$id && $app->status==='pending';
        });

        if(count($pending_student_applications)>0) {
            throw ValidationException::withMessages([
                "general" => "You have already applied for this course.",
            ]);
        }

        $institute = $course->faculty->institute;
        $courses =[];
        $institute_applications=[];
        foreach ($institute->faculty as $faculty) {
            if(count($faculty->course)>0)
            array_push($courses,$faculty->course);
        }
        
        foreach ($courses as $course_in_faculty) {
            foreach ($course_in_faculty as $course) {
                foreach($course->application as $app){
                    if(count($course->application)>0) {
                        array_push($institute_applications,$app);
                    }
                }
                
                    
            }
            
        }
        
        $institute_student_applications = Arr::where($institute_applications, function ($app) {
            return $app->student_id  === Auth::user()->id && $app->status === 'pending';
        });

        if(count($institute_student_applications)>=2) {
            throw ValidationException::withMessages([
                "general" => "You can only apply for 2 courses per institute.",
                
            ]);
        }

        Application::create([
            'status' => 'pending',
            'course_id' => $id,
            'student_id' => Auth::user()?->student?->id,
            'grades' => json_encode($validated),
        ]);
        
        return Redirect::route('courses')->with('status', 'application-created');
    }
}
