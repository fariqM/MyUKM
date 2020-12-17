<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpKernel\Profiler\Profile;

class EdituserController extends Controller
{
    public function edituser(User $user){
        return view('users.edituser', [
            'user' => $user,
            'role' => Role::get(),
            
        ]);

        // return view('users.edituser', compact('user'));


      
        // $roles = Role::find(2);
        // $roles->givePermissionTo('edit user');

        // dd('Done');
    }

    public function updateuser(User $user){

        auth()->check();
        $sad = request('name');
        $attr = request()->validate([
            'name' => ['required','min:3'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
        ]);

        $user->syncRoles(request('role'));
        $user->update($attr);
        return redirect()->to('user/'.$sad)->withStatus(__('Profile successfully updated.'));
        
    }

    public function destroy(User $user){

        auth()->check();
        User::destroy($user->id);
        $user->syncRoles("");
        // // dd('DONE');
        Alert::info('System', 'Penghapusan akun berhasil');
        return redirect()->back();
 
        // if(Staff::destroy($id)){
        //     flash(__('Staff has been deleted successfully'))->success();
        //     return redirect()->route('staffs.index');
        // }

        // flash(__('Something went wrong'))->error();
        // return back();

    }
}
