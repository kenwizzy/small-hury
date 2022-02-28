<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderAssignee;

class OrderAssigneeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function accept($id)
    {
        return $this->acceptOrDecline($id,'Accepted','Yes');
    }

    public function decline($id)
    {
        return $this->acceptOrDecline($id,'Declined','No');
    }


    public function active(Request $request)
    {
        return $this->getOrderStatus('active');
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

    public function history()
    {
        $orders=OrderAssignee::with('order')->where('user_id',auth()->user()->id)->get();
        if (empty($orders)) {
            return $this->sendError('Records not found');
       }
        return $this->sendResponse($orders, "Orders fetched successfully");
    }

    public function pending(Request $request)
    {
        return $this->getOrderStatus('pending');
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

    public function acceptOrDecline($id,$acceptordecline,$yesOrNo){
        $resp = OrderAssignee::where('order_id',$id)->where('user_id',auth()->user()->id)->first();
        if (empty($resp)) {
            return $this->sendError('Record not found');
       }
       if ($acceptordecline=='Accepted') {
           $resp->update([
            'status'=> $acceptordecline,
            'order_accepted' => $yesOrNo,
            'order_acceptance_time' => now()
        ]);
       } elseif($acceptordecline == 'Declined'){
        $resp->update([
            'status'=> $acceptordecline,
            'order_accepted' => $yesOrNo,
            'order_rejected_time' => now()
        ]);

    }

        return $this->sendResponse($resp, "Order ".$acceptordecline." successfully");
    }

    public function getOrderStatus($res){
        $user = User::find(auth()->user()->id);
        //$user = User::find(4);
        $data = $user->orderAssigns()->where('status',$res)->get();
         if (empty($data)) {
              return $this->sendError('Record not found');
         }
             $output= [];
             foreach ($data as $order) {
                 $output['customer'] =  $order->order->customer;
                 $output['order_details'] =  $order->order->order_details;
                 $output['delivery'] =  $order->order->delivery;
                 $output['address'] =  $order->order->delivery->address;
             }

             return $this->sendResponse($output, "Orders fetched successfully");
    }
}
