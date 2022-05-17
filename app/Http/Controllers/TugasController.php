<?php

namespace App\Http\Controllers;

use App\Models\KumpulTugas;
use App\Models\MetaKelas;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Auth;

class TugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = KumpulTugas::with('user')
            ->latest()->where('tugas_id', $request->tugas_id);

        return datatables()->of($data)
            ->addIndexColumn()
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            if ($request->file) {
                $filePath = $request->file('file')->store('/public/uploads');
            }

            $tugas = Tugas::create([
                'kelas_id' => $request->kelas_id,
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'file' => $filePath ?? null,
            ]);

            return back()->with('success', 'Berhasil membuat tugas');
        } catch (\Exception $e) {
            if (env('APP_DEBUG'))
                dd($e->getMessage());
            return back()->with('error', 'Gagal membuat tugas');
        }
    }

    public function kumpul(Request $request)
    {
        try {
            if ($request->file) {
                $filePath = $request->file('file')->store('/public/uploads');
            }

            KumpulTugas::updateOrCreate([
                'tugas_id' => $request->tugas_id,
                'user_id' => Auth::id(),
            ], [
                'tugas_id' => $request->tugas_id,
                'user_id' => Auth::id(),
                'status' => KumpulTugas::STATUS['pending'],
                'nilai' => 0,
                'file' => $filePath ?? null,
            ]);

            return back()->with('success', 'Berhasil mengumpul tugas');
        } catch (\Exception $e) {
            if (env('APP_DEBUG'))
                dd($e->getMessage());
            return back()->with('error', 'Gagal mengumpul tugas');
        }
    }

    public function nilai(Request $request)
    {
        // dd($request->all());
        try {

            KumpulTugas::updateOrCreate([
                'tugas_id' => $request->tugas_id,
                'user_id' => $request->user_id,
            ], [
                'tugas_id' => $request->tugas_id,
                'user_id' => $request->user_id,
                'status' => $request->status,
                'nilai' => $request->nilai,
            ]);

            return \Response::json([
                'status' => true,
                'message' => 'Berhasil menilai tugas',
            ]);
        } catch (\Exception $e) {
            if (env('APP_DEBUG'))
                dd($e->getMessage());

            return \Response::json([
                'status' => false,
                'message' => 'Berhasil menilai tugas',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Tugas::findOrFail($id);
        $explode = explode('/', $data->file);
        $fileName = $explode[2];
        return view('tugas.index', compact('data', 'fileName'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
