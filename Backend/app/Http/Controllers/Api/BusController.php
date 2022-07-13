<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bus;
use Illuminate\Http\Request;

class BusController extends Controller
{
    public function index()
    {
        $buses = Bus::paginate();

        if ($buses->count() > 0) {
            return response()->json(['message' => 'Data Bus berhasil di GET', 'data' => $buses]);
        } else {
            return response()->json(['message' => 'Data Bus tidak ditemukan']);
        }
    }


    public function store(Request $request)
    {
        $request->validate([
            'plate_number'  => 'required',
            'bus_number'    => 'required',
            'distributor'   => 'required',
            'ukuran'        => 'required|int',
        ]);

        $bus = Bus::create($request->all());

        if ($bus) {
            return response()->json(['message' => 'Bus berhasil diinput', 'data' => $bus]);
        } else {
            return response()->json(['message' => 'Bus gagal diinput']);
        }
    }


    public function show(Bus $bus)
    {
        if ($bus) {
            return response()->json(['message' => 'Bus berhasil diambil', 'data' => $bus]);
        } else {
            return response()->json(['message' => 'Bus tidak ditemukan']);
        }
    }


    public function update(Request $request, Bus $bus)
    {
        $request->validate([
            'plate_number'  => 'required',
            'bus_number'    => 'required',
            'distributor'   => 'required',
            'ukuran'        => 'required|int',
        ]);

        $bus->update($request->all());
        if ( ($bus)->exixts() ) {
            return response()->json(['message' => 'Bus berhasil diupdate', 'data' => $bus]);
        } else {
            return response()->json(['message' => 'Bus gagal diupdate']);
        }
    }


    public function destroy(Bus $bus)
    {
        $bus->delete();

        if ($bus) {
            return response()->json(['message' => 'Bus berhasil dihapus', 'data' => $bus]);
        } else {
            return response()->json(['message' => 'Bus gagal dihapus']);
        }
    }

}
