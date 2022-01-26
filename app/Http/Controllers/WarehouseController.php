<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Warehouse;
use App\Models\State;
use App\Models\Lga;
use Illuminate\Support\Str;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.stores', [
            'stores' => Warehouse::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.add_store', [
            'states' => State::all()
        ]);
    }

    public function FetchStateLgas($id)
    {
        $lgas = Lga::where('state_id', $id)->get();

        $res = json_decode($lgas);
        foreach ($lgas as $lga) {
            echo "<option value=''>Select LGA</option><option value='" . $lga->id . "'>$lga->name</option>";
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'store_name'     => 'required|string',
            'state' => 'required|numeric',
            'lga' => 'required|numeric',
            'street' => 'required|string',
            'zip' => 'required|numeric',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        Warehouse::create([
            'name' => $request->store_name,
            'state_id' => $request->state,
            'lga_id' => $request->lga,
            'slug' => Str::slug($request->store_name),
            'street' => $request->street,
            'zipcode' => $request->zip,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude
        ]);

        return redirect('dashboard/stores')->withSuccess('Warehouse created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
