<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends BaseController
{


    public function index()
    {
       $data = Order::where('user_id',auth()->user()->id)
       ->get();
       foreach($data as $key =>$order){
         $data[$key]['order_detail'] =  $order->order_detail()->select('product_id','quantity')->get();
       }

       return $this->sendResponse($data,"Delivery cost fetched successfully");
    }

    public function store(Request $request)
    {
        $fields= $request->validate([
            'discount' =>'nullable|numeric',
            'paymentMethod' => 'required|string',
            'netCost' => 'required|numeric',
            'deliveryCost' => 'required|numeric',
            'grossCost' => 'required|numeric',
            'warehouse_id' => 'required|integer',
            'cartItems' => 'array|required',
            'cartItems.*.id' => 'integer|required',
            'cartItems.*.quantity' => 'integer|required',
            'cartItems.*.name' => 'string|required',
            'contact' => 'string|required',
            'date' => 'required',
            'timeSlot' => 'required',
            'addressId' =>'required|integer'
        ]);
        $newOrder =[];
        $delDetailId =5;
        try{
            DB::beginTransaction();
           $newOrder = Order::create([
                'user_id' => Auth::user()->id,
                'total_products_price' => $fields['grossCost'],
                'total_shipping_price' => $fields['deliveryCost'],
                'total_paid' => $fields['netCost'],
                'status' => Order::AWAITING_FULFILLMENT,
                'warehouse_id' => $fields['warehouse_id'],
            ]);
            $date = explode('/',$fields['date']);
            $day = $date[0];
            $month = $date[1];
            $year = $date[2];

            $delDetailId = DB::table('delivery_details')
                        ->insertGetId([
                            'order_id' => $newOrder->id,
                            'delivery_contact' => $fields['contact'],
                            'address_id' => $fields['addressId'],
                            'payment_method' => $fields['paymentMethod'],
                            'delivery_date' => Carbon::create($year,$month,$day,0)->toDateTimeString(),
                            'time_interval' => $fields['timeSlot'],
                            'delivery_phone' => $request->input('phone') || $fields['contact'],
                            'delivery_note' => $request->input('note'),
                            'delivery_reference' => $request->input('reference')

                        ]);
            foreach($fields['cartItems'] as $cartItem){
                OrderDetail::create([
                    'order_id' => $newOrder->id,
                    'product_id' => $cartItem['id'],
                    'product_name' => $cartItem['name'],
                    'quantity' => $cartItem['quantity'],
                    'delivery_detail_id' => $delDetailId
                ]);
            }
            DB::commit();
        }catch(\Exception $err){
            DB::rollBack();
            return $this->sendError("Order Could not be processed".$err->getMessage(),[],500);
        }
        return $this->sendCreateResponse(['order' => $newOrder],"Order successfully Created!");
    }


}
