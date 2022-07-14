<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Terminal;
use Illuminate\Http\Request;

class TerminalController extends Controller
{
    public function index()
    {
        $terminals = Terminal::paginate();

        if ($terminals->count() > 0) {
            return response()->json(['message' => 'Data Terminal berhasil di GET', 'data' => $terminals]);
        } else {
            return response()->json(['message' => 'Data Terminal masih kosong']);
        }
    }


    public function store(Request $request)
    {
        $request->validate([
            'kode'      => 'required',
            'nama'      => 'required',
            'alamat'    => 'required',
            'provinsi'  => 'required',
            'kota'      => 'required',
            'kecamatan' => 'required',
            'tipe'      => 'required|in:TERMINAL,CHECKPOINT,PUL',
        ]);

        $terminal = Terminal::create($request->all());

        if ($terminal) {
            return response()->json(['message' => 'Terminal berhasil diinput', 'data' => $terminal]);
        } else {
            return response()->json(['message' => 'Terminal gagal diinput']);
        }
    }


    public function show(Terminal $terminal)
    {
        if ($terminal) {
            return response()->json(['message' => 'Data Terminal berhasil di GET', 'data' => $terminal]);
        } else {
            return response()->json(['message' => 'Data Terminal tidak ditemukan']);
        }
    }


    public function update(Request $request, Terminal $terminal)
    {
        $request->validate([
            'kode'      => 'required',
            'nama'      => 'required',
            'alamat'    => 'required',
            'provinsi'  => 'required',
            'kota'      => 'required',
            'kecamatan' => 'required',
            'tipe'      => 'required|in:TERMINAL,CHECKPOINT,PUL',
        ]);

        $terminal->update($request->all());

        if ($terminal) {
            return response()->json(['message' => 'Terminal berhasil diupdate', 'data' => $terminal]);
        } else {
            return response()->json(['message' => 'Terminal gagal diupdate']);
        }
    }


    public function destroy(Terminal $terminal)
    {
        $terminal->delete();

        if ($terminal) {
            return response()->json(['message' => 'Terminal berhasil dihapus']);
        } else {
            return response()->json(['message' => 'Terminal gagal dihapus']);
        }
    }
}
