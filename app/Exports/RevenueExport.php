<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
class RevenueExport implements FromCollection,WithMapping,WithHeadings
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */

    // a place to store the team dependency
    private $revenues;

    // use constructor to handle dependency injection
    public function __construct($revenues)
    {
        $this->revenues = $revenues;
    }

    public function collection()
    {
        return $this->revenues;
    }

    public function map($member): array
    {
        $out='';
        foreach($member->order_details as $res){
            $out = $res->product->name.' '.$res->quantity;
        }
        return [
            $member->id,
            $member->customer->first_name.' '.$member->customer->last_name,
            $out,
            number_format($member->total_paid,2),
            $member->delivery->payment_method??'',
            $member->payment_status==1?'Paid':'Not Paid'
         
        ];
    }

    public function headings():array{
        return[
            'Order ID',
            'Customer Name',
            'Product',
            'Total Price',
            'Payment Method',
            'Payment Status' 
        ];
    } 

    
}
