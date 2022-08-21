<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\User;

class PetController extends Controller
{
    //
    public function index($user_id)
    {
        $user_with_pets=User::with('pets')->where('id', $user_id)->get();
        return view("admin.pet.index", compact('user_with_pets'));
    }
}
 