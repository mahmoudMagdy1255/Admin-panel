<?php

namespace Modules\AdminPanel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class AdminPanelController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('adminpanel::index')->with('title' , trans('adminpanel::adminpanel.index'));
    }

}
