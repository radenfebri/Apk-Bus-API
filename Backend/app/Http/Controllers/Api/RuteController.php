<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rute;
use App\Models\Terminal;
use Illuminate\Http\Request;

class RuteController extends Controller
{
    public function index()
    {
        $rutes = Rute::select('id', 'kode', 'asal', 'tujuan', 'waktu_tempuh')->paginate();

        if ($rutes->count() > 0) {
            return response()->json(['status' => 'Data Rute berhasil di GET', 'data' => $rutes]);
        } else {
            return response()->json(['status' => 'Data Rute masih ksong']);
        }
    }


    public function store(Request $request)
    {
        $request->validate([
            'asal'          => 'required',
            'tujuan'        => 'required',
            'kode'          => 'required',
            'waktu_tempuh'  => 'required|int',
            'checkpoints'   => 'required|array',
        ]);

        $rute = Rute::create([
            'asal'          => $request->asal,
            'tujuan'        => $request->tujuan,
            'kode'          => $request->kode,
            'waktu_tempuh'  => $request->waktu_tempuh,
            'checkpoints'   => json_encode($request->checkpoints),
        ]);

        $rute->checkpoints = json_decode($rute->checkpoints, true);
        $terminals = Terminal::whereIn('id', array_column($rute->checkpoints, "id"))
        ->select('id', 'kode', 'nama', 'alamat', 'tipe')
        ->get();

        $rute->checkpoints = array_map(function($item) use ($terminals) {
            $item['terminal'] = $terminals->where('id', $item['id'])->first();
            return $item;
        }, $rute->checkpoints);

        if ($rute) {
            return response()->json(['status' => 'Rute berhasil diinput', 'data' => $rute]);
        } else {
            return response()->json(['status' => 'Rute gagal diinput']);
        }
    }


    public function show(Rute $rute)
    {
        $rute->checkpoints = json_decode($rute->checkpoints, true);
        $terminals = Terminal::whereIn('id', array_column($rute->checkpoints, "id"))
        ->select('id', 'kode', 'nama', 'alamat', 'tipe')
        ->get();

        $rute->checkpoints = array_map(function($item) use ($terminals) {
            $item['terminal'] = $terminals->where('id', $item['id'])->first();
            return $item;
        }, $rute->checkpoints);

        if ($rute) {
            return response()->json(['status' => 'Data Rute berhasil diambil', 'data' => $rute]);
        } else {
            return response()->json(['status' => 'Data Rute masih ksong']);
        }
    }


    public function update(Request $request, Rute $rute)
    {
        $request->validate([
            'asal'          => 'required',
            'tujuan'        => 'required',
            'kode'          => 'required',
            'waktu_tempuh'  => 'required|int',
            'checkpoints'   => 'required|array',
        ]);

        $rute->update([
            'asal'          => $request->asal,
            'tujuan'        => $request->tujuan,
            'kode'          => $request->kode,
            'waktu_tempuh'  => $request->waktu_tempuh,
            'checkpoints'   => json_encode($request->checkpoints),
        ]);

        $rute->checkpoints = json_decode($rute->checkpoints, true);
        $terminals = Terminal::whereIn('id', array_column($rute->checkpoints, "id"))
        ->select('id', 'kode', 'nama', 'alamat', 'tipe')
        ->get();

        $rute->checkpoints = array_map(function($item) use ($terminals) {
            $item['terminal'] = $terminals->where('id', $item['id'])->first();
            return $item;
        }, $rute->checkpoints);

        if ($rute) {
            return response()->json(['status' => 'Data Rute berhasil diupdate', 'data' => $rute]);
        } else {
            return response()->json(['status' => 'Data Rute gagal diupdate']);
        }
    }


    public function destroy(Rute $rute)
    {
        if ($rute->delete()) {
            return response()->json(['status' => 'Data Rute berhasil dihapus']);
        } else {
            return response()->json(['status' => 'Data Rute gagal dihapus']);
        }
    }
}
