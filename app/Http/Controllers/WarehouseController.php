<?php

namespace App\Http\Controllers;

use App\Models\Lga;
use App\Models\User;
use App\Models\State;
use App\Models\Warehouse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
            'users' => User::where('role_id', 3)->get(),
            // 'users' => DB::table('users')
            //     ->join('warehouses', 'users.id', 'manager')
            //     //->join('attributes', 'attribute_values.attribute_id', '=', 'attributes.id')
            //     ->where('users.role_id', 3)
            //     //->where('users.id', '<>', 'manager')
            //     ->get(),
            'states' => State::all()
        ]);
    }

    public function FetchStateLgas($id)
    {
        $lgas = Lga::where('state_id', $id)->get();

        $res = json_decode($lgas);
        echo "<option value=''>Select LGA</option>";
        foreach ($lgas as $lga) {
            echo "<option value='" . $lga->id . "'>$lga->name</option>";
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
            'manager' => 'required|numeric|unique:warehouses',
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
            'manager' => $request->manager,
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
    public function show(Warehouse $warehouse)
    {
        return view('dashboard/store_details', [
            'warehouse' => $warehouse
        ]);
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


    public function assign(Warehouse $warehouse)
    {

        $data = [
            'store'  =>  $warehouse,
            'bikers' => User::where('role_id', 3)->select('id', 'first_name', 'last_name')->get()
        ];

        return response()->json($data);
    }

    public function assignManager(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'manager'     => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $user = User::find($request->manager);
        $store = Warehouse::find($request->store);
        if ($store->user_id != 0) {
            return redirect()->back()->withError($store->name . ' already has a manager');
        }
        $store->user_id = $request->manager;
        $store->save();

        return redirect()->back()->withSuccess($user->first_name . ' ' . $user->last_name . ' assigned a ' . $store->name . ' store manager');
    }
}
