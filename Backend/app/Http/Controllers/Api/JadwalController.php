<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Rute;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::whereDate('berangkat', '>=', now())->paginate(15);

        if ($jadwals->count() > 0) {
            return response()->json(['message' => 'Data Jadwal berhasil di GET', 'data' => $jadwals]);
        } else {
            return response()->json(['message' => 'Data Jadwal masih ksong']);
        }
    }


    public function store(Request $request)
    {
        $request->validate([
            'bus_id'        => 'required|exists:buses,id',
            'supir_id'      => 'required|exists:supirs,id',
            'rute_id'       => 'required|exists:rutes,id',
            'berangkat'     => 'required',
        ]);

        $rute = Rute::find($request->rute_id);
        $berangkat = (new Carbon($request->berangkat))->toImmutable()->setTimeZone('Asia/Jakarta');
        $tiba = $berangkat->addMinutes($rute->waktu_tempuh);

        $jadwal = Jadwal::create([
            'bus_id'        => $request->bus_id,
            'supir_id'      => $request->supir_id,
            'rute_id'       => $request->rute_id,
            'berangkat'     => $berangkat,
            'tiba'          => $tiba,
            'status'        => Jadwal::NGY,
        ]);

        if ($jadwal) {
            return response()->json(['message' => 'Jadwal berhasil diinput', 'data' => $jadwal]);
        } else {
            return response()->json(['message' => 'Jadwal gagal diinput']);
        }
    }


    public function show(Jadwal $jadwal)
    {
        if ( ($jadwal)->exists() ) {
            return response()->json(['message' => 'Jadwal berhasil diambil', 'data' => $jadwal]);
        } else {
            return response()->json(['message' => 'Jadwal tidak ditemukan']);
        }
    }


    public function update(Request $request, Jadwal $jadwal)
    {
        $request->validate([
            'bus_id'        => 'required|exists:buses,id',
            'supir_id'      => 'required|exists:supirs,id',
            'rute_id'       => 'required|exists:rutes,id',
            'berangkat'     => 'required',
        ]);

        $rute = Rute::find($request->rute_id);
        $berangkat = (new Carbon($request->berangkat))->toImmutable()->setTimeZone('Asia/Jakarta');
        $tiba = $berangkat->addMinutes($rute->waktu_tempuh);

        $jadwal->update([
            'bus_id'        => $request->bus_id,
            'supir_id'      => $request->supir_id,
            'rute_id'       => $request->rute_id,
            'berangkat'     => $berangkat,
            'tiba'          => $tiba,
            // 'status'        => Jadwal::NGY,
        ]);
        if ($jadwal) {
            return response()->json(['message' => 'Jadwal berhasil diupdate', 'data' => $jadwal]);
        } else {
            return response()->json(['message' => 'Jadwal gagal diupdate']);
        }
    }


    public function destroy(Jadwal $jadwal)
    {
        if ($jadwal->delete()) {
            return response()->json(['message' => 'Jadwal berhasil dihapus', 'data' => $jadwal]);
        } else {
            return response()->json(['message' => 'Jadwal gagal dihapus']);
        }
    }
}
