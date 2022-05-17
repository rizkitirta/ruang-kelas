<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $data = Kelas::latest()
            ->when($request->kode_kelas, function ($q) use ($request) {
                $q->where('kode_kelas', $request->kode_kelas);
            })
            ->when(!$request->kode_kelas, function ($q) use ($request) {
                $q->where('user_id', Auth::id())->orWhereHas('anggota', function ($q) {
                    $q->where('user_id', Auth::id());
                });
            })
            ->get();

        return view('dashboard.index', compact('data'));
    }
}
