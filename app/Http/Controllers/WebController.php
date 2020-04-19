<?php

namespace App\Http\Controllers;

use App\Category;
use App\Order;
use App\Product;
use App\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class WebController extends Controller
{
    public function home(){
        return view('home-page');
    }

    public function product($id){
        $product=Product::find($id);
        $brand = Brand::find($product->brand_id);
        $category=Category::find($product->category_id);
        $img =explode(",",$product->gallery);
        $brand_product =$brand->Products()->take(4)->get();
        $category_product =Category::find($product->category_id)->Products()->take(4)->get();
        return view('product',['product'=>$product,'category_product'=>$category_product,'brand_product'=>$brand_product,'brand'=>$brand,'img'=>$img,'category'=>$category]);
    }
    public function listingcate($id){
        $categories = Category::find($id);
        $product = $categories->Products()->paginate(9);
        return view('listcate',['product'=>$product,'categories'=>$categories]);
    }
        public function listingBrand($id){
        $brand = Brand::find($id);
        $product=$brand->Products()->paginate(9);
        return view("list_brand",['product'=>$product,'brand'=>$brand]);
    }
    public function shopping($id, Request $request){
        $product=Product::find($id);
        $cart =$request->session()->get("cart");

        if($cart==null){
            $cart=[];
        }
        foreach ($cart as $p){
            if($p->id == $product->id){
                $p->cart_qty =$p->cart_qty+1;
                session(["cart"=>$cart]);
                return redirect()->to("/cart");
            }
        }
        $product->cart_qty=1;
        $cart[]=$product;
        session(["cart"=>$cart]);
        return redirect()->to("/cart");
    }
    public function pshopping($id, Request $request){
        $product=Product::find($id);
        $cart =$request->session()->get("cart");
        $request->validate([
            'qty'=> 'required | string',
        ]);
        if($cart==null){
            $cart=[];
        }
        foreach ($cart as $p){
            if($p->id == $product->id){
                $p->cart_qty =$p->cart_qty+$request->get("qty");
                session(["cart"=>$cart]);
                return redirect()->to("/cart");
            }
        }
        $product->cart_qty=$request->get("qty");
        $cart[]=$product;
        session(["cart"=>$cart]);
        return redirect()->to("/cart");
    }


    public function cart(Request $request){
        $cart = $request->session()->get("cart");
        if($cart == null){
            $cart = [];
        }
        $cart_total = 0 ;
        foreach ($cart as $p){
            $cart_total += ($p->price*$p->cart_qty);
        }
        return view("cart",["cart"=>$cart,'cart_total'=>$cart_total]);

    }
    public function updateCart(Request $request){
        if(!$cart=session()->has("cart")){
            return redirect()->to("/");
        }
        $cart =$request-> session()->get('cart');

        if($cart==null){
            $cart=[];
        }
        foreach ($cart as $p){
            $product = Product::find($p->id);
                $p->cart_qty =$request->input("qty/$p->id");
                $cart[] = $product;
            }

        return redirect()->to("/cart");
    }


    public function reduceOne($id,Request $request){
        if(!$cart=session()->has("cart")){
            return redirect()->to("/");
        }
        $cart =$request-> session()->get('cart');
        foreach ($cart as $p){
            if($p->id ==$id){
                $p->cart_qty-=1;
                return redirect()->to("/cart");
            }
        }
        return redirect()->to("/cart");
    }
    public function increaseOne($id,Request $request){
        if(!$cart=session()->has("cart")){
            return redirect()->to("/");
        }
        $cart =$request-> session()->get('cart');
        foreach ($cart as $p){
            if($p->id ==$id){
                $p->cart_qty+=1;
                return redirect()->to("/cart");
            }
        }
        return redirect()->to("/cart");
    }


    public function deleteItemCart($id){
        $cartOld = session()->get("cart");
        session()->forget("cart");
        $cart=session()->get("cart");
        if($cart == null){
            $cart = [];
        }
        foreach ($cartOld as $c){
            if ($c->id !=$id){
                $product = Product::find($c->id);
                $product->cart_qty =$c->cart_qty;
                $cart[] = $product;
                session(["cart"=>$cart]);
            }
        }
        return redirect()->to("/cart");
    }

public function log(){
        return view('log');
}

    public function clearCart(Request $request){
        $request->session()->forget("cart");
        return redirect()->to("/");
    }


    public function checkout(Request $request){
        if(!$request->session()->has("cart")){
            return redirect()->to("/");
        }
        $cart = $request->session()->get('cart');
        $cart_total = 0;
        foreach ($cart as $p){
            $cart_total += ($p->price * $p->cart_qty);
        }
        return view("checkout",["cart"=>$cart,'cart_total'=>$cart_total]);
    }
    public function placeOrder(Request $request){
        $request->validate([
            'customer_name'=> 'required | string',
            'shipping_address' => 'required',
            'payment_method'=> 'required',
            'telephone'=> 'required',
        ]);

        $cart = $request->session()->get('cart');
        $grand_total = 0;
        foreach ($cart as $p){
            $grand_total += ($p->price * $p->cart_qty);
        }
        $order = Order::create([
            'user_id'=>Auth::id(),
            'customer_name'=> $request->get("customer_name"),
            'shipping_address'=> $request->get("shipping_address"),
            'telephone'=> $request->get("telephone"),
            'grand_total'=> $grand_total,
            'payment_method'=> $request->get("payment_method"),
            "status"=> Order::STATUS_PENDING
        ]);
        foreach ($cart as $p){

            $product = Product::find($p->id);
            $product->update([
                "quantity" => $product->quantity-$p->cart_qty,
                "purchase" => $product->purchase+$p->cart_qty,


            ]);
            DB::table("order_product")->insert([
                'order_id'=> $order->id,
                'product_id'=>$p->id,
                'qty'=>$p->cart_qty,
                'price'=>$p->price
            ]);
        }
//        Mail::to(Auth::user()->email)->send(new OrderCreated($order,$cart));
        return redirect()->to("/checkout-success");
    }

    public function deleteOrder($id)
    {
        $order = Order::find($id);
        try {
            if ($order->status != Order::STATUS_CANCEL) {
                $order->status = Order::STATUS_CANCEL;
                $order->save();
            }
        } catch (\Exception $e) {
            return redirect()->back();
        }
//        Mail::to(Auth::user()->email)->send(new CancelOrder($order));
        return redirect()->to("listOrder");
    }


    public function checkoutSuccess(){
        return view("checkoutSuccess");
    }
    public function increase($id,Request $request){
        $email = $request->get("qty");
        dd($email);
        $pass = $request->get("password");
        if(Auth::attempt(['email'=>$email,'password'=>$pass])){
            return response()->json(['status'=>true,'message'=>"Login successfully!"]);
        }
        return response()->json(['status'=>false,'message'=>"login failure"]);
    }
}
