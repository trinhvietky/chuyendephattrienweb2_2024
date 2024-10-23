<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    public function index()
    {
        // Logic cho admin home page
        return view('admin/home');
    }
}
