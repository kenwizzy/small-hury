<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\WarehouseDistrict;
use App\Http\Controllers\Controller;

class WarehouseDistrictController extends BaseController
{
    public function index(Request $request){
        return $this->sendResponse(WarehouseDistrict::all(), 'Store districts fetched successfully.');
    }
}
