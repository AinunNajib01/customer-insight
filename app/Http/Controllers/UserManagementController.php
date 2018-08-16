<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserManagementController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->middleware('guest', ['except' => 'logout']);

        $this->request = $request;
    }

    public function showForm()
    {
        return view('auth.login');
    }

    public function submitLoginForm()
    {
        $credential = ['username' => $this->request->username, 'password' => $this->request->password];
        if ($this->login($credential)) {
            return redirect('/home');
        } else {
            Session::flash('login-error', 'Wrong username/password. Try again.');
            return redirect('/auth');
        }
    }

    public function submitRegisterForm()
    {
        // With Validator
        $validator = Validator::make($this->request->all(), User::$rules);
        if (!$validator->fails()) {
            $account = [
                'name' => $this->request->name,
                'username' => $this->request->username,
                'email' => $this->request->email,
                'password' => bcrypt($this->request->password)
            ];

            // Register
            $userAccount = User::create($account);

            // Auto login
            $credential = ['username' => $this->request->username, 'password' => $this->request->password];
            if ($this->login($credential)) {
                return redirect('/home');
            } else {
                return redirect('/auth')->withErrors(['message' => 'Login failed!']);
            }
        } else {
            return redirect('/auth')->withErrors($validator, 'register')->withInput();
        }
    }

    public function logout()
    {
        $userdata = Auth::user();
        $userdata->token = null;
        $userdata->save();

        Auth::logout();

        return redirect('/auth');
    }

    protected function login($credential)
    {
        if ($account = Auth::attempt($credential, true)) {

            $userdata = Auth::user();
            $userdata->token = JWTAuth::attempt($credential);
            $userdata->save();

            return $account;
        } else {
            return false;
        }
    }
}
