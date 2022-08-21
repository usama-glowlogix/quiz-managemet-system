<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pet;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function index()
    {
        $users=User::where('id', '!=', Auth::user()->id)->get();
        dd($users);
        return view('admin.user.index', compact('users'));
    }
}
