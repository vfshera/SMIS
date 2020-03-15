<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
