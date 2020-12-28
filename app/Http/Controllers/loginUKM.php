<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class loginUKM extends Controller
{
    use AuthenticatesUsers;

    public function go()
    {
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect('/loginukm');
    }

    public function check2(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:3'
        ]);

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:3'
        ]);

        $userdata = array(
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        );

        if (Auth::attempt($userdata)) {
            return redirect()->to('MyUKM');
            // dd(auth()->user()->id);
        } else {
            return back()->with('errors', 'Periksa email dan password anda');
        }
    }

    // public function check(Request $request){
    //     $request->validate([
    //         $this->username() => 'required|string',
    //         'password' => 'required|string',
    //     ]);


    //     return $this->guard()->attempt(
    //         $this->credentials($request),
    //         $request->filled('remember')
    //     );
    // }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    // protected function sendLoginResponse(Request $request)
    // {
    //     $request->session()->regenerate();

    //     $this->clearLoginAttempts($request);

    //     if ($response = $this->authenticated($request, $this->guard()->user())) {
    //         return $response;
    //     }

    //     return $request->wantsJson()
    //         ? new JsonResponse([], 204)
    //         : redirect()->intended($this->redirectPath());
    // }

    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }
}
