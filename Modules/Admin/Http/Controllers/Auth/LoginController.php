<?php

namespace Modules\Admin\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function validator(Request $request)
    {

        return $request->validate([
            'email' => 'required|exists:admins,email',
            'password' => 'required'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function login()
    {
        $title = trans('admin::admin.login');
        return view('adminpanel::pages.login' , compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function do_login(Request $request)
    {
        $data = $this->validator($request);

        $remember_me = $request->remember_me ? true : false;

        if(auth('admin')->attempt(['email' => $data['email'] , 'password' => $data['password']] , $remember_me))
        {
            return redirect()->route('admin.dashboard')->with('success' , trans('admin::admin.logged_success'));
        }

    }

}
