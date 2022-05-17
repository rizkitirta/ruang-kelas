<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\MetaKelas;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->all());
        $data = MetaKelas::with('user')->latest()
        ->where('kelas_id', $request->kelas_id);

        return datatables()->of($data)->addIndexColumn()->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kelas.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $kelas = Kelas::create([
                'nama_kelas' => $request->nama_kelas,
                'bagian' => $request->kelas,
                'mapel' => $request->mapel,
                'ruang' => $request->ruang,
                'kode_kelas' => $this->getKode(10),
                'user_id' => auth()->id()
            ]);

            return \Response::json([
                'status' => true,
                'message' => 'Berhasil Membuat Kelas',
                'data' => $kelas
            ]);
        } catch (\Exception $e) {
            return \Response::json([
                'status' => false,
                'message' => 'Gagal Membuat Kelas'
            ]);
        }
    }

    public function getKode($n)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Kelas::findOrFail($id);
        $tugas = Tugas::latest()->whereKelasId($id)->get();
        return view('kelas.index', compact('data', 'tugas'));
    }

    public function gabung(Request $request)
    {
        try {
            MetaKelas::firstOrCreate([
                'user_id' => Auth::id(),
                'kelas_id' => $request->kelas_id,
            ]);

            return \Response::json([
                'status' => true,
                'message' => 'Berhasil bergabung ke Kelas',
            ]);
        } catch (\Exception $e) {
            if (env('APP_DEBUG')) {
                dd($e->getMessage());
            }
            return \Response::json([
                'status' => false,
                'message' => 'Gagal bergabung ke Kelas',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            Kelas::findOrFail($request->kelas_id)->delete();

            return \Response::json([
                'status' => true,
                'message' => 'Berhasil menghapus ke Kelas',
            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return \Response::json([
                'status' => false,
                'message' => 'Gagal menghapus ke Kelas',
            ]);
        }
    }

    public function destroyAnggota(Request $request)
    {
        try {
            MetaKelas::where(['kelas_id' => $request->kelas_id, 'user_id' => $request->user_id])->delete();

            return \Response::json([
                'status' => true,
                'message' => 'Berhasil menghapus ke anggota',
            ]);
        } catch (\Exception $e) {
            return \Response::json([
                'status' => false,
                'message' => 'Gagal menghapus ke anggota',
            ]);
        }
    }
}
