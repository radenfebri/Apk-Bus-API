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
        return response()->json($buses);
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
        return response()->json($bus);
    }


    public function show(Bus $bus)
    {
        return response()->json($bus);
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
        return response()->json($bus);
    }


    public function destroy(Bus $bus)
    {
        $bus->delete();
        return response()->json($bus);
    }

}
