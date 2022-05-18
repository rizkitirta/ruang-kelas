<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $user = User::findOrFail(Auth::id());
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            $profile = Profile::updateOrCreate([
                'user_id' => $user->id
            ], [
                'no_identitas' => $request->no_identitas,
                'no_hp' => $request->no_hp,
            ]);

            if($request->foto){
                $filePath = $request->file('foto')->store('/public/uploads');
                $profile->update(['foto' => $filePath]);
            }

            DB::commit();
            return back()->with('success', 'Profile berhasil diupdate');
        } catch (\Exception $e) {
            Db::rollBack();
            if (env('APP_DEBUG'))
                dd($e->getMessage());

            return back()->with('success', 'Profile gagal diupdate');
        }
    }
}
