<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Country;
use App\Models\Proxy;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        // returns json with all orders in database
        return response()->json($orders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'proxies_ordered' => 'required|numeric',
            'country_code' => 'required|string',
            
        ]);

        // return json message if name is longer then 30 symbols
        if(strlen($request->name) > 30) {
            return response()->json(['success' => false, 'message' => 'Max name length is 30 symbols']);
        }

        // returns json message if ordered proxies is more then 100
        if($request->proxies_ordered > 100) {
            return response()->json(['success' => false, 'message' => 'Max proxies to order is 100']);
        }

        // checks if requested country code is in the database
        $country = Country::where('country_code', '=', $request->country_code)->first();
        if ($country === null) {
            return response()->json(['success' => false, 'message' => 'Not valid country code']);
        } else {
            $order = new Order([
                'name' => $request->name,
                'country_id' => $country->id,
                'proxies_ordered' => $request->proxies_ordered,
            ]);
            $order->save();

            for($i=0; $i<$request->proxies_ordered; $i++){
                $proxy = new Proxy([
                    'order_id' => $order->id,
                    'proxy' => long2ip(mt_rand()),
                ]);
                $proxy->save();
            }
            return response()->json(['success' => true, 'message' => 'Order created successfully']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $order = Order::find($request->order_id);
        // checks if order id is valid or not
        if($order === null){
            return response()->json(['success' => false, 'message' => 'No such order']);
        } else {
            return response()->json($order);
        }
    }
}
