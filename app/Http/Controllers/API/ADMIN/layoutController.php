<?php

namespace App\Http\Controllers\API\ADMIN;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class layoutController extends Controller
{
    public function index() 
    {
    	return view('admin');
    }
}
