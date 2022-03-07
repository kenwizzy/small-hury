<?php

namespace App\Http\Controllers\API;


use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Warehouse;
use App\Models\OrderDetail;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\CreateOrderMail;
use App\Services\NotificationService;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Address;
use App\Models\DeliveryDetail;

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

        foreach ($data as $key => $order) {
            $data[$key]['order_detail'] =  $order->order_details()->select('product_name', 'quantity')->get();
        }

        return $this->sendResponse(array_reverse($data->toArray()), "Orders fetched successfully");
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'discount' => 'nullable|numeric',
            'paymentMethod' => 'required|string',
            'netCost' => 'required|numeric',
            'deliveryCost' => 'required|numeric',
            'grossCost' => 'required|numeric',
            'cartItems' => 'array|required',
            'cartItems.*.id' => 'integer|required',
            'cartItems.*.quantity' => 'integer|required',
            'cartItems.*.name' => 'string|required',
            'contact' => 'required',
            'addressId' => 'required|integer',
            'cartId' => 'required|integer'
        ]);

        $newOrder = [];
        $delDetailId = 5;

        $user = User::find(Auth::id());

        //Validation for items in cart
        $cart = Cart::find($fields['cartId']);
        if (!$cart) {
            return $this->sendError('Cart Does not exists', [], 404);
        }
        $products = $cart->products;
        foreach ($products as $product) {
            $doesExist = false;
            foreach ($fields['cartItems'] as $cartItem) {
                $doesExist = $product->id == $cartItem['id'];
                if ($doesExist) break;
            }
            if (!$doesExist) {
                return $this->sendError("Items Does not exists in table", [], 404);
            }
        }
        $newOrder = (object)[];
        try {
            DB::beginTransaction();
           $add = Address::find($fields['addressId']);
           $fields['warehouse_id'] = $add->warehouse_id;
            $newOrder = Order::create([
                'user_id' => Auth::user()->id,
                'total_products_price' => $fields['grossCost'],
                'total_shipping_price' => $fields['deliveryCost'],
                'total_paid' => $fields['netCost'],
                'status' => Order::AWAITING_FULFILLMENT,
                'warehouse_id' => $fields['warehouse_id'],
                'payment_status' => $fields['paymentMethod'] == DeliveryDetail::PAY_ON_DELIVERY ? 0 : 1,
            ]);

            $delDetailId = DB::table('delivery_details')
                ->insertGetId([
                    'order_id' => $newOrder->id,
                    'delivery_contact' => $fields['contact'],
                    'address_id' => $fields['addressId'],
                    'payment_method' => $fields['paymentMethod'],
                    'delivery_phone' => $request->input('phone') || $fields['contact'],
                    'delivery_note' => $request->input('note'),
                    'delivery_reference' => $request->input('reference')

                ]);
            foreach ($fields['cartItems'] as $cartItem) {
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
        } catch (\Exception $err) {
            DB::rollBack();
            return $this->sendError("Order Could not be processed" . $err->getMessage(), [], 500);
        }
        $this->notSer->sendNotificationToUser(
            $user->id,
            $user->app_token,
            "Order Successfully Created",
            "Your Order with order no " . $newOrder->id . " has been created, we will reach out to you!",
            asset('assets/images/users/default1.png'),
            "Thank you!"
        );
        ########## SEND MAIL TO ADMIN AND CONCERNED STORE ######
        $data = [];
        $data['link'] = url('/');
        $data['order'] = $newOrder;
        $data['user'] = User::find($newOrder->user_id);
        $store = Warehouse::where('id', $fields['warehouse_id'])->first();
        $content = 'A new order with order number ' . $newOrder->id . ' has been created';
        $this->notice($store->user_id, 'Order Created', $content);
        Log::info($newOrder);
        Mail::to('orders@smallhurry.com')
            ->cc($store->email)
            ->send(new CreateOrderMail($data));
        //Also send Invoice to customer
        return $this->sendCreateResponse(['order' => $newOrder], "Order successfully Created!");
    }

    public function cancelOrder(Order $id)
    {
        $id->status = Order::CANCELLED;
        $id->save();
        return $this->sendResponse($id, "Order successfully cancelled");
    }
    //We'll work on this feature on a later date
    public function reOrder(Request $request, Order $id)
    {

        $user = User::find(Auth::user()->id);
        $orderDetails = $id->order_details;
        $success = [];
        $successCount = 0;
        $errors = [];
        $errorCount = 0;
        $cart = $user->cart;

        foreach ($orderDetails as $orderDetail) {
            $productQuantity = $orderDetail->quantity;
            $product = Product::findOrFail($orderDetail->product_id);

            if ($cart) {
                $products = $cart->products;

                if ($products->contains($product)) {

                    $cart = $cart->increase_product($product, $productQuantity);
                    $success[] = 'product with name ' . $product->name . ' succesfully incremented';
                    $successCount++;
                }
                //if product not in cart
                else {
                    $cart = $cart->add_product($product,  $productQuantity);
                    //if item was successfully added to cart due to the fact that they exist in that warehouse
                    if ($cart) {
                        $successCount++;
                        $success[] = 'new product added to cart with name ' . $product->name;
                    } else {

                        $errorCount++;
                        $errors[] = "product with name " . $product->name . " doesn't exist in warehouse";
                    }
                }
            }
            //This should occur once when the existing user does not have item in cart
            else {

                $cart = $user->add_new_product_to_cart($product);
                $success[] = "new cart created for user and product with name " . $product->name . " added";
                $successCount++;
            }
        } //End of foreach loop

        return $this->sendResponse([
            "productsAdded" => $successCount,
            "cartId" => $cart['id'],
            "products" => $cart['products']
        ], ['messages' => [
            "errors" => $errors,
            "success" => $success
        ]]);
    }
    private function addWishlistAndInCart(Product $product)
    {
        $wishlist = $product->wishlists()->where('user_id', auth()->user()->id)->first();


        // get the number of items in cart
        $user = User::find(auth()->user()->id);
        $quantity = 0;
        if ($user->cart) {
            $quantity = $user->cart->product_quantity($product);
        }
        $image_url = $product->DefaultImage()->first()->image_url;

        $newProduct = collect($product)
            ->merge(['wishlist' => $wishlist ? true : false, "incart" => $quantity,'image_url'=>$image_url]);
        return $newProduct;
    }
    public function show(Order $id)
    {

        $data = $id->order_details;
        $orderDetails = [];
        foreach ($data as $orderDetail) {
            $newDetail = (object)[];
            $newDetail->quantity = $orderDetail->quantity;
            $newDetail->created_at = $orderDetail->created_at;
            $newDetail->product = $this->addWishlistAndInCart($orderDetail->product);
            $orderDetails[] = $newDetail;
        }
        $delD = $id->delivery_detail;
        $order = (object)[];
        $order = collect($id)->except(['order_details', 'delivery_detail'])
            ->merge(["time_slot" => $delD->time_interval, 'delivery_date' => $delD->delivery_date]);
        // $order->time_slot = $delD->time_interval;
        // $order->delivery_date = $delD->delivery_date;
        // Log::info($delD->time_interval);

        return $this->sendResponse(['order' => $order, 'products' => $orderDetails], "Order successfully fetched");
    }

    public function complete(Order $id)
    {
        $id->payment_status = 1;
        $id->status = Order::COMPLETED;
        $id->save();
        return $this->sendResponse($id,"Order Succesfully created");
    }
    public function storeRating(Request $request)
    {
        $fields = $request->validate([
            'orderId' => 'required|integer',
            'comment' => 'nullable',
            'overallRating' => 'integer|nullable',
            'deliveryRating' => 'integer|nullable'

        ]);

        $id = DB::table('rate_orders')->insertGetId([
            'user_id' => auth()->user()->id,
            'comment' => $request->input('comment'),
            'order_id' => $fields['orderId'],
            'delivery_rating' => $request->input('deliveryRating'),
            'overall_rating' => $request->input('overallRating')
        ]);

        if ($id) {
            return $this->sendResponse(["id" => $id], "Rating stored");
        }
        return $this->sendError("Could not store data", [], 500);
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
