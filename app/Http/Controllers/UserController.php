<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use App\Models\Theme;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Config;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = $this->loadusers();
        return view('users.index', compact('users'));
    }
    public function loadusers()
    {
        $users = User::get();
        return $users;
    }
    public function create()
    {
        return view('users.create');
    }
    public function store(Request $request)
    {
        $messages = [

            'name.required'     =>__('The Email of the User is Required'),
            'name.unique'       =>__('The Email of the User Already Exists'),
            'password.required' =>__('The Password of the User is Required')
        ];
         $validator = Validator::make($request->all(), [

            'name'     => 'required|unique:users,name',
            'password' => 'required'

        ], $messages);
        if ($validator->fails()) {
            $result['status'] = 0;
            $result['message'] = __('');
            foreach ($validator->errors()->all() as $key => $value) {
                $result['message'] .= $value.'<br/>';
            }
            $result['data'] = null;
            $result['type'] = 'error';

        }else{
            try {
                $item = new User();
                $item->name          = $request->name;
                $item->password      = Hash::make($request->password);
                $item->date_register = now();
                $item->ip            = \Request::ip();
                $item->save();

                $result['status']  = 1;
                $result['tittle']  = __('Data stored successfully');
                $result['type']    = __('success');
                $result['message'] = __('');

            }catch (\Exception $e) {
                $result['status']  = 0;
                $result['tittle']  = __('Store error');
                $result['type']    = __('error');
                $result['message'] = $e->getMessage();
            }
        }
            return $result;
    }
    public function edit($id)
    {
        $users = User::find($id);
        return view('users.edit', compact('users'));
    }
    public function update(Request $request)
    {
        $messages = [
            'name.required'     =>__('The Email of the User is Required'),
            'name.unique'       =>__('The Email of the User Already Exists')
        ];
         $validator = Validator::make($request->all(), [
            'name'     => 'required|unique:users,name,'. $request->id,

        ], $messages);
        if ($validator->fails()) {

            $result['status'] = 0;
            $result['message'] = __('');
            foreach ($validator->errors()->all() as $key => $value) {
                $result['message'] .= $value.'<br/>';
            }
            $result['data'] = null;
            $result['type'] = 'error';

        }else{
            try {
                $item = User::find($request->id);
                if($item != null){
                    $item->name          = $request->name;
                    $item->password      = $request->password == null ? $item->password:Hash::make($request->password);
                    $item->date_register = now();
                    $item->ip            = \Request::ip();
                    $item->save();

                    $result['status']  = 1;
                    $result['tittle']  = __('Data stored successfully');
                    $result['type']    = __('success');
                    $result['message'] = __('');
                }else{
                    $result['status']  = 0;
                    $result['tittle']  = __('No data found');
                    $result['type']    = __('error');
                    $result['message'] = __('');
                }

            }catch (\Exception $e) {
                $result['status']  = 0;
                $result['tittle']  = __('Update error');
                $result['type']    = __('error');
                $result['message'] = $e->getMessage();
            }
        }
            return $result;
    }
    public function change_status($id, $type)
    {
     try {
            $user         = User::find($id);
            $user->status = $type;
            $user->save();
            $msg = $type == 0 ? __('Deleted'):__('Restored');

            $result['status']  = 1;
            $result['tittle']  = $msg;
            $result['type']    = __('success');
            $result['message'] = __('');
        } catch (Exception $e) {
            $result['status']  = 0;
            $result['tittle']  = __('Update error');
            $result['type']    = __('error');
            $result['message'] = $e->getMessage();
        }
        return $result;
    }
    public function login(Request $request)
    {
        if (Auth::check()) {
            return Redirect::to('/');
        } else {
            if ($request->isMethod('post')) {

                $userdata = array(
                    'name'     => $request->username,
                    'password' => $request->password
                );

                if (Auth::attempt($userdata)) {
			        $result['tittle']  = __('Welcome'.' '.Auth::user()->name);
			        $result['type']    = __('success');
			        $result['message'] = __('');
        			return Redirect::to('/')->with('msg', $result)->withInput();
                } else {
                    $result['tittle']  = __('The following errors occurred:');
                    $result['type']    = __('error');
                    $result['message'] = __('Login Failure');

                    return Redirect::to('login')->with('msg', $result)->withInput();
                }
            } else {
				return view('users.login');
            }
        }
    }
    public function logOut()
    {
        Auth::logout();

        $result['tittle']  = __('');
        $result['type']    = __('info');
        $result['message'] = __('Your session has been closed');

        return Redirect::to('login')->with('msg', $result)->withInput();
    }
    public function theme($theme = 1)
    {
        $theme = Theme::find($theme);
        $user  = User::find(Auth::user()->id);
        $user->theme_id = $theme->id;
        $user->save();
        session()->put('theme', $theme->class_name);
    }
}
