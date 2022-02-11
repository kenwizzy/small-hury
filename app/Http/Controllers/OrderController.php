<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\NotificationService;

class OrderController extends Controller
{
    private $notificationService;

    // public function __contruct(NotificationService $notificationService)
    // {
    // 	$this->notificationService = $notificationService;
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Auth::user()->role->name == 'Warehouse Manager' ?
        //     $products = $this->productData()->where('warehouses.user_id', Auth::id())->get()
        //     : $products = $this->productData()

        return view('dashboard.orders', [
            // Auth::user()->role->name == 'Warehouse Manager' ?
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

        (new NotificationService())->sendNotificationToUser($order->user_id, '', 'Order Processing', 'Hi ' . $order->user->first_name . ',<br>Your order with ID ' . $order->id . ' has started processing', '', '');

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
        $data = [
            'order'    =>  $order,
            'bikers' => User::where('role_id', 4)->get()
        ];



        return response()->json($data);
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
