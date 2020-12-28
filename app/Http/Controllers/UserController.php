<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    
    public function index()
    {
        
        // $user = post::latest()->paginate(4);
        $user = User::paginate(3);
        $page = 1;
        $total = $user->total();
        $pembagian = ceil($total / 3);
        return view('users.index', [
            'data' => $user,
            'halaman' => $pembagian,
            'role' => Role::get(),
        ]);
        // dd($pembagian);
    }
}
