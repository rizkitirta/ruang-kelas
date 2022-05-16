<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = Kelas::latest()->get();
        return view('dashboard.index',compact('data'));
    }
}
