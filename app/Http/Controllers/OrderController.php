<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.orders', [
            'orders' => Order::all()
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('dashboard.order_details', [
            'order' => $order,
            'count' => OrderDetail::where('order_id', $order->id)->get()->SUM('quantity')
        ]);
    }

    /**
     * Update the order to processing.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function process(Order $order)
    {
        Order::where('id', $order->id)->update([
            'status' => Order::PROCESSING,
            'update_by' => Auth::id()
        ]);

        return response()->json('Order started processing');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function assign(Order $order)
    {
        //Get category record
        //$order = Order::findOrFail($id);

        $data = [
            'order'    =>  $order,
            'bikers' => User::where('role_id', 4)->get()
        ];

        return response()->json($data);

        //return view('dashboard/edit_category', $data);
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
