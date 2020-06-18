<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SystemCalendar;

class AdminHomeController extends Controller
{
    public function __construct()
    { 
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $calendar = SystemCalendar::find(1);
        return view('admin.home', compact('calendar')); 
    }
}
