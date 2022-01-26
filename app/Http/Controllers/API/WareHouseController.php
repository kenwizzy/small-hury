<?php

namespace App\Http\Controllers\API;

use App\Models\Warehouse;
use Illuminate\Http\Request;


class WareHouseController extends BaseController
{
    public function index(Request $request){
        return $this->sendResponse(Warehouse::all(), 'Store locations fetched successfully.');
    }
}
