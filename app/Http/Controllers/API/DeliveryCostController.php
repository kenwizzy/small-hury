<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\DB;

class DeliveryCostController extends BaseController
{


    public function index(){
       $data = DB::table('delivery_costs')->select(['id','price_range','cost'])->get();
       return $this->sendResponse($data,"Delivery cost fetched successfully");
    }


}
