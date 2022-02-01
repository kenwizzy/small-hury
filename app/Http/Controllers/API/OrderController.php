<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use App\Services\NotificationService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends BaseController
{
    private $notSer;
    public function __construct(NotificationService $notSer)
    {
        $this->notSer = $notSer;
    }

    public function index()
    {
       $user = User::find(auth()->user()->id);
       $data = $user->orders;
       foreach($data as $key =>$order){
         $data[$key]['order_detail'] =  $order->order_details()->select('product_name','quantity')->get();
       }

       return $this->sendResponse($data,"Orders fetched successfully");
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
            'contact' => 'required',
            'date' => 'required',
            'timeSlot' => 'required',
            'addressId' =>'required|integer',
            'cartId' => 'required|integer'
        ]);
        $newOrder =[];
        $delDetailId =5;

        $user = User::find(Auth::id());

        //Validation for items in cart
        $cart = Cart::find($fields['cartId']);
        if(!$cart){
            return $this->sendError('Cart Does not exists',[],404);
        }
        $products = $cart->products;
        foreach($products as $product){
            $doesExist = false;
            foreach($fields['cartItems'] as $cartItem){
                $doesExist = $product->id == $cartItem['id'];
                if($doesExist) break;
            }
            if(!$doesExist){
                return $this->sendError("Items Does not exists in table",[],404);
            }
        }
        $newOrder = (object)[];
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

            $user->clear_cart();
            DB::commit();
        }catch(\Exception $err){
            DB::rollBack();
            return $this->sendError("Order Could not be processed".$err->getMessage(),[],500);
        }
        $this->notSer->sendNotificationToUser($user->id,$user->app_token,"Order Successfully Created",
        "Your Order with order no ".$newOrder->id."has been created, we will reach out to you!",
        asset('assets/images/users/default.png'),"Thank you!");
        return $this->sendCreateResponse(['order' => $newOrder],"Order successfully Created!");
    }

    public function cancelOrder(Order $id)
    {
        $id->status = Order::CANCELLED;
        $id->save();
        return $this->sendResponse($id,"Order successfully cancelled");
    }
    //We'll work on this feature on a later date
    public function reOrder(Request $request, Order $id)
    {
        $fields = $request->validate([
            'warehouse_id' => 'required|integer'
        ]);
        $user = User::find(Auth::user()->id);
        $orderDetails = $id->order_details;
        $success = [];
        $successCount = 0;
        $errors = [];
        $errorCount = 0;
        $cart = $user->cart;

        foreach($orderDetails as $orderDetail){
            $productQuantity = $orderDetail->quantity;
            $product = Product::findOrFail($orderDetail->product_id);

            if ($cart) {
                $products = $cart->products;

                if($products->contains($product)){

                    $cart = $cart->increase_product($product,$fields['warehouse_id'],$productQuantity);
                    $success[] = 'product with name '.$product->name .' succesfully incremented';
                    $successCount++;

                }
                //if product not in cart
                else{
                    $cart = $cart->add_product($product,$fields['warehouse_id'],$productQuantity);
                    //if item was successfully added to cart due to the fact that they exist in that warehouse
                    if($cart){
                        $successCount++;
                        $success[] = 'new product added to cart with name '.$product->name;

                    }
                     else{

                        $errorCount++;
                        $errors[] = "product with name ".$product->name . " doesn't exist in warehouse";
                     }
                 }

            }
            //This should occur once when the existing user does not have item in cart
            else {

                $cart = $user->add_new_product_to_cart($product,$fields['warehouse_id']);
                $success[] = "new cart created for user and product with name ".$product->name." added";
                $successCount++;
            }

        }//End of foreach loop

        return $this->sendResponse([
            "productsAdded" => $successCount,
            "cartId" =>$cart['id'],
            "products" => $cart['products']
        ],['messages' => [
            "errors"=>$errors,
            "success"=>$success
        ]]);


    }


}
