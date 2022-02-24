<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Mail\AssignOrderMail;
use App\Models\OrderAssignee;
use App\Mail\ProcessOrderMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public $orderImgUrl = "asset('assets/imag/small-hurry-cart.jpg')";
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

        (new NotificationService())->sendNotificationToUser($order->user_id, $order->user->token, 'Order Processing', 'Hi ' . $order->user->first_name . ',<br>Your order with ID ' . $order->id . ' has started processing', $this->orderImgUrl, '');
        Mail::to($order->user->email)->send(new ProcessOrderMail($order));
        return $this->notice(Auth::id(), 'Order Processing', 'Order with ID ' . $order->id . ' has started processing', $this->orderImgUrl, '');
        return response()->json('Order started processing');
    }


    public function decline(Order $order)
    {
        if ($order->status == Order::DECLINED) {
            return redirect()->back()->withError('Order Already Declined');
        }

        Order::where('id', $order->id)->update([
            'status' => Order::DECLINED,
            'update_by' => Auth::id()
        ]);
        $msg = 'Order with ID ' . $order->id . ' has been declined by ' . Auth::user()->first_name . ' ' . Auth::user()->first_name . '(' . Auth::user()->role->name . ')';
        //(new NotificationService())->sendNotificationToUser($order->user_id, $order->user->token, 'Order Processing', 'Hi ' . $order->user->first_name . ',<br>Your order with ID ' . $order->id . ' has started processing', $this->orderImgUrl, '');
        $this->notice(Auth::id(), 'Order Declined', $msg, $this->orderImgUrl, '');
        return redirect()->back()->withSuccess('Order Declined Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getBikers(Order $order)
    {
        $data = [
            'order'    =>  $order,
            'bikers' => User::where('role_id', 4)->get()
        ];
        return response()->json($data);
    }

    public function assignBiker(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'biker'     => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $order = Order::where('id', $request->order)->first();
        if ($order->status == Order::PROCESSING) {
            return redirect()->back()->withErrors('Order is still processing');
        }

        if ($order->status == Order::AWAITING_FULFILLMENT) {
            return redirect()->back()->withErrors('Order processing not started');
        }
        try {
            DB::beginTransaction();
            $data = new OrderAssignee();
            $data->user_id = $request->biker;
            $data->order_id = $request->order;
            $data->order_accepted = 'No';
            $data->save();


            $order->status = Order::AWAITING_SHIPMENT;
            $order->save();
            DB::commit();
        } catch (\Exception $err) {
            DB::rollBack();
        }
        $content = 'An order with ID ' . $order->id . ' has been assigned to ' . $order->user->first_name . ' ' . $order->user->last_name . ' for delivery.';
        $output = [];
        $output['order'] = $order;
        $output['biker'] = User::where('id', $data->user_id)->first();
        if ($data->id !== null) {
            (new NotificationService())->sendNotificationToUser($order->user_id, $order->user->token, 'Order Assigned', 'Hi ' . $order->user->first_name . ',<br>An order with ID ' . $order->id . ' has been assigned to you for delivery<br>Kindly login to the app to accept the order', $this->orderImgUrl, '');
            Mail::to($data->user->email)
                ->cc($order->warehouse->email)
                ->send(new AssignOrderMail($output));
            return $this->notice(Auth::id(), 'Order Assigned', $content);
        }

        return redirect()->back()->withSuccess('Order assigned to biker successfully');
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

    private function notice($user_id, $subject, $body)
    {
        Notification::create([
            'user_id' => $user_id,
            'subject' => $subject,
            'body' => $body
        ]);
    }
}
