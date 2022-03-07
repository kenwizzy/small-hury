<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
class OrderExport implements FromCollection,WithMapping,WithHeadings
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */

    // a place to store the team dependency
    private $orders;

    // use constructor to handle dependency injection
    public function __construct($orders)
    {
        $this->orders = $orders;
    }

    public function collection()
    {
        return $this->orders;
    }

    public function map($order): array
    {
        
        return [
            $order->id,
            $order->warehouse->name,
            number_format($order->total_products_price,2),
            number_format($order->total_shipping_price,2),
            number_format($order->total_paid,2),
            $order->payment_status==1?'Paid':'Not Paid',
            $order->starus->name,
            \Carbon\Carbon::parse($order->created_at, 'UTC')->isoFormat('MMMM Do YYYY, h:mm:ssa'),
         
        ];
    }

    public function headings():array{
        return[
            'Order ID',
            'Store',
            'Total Product Price',
            'Shipping Price',
            'Total Amount',
            'Payment Status',
            'Order Status',
            'Order Date' 
        ];
    } 

    
}
