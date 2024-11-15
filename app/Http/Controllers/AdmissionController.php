<?php

namespace App\Http\Controllers;

use App\Models\Admission;
use App\Models\Application;
use Arr;
use Gate;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Redirect;

class AdmissionController extends Controller
{


    public function index()
    {
        $published_admissions =[];
        $student_published_admissions =[];
        $institute_published_admissions =[];
        $admissions = Admission::all();

        foreach ($admissions as $admission) {
           if($admission->application->course->faculty->institute->control->admissions==='open'){
                array_push($published_admissions,$admission);
           }
        }
        $institute_published_admissions = Arr::where($published_admissions, function ($admission) {
            return $admission->application->course->faculty->institute->id === Auth::user()?->institute?->id;
        });
         $student_published_admissions = Arr::where($published_admissions, function ($admission) {
            return $admission->application->student->id === Auth::user()?->student?->id;
        });

        if(Gate::allows('student')){
            $published_admissions =$student_published_admissions;
        }
        if(Gate::allows('student')){
            $published_admissions =$institute_published_admissions;
        }

        if(Gate::allows('admin')){
            return view('admin.admissions.index', [
                'admissions' => $published_admissions
            ]);
        }


        return view('admissions.index',[
            'admissions'=>$published_admissions
        ]);
    }
    public function store(Request $request, $id): RedirectResponse
    {
        Gate::authorize('admin-institute');

        $application = Application::findOrFail($id);
        $student_applications = $application->student->application;

        foreach ($student_applications as $app) {
            if ($app->status==='admitted') {
                return Redirect::route('application.update', $id)->with('status', 'application-updated');
            }
        }

        $admission = Admission::firstWhere('application_id','=',$application->id);
        
        
        if($request->action==='admit') {
            if(!$admission?->id) {
                $application->status = 'admitted';
                Admission::create([
                    "application_id" => $application->id
                ]);
                $application->save();
            return Redirect::route('application.update', $id)->with('status', 'application-admitted');
            } else {
            return Redirect::route('application.update', $id)->with('status', 'application-updated');
        }
            
        }elseif($request->action === 'waitlist'){
            $application->status = 'waitlisted';
            $application->save();
        return Redirect::route('application.update', $id)->with('status', 'application-waitlisted');    
        } else{
            $application->status = 'rejected';
            $application->save();
        return Redirect::route('application.update', $id)->with('status', 'application-rejected');
        }  
    }
}
