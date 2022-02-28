<?php

namespace App\Http\Controllers\API;

use App\Models\Address;
use App\Models\WarehouseDistrict;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AddressController extends BaseController
{
    public function create(Request $request)
    {
        $fields = $request->validate([
            'street'=>'string|required',
            'latitude'=>'required|string',
            'longitude' => 'required|string',
            'default' => 'nullable|integer',
            'name' => 'string|required',
            'state' => 'string|required',
            'landmark' => 'string',
            'district' => 'required'
        ]);

        if($request->input('default') != null && $request->input('default') == 1){
            Address::where('default',1)
                    ->update(['default' => 0]);

        }
    try{
        DB::beginTransaction();
        $district = WarehouseDistrict::find($fields['district']);

        $add = Address::create([
            'street' => $fields['street'],
            'latitude' => $fields['latitude'],
            'longitude' => $fields['longitude'],
            'default' => $request->input('default')?$fields['default']:0,
            'country' => $request->input('country',"Nigeria"),
            'state' => $request->input('state',"Abuja"),
            'city' => $district->name,
           'landmark' => $request->input('landmark'),
           'name' => $request->input("name"),
           'pincode' =>$request->input('pincode'),
           'user_id' => auth()->user()->id,
           'district_id'=> $district->id,
           'warehouse_id' => $district->warehouse_id
        ]);
        Log::info($add);
        DB::commit();
    }

     catch(\Exception $err){
        DB::rollBack();
     }
     return $this->sendCreateResponse($add,"Address successfully created");
    }

    public function index(Request $request)
    {
        $allAddress = Address::where('user_id', $request->user()->id)->get();
        return $this->sendResponse($allAddress,"Addressed fetched succesfully");
    }
    public function destroy($id)
    {
        $add = Address::find($id);
        if($add){
            $add->delete();
            return $this->sendResponse($add,"Deleted Successfully");
        }
        return $this->sendError("Not a valid address");
    }
    public function edit(Request $request,$id)
    {
        $fields = $request->validate([

            'default' => 'nullable|integer',
        ]);
        $add = Address::find($id);

        $lat =  $request->input('latitude');
        $long = $request->input('longitude');
        $default = $request->input('default');
        $country = $request->input('country');
        $state = $request->input('state');

        $landmark = $request->input('landmark');
        $name= $request->input("name");
        $street = $request->input("street");
        $pincode = $request->input("pincode");
        $district = $request->input('district');

        if($add){
            if(isset($default) && $default == 1 && $default != $add->default){
                Address::where('default',1)
                ->update(['default' => 0]);
            }
            $add->street = $street != null? $street: $add->street;
            $add->latitude = $lat != null ? $lat : $add->latitude;
            $add->longitude = $long != null ? $long : $add->longitude;
            $add->default = $default != null ? $default: $add->default;
            $add->country = $country != null ? $country: $add->country;
            $add->state = $state != null ? $state : $add->state;

           $add->landmark = $landmark != null? $request->input('landmark'): $add->landmark;
           $add->name = $name != null? $request->input("name"): $add->name;
           $add->pincode = $name != null? $pincode: $add->pincode;
           if($district){
               $dist = WarehouseDistrict::find($district);
               $add->city = $dist->name;
               $add->warehouse_id = $dist->warehouse_id;
               $add->district_id = $dist->id;
           }
            $add->save();
           return $this->sendCreateResponse($add,"Address was updated successfully");
        }

    }

    public function getDefaultAddress()
    {
        $add = Address::where([
            'default'=>1,
            'user_id' => auth()->user()->id
        ])->first();
        return $this->sendResponse($add,"Default address fetched successfully");

    }
}
