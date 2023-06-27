<?php

namespace App\Http\Controllers;

use App\Models\Images;
use App\Models\SocialNetwork;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\Section;
use App\Models\ShipmentType;
use Illuminate\Http\Request;

class ShippingMethodsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $sections = Section::all();
        $socialnetworks = SocialNetwork::all();
        $images = Images::where('seleccionada', 1)->get();
        $cartId = $request->input('cart_id');
        $userId = auth()->id();
        $order = $request->session()->get('order');
        $user = User::find($userId);
        $address = strtolower($user->address);
        $shipment_types = ShipmentType::all();

        $cart = Cart::content();
        $product = Product::all();

        return view('shippingmethod', compact('shipment_types','sections', 'cartId', 'cart', 'product', 'order','socialnetworks','images'));
    }

}