<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Models\AttributeValue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.attributes', [
            'attributes' => Attribute::where('id', '<>', 1)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function FetchAttributeValues($id)
    {
        $values = AttributeValue::where('attribute_id', $id)->get();

        $res = json_decode($values);
        $data = "<option>Select Value</option>";
        foreach ($values as $lga) {
            $data .= "<option value='" . $lga->id . "'>$lga->attribute_val_name</option>";
        }

        echo $data;
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
            'name'     => 'required|string',
            'values' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $data = explode(",", $request->values);

        DB::transaction(function () use ($request,$data) {
        $attribute = new Attribute();
        $attribute->name = $request->name;
        $attribute->save();

        foreach ($data as $mad) {
            AttributeValue::create([
                'attribute_id' => $attribute->id,
                'attribute_val_name' => $mad
            ]);
        }

    });

        return redirect()->back()->withSuccess('Attribute created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function show(Attribute $attribute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function edit(Attribute $attribute)
    {
        // dd($attribute);
        return view('dashboard/edit_attribute', [
            'attribute' => $attribute
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attribute $attribute)
    {
        $validator = Validator::make($request->all(), [
            'value.*' => 'required',
            'name'  => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $disc = Attribute::find($attribute->id);
        $disc->name = $request->name;
        $disc->save();

        foreach ($request->value as $attValue) {
            $output = AttributeValue::find($disc->id);
            $output->attribute_val_name = $attValue;
            $output->save();
        }

        return redirect('dashboard/attributes')->withSuccess('Attribute updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attribute $attribute)

    {
        $attr = Attribute::find($attribute->id);
        AttributeValue::where('attribute_id', $attr->id)->delete();
        $attr->delete();
        return redirect()->back()->withSuccess('Attribute deleted successfully');
    }
}
