<?php

namespace App\Http\Controllers\API;

use App\Classroom;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\News;
use App\User;
use Illuminate\Http\Request;

class UserResourceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function allUsers(){

        $everyUser = User::all();

        return UserResource::collection($everyUser);
    }

    public function dashCount(){

        $students = User::where('access' , '1')->count();
        $teachers = User::where('access' , '2')->count();
        $newsposts = News::all()->count();
        $classrooms = Classroom::all()->count();

        return json_encode(['stud_no' => $students , 'tcher_no' => $teachers , 'newsposts' => $newsposts , 'class_count' => $classrooms]);
    }

    public function root(){

        $adminUsers = User::admins()->orderBy('created_at', 'DESC')->paginate(10);

        return UserResource::collection($adminUsers);
    }

    public function students(){

        $studentUsers = User::students()->orderBy('created_at', 'DESC')->paginate(10);

        return UserResource::collection($studentUsers);
    }

    public function teachers(){

        $teacherUsers = User::teachers()->orderBy('created_at', 'DESC')->paginate(10);

        return UserResource::collection($teacherUsers);
    }

}
