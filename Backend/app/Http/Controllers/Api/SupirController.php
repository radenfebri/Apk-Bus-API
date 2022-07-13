<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Supir;
use Illuminate\Http\Request;


class SupirController extends Controller
{
    public function index()
    {
        $supirs = Supir::paginate();

        if ($supirs->count() > 0) {
            return response()->json(['message' => 'Data Supir berhasil di GET', 'data' => $supirs]);
        } else {
            return response()->json(['message' => 'Data Supir tidak ditemukan']);
        }
    }


    public function store(Request $request)
    {
        $request->validate([
            'no_register'   => 'required',
            'nama_lengkap'  => 'required',
            'alamat'        => 'required',
            'jenis_kelamin' => 'required|in:P,L',
        ]);

        $supir = Supir::create($request->all());

        if ($supir) {
            return response()->json(['message' => 'Supir berhasil diinput', 'data' => $supir]);
        } else {
            return response()->json(['message' => 'Supir gagal diinput']);
        }
    }


    public function show(Supir $supir)
    {
        if ( ($supir)->exists() ) {
            return response()->json(['message' => 'Supir berhasil diambil', 'data' => $supir]);
        } else {
            return response()->json(['message' => 'Supir tidak ditemukan']);
        }
    }


    public function update(Request $request, Supir $supir)
    {
        $request->validate([
            'no_register'   => 'required',
            'nama_lengkap'  => 'required',
            'alamat'        => 'required',
            'jenis_kelamin' => 'required|in:P,L',
        ]);

        $supir->update($request->all());

        if ( ($supir)->exists() ) {
            return response()->json(['message' => 'Supir berhasil diupdate', 'data' => $supir]);
        } else {
            return response()->json(['message' => 'Supir gagal diupdate']);
        }
    }


    public function destroy(Supir $supir)
    {
        $supir->delete();

        if ( ($supir)->exists() ) {
            return response()->json(['message' => 'Supir berhasil dihapus', 'data' => $supir]);
        } else {
            return response()->json(['message' => 'Supir gagal dihapus']);
        }
    }
}
