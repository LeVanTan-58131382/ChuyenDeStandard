<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SystemCalendar;

class AdminHomeController extends Controller
{
    public function index()
    {
        $celendar = SystemCalendar::find(1);
        return view('admin.home', compact('celendar'));
    }
}
