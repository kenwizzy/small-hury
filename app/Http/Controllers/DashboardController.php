<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Warehouse;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.index', [
            'warehouses' => Warehouse::all(),
            'orders' => Order::all(),
            'products'=> Product::all(),
            'users' => User::where('role_id', 4)->get(),
            //'transactions' => Transaction::all(),
            'orderstatus'=>Order::where('status',5)->get(),
            'customers' => User::where('role_id', 5)->orderBy('id', 'asc')->get(),
            'charts'=> $this->storeOrderStats(),
            'jan' => $this->month('01'),
            'feb' => $this->month('02'),
            'mar' => $this->month('03'),
            'apr' => $this->month('04'),
            'may' => $this->month('05'),
            'jun' => $this->month('06'),
            'jul' => $this->month('07'),
            'aug' => $this->month('08'),
            'sep' => $this->month('09'),
            'oct' => $this->month('10'),
            'nov' => $this->month('11'),
            'dec' => $this->month('12')
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

    public function storeOrderStats(){
        return DB::table('orders')->selectRaw('sum(orders.total_paid) as amt,orders.warehouse_id,count(orders.id) as id,warehouses.name')
        ->join('warehouses', 'warehouses.id', 'orders.warehouse_id')
        ->groupby('orders.warehouse_id')
       ->where('orders.payment_status',1)
        ->get();
        //return $result = DB::select("SELECT SUM(orders.total_paid) as amt, orders.warehouse_id, COUNT(orders.id) as orders_count FROM orders RIGHT JOIN warehouses ON orders.warehouse_id = warehouses.id WHERE orders.payment_status = 1 GROUP BY orders.warehouse_id");
        // $ids = collect($result)->map(fn($item) => $item->warehouse_id);
        // $warehouses = DB::select("SELECT name, id FROM warehouse WHERE id IN ?",[$ids]);
        // collect($result)->merge()
        
    }

    public function month($month){
        return DB::table('orders')->selectRaw('total_paid')
       ->where('orders.payment_status',1)
       ->whereMonth('created_at',$month) 
        ->SUM('total_paid');
    }
}
