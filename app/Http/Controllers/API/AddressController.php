<?php

namespace App\Http\Controllers\API;

use App\Models\Address;
use Illuminate\Http\Request;


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
            'city' => 'string|required',
            'landmark' => 'string'
        ]);
     $add = Address::create([
         'street' => $fields['street'],
         'latitude' => $fields['latitude'],
         'longitude' => $fields['longitude'],
         'default' => $fields['default'],
         'country' => $request->input('country',"Nigeria"),
         'state' => $request->input('state',"Abuja"),
         'city' => $request->input('city',"Abuja"),
        'landmark' => $request->input('landmark'),
        'name' => $request->input("name"),
        'user_id' => auth()->user()->id,
     ]);
     return $this->sendCreateResponse($add,"Address successfully created");
    }

    public function index(Request $request)
    {
        $allAddress = Address::where('user_id', $request->user()->id)->get();
        return $this->sendResponse($allAddress,"Addressed fetched succesfully");
    }
    public function destroy($id){
        $add = Address::find($id);
        if($add){
            $add->delete();
            return $this->sendResponse($add,"Deleted Successfully");
        }
        return $this->sendError("Not a valid address");
    }
    public function edit(Request $request,$id){
        $fields = $request->validate([

            'default' => 'nullable|integer',
        ]);
        $add = Address::find($id);
        $lat =  $request->input('latitude');
        $long = $request->input('longitude');
        $default = $request->input('default');
        $country = $request->input('country');
        $state = $request->input('state');
        $city =  $request->input('city');
        $landmark = $request->input('landmark');
        $name= $request->input("name");
        $street = $request->input("street");
        if($add){
            $add->street = $street != null? $street: $add->street;
            $add->latitude = $lat != null ? $lat : $add->latitude;
            $add->longitude = $long != null ? $long : $add->longitude;
            $add->default = $default != null ? $default: $add->default;
            $add->country = $country != null ? $country: $add->country;
            $add->state = $state != null ? $state : $add->state;
            $add->city = $city != null ? $city : $add->city;
           $add->landmark = $landmark != null? $request->input('landmark'): $add->landmark;
           $add->name = $name != null? $request->input("name"): $add->name;
           $ad = $add->save();
           return $this->sendCreateResponse($ad,"Address was updated successfully");
        }

    }
}
