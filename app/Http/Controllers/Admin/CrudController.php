<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class CrudController extends Controller
{
    public function index()
    {
        Session::put('page','crud');
        $title = "Backup and Export";
        return view('admin.crud')->with(compact('title'));
    }
}
