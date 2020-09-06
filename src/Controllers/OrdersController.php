<?php

namespace CyberCraft\OrderMate\Controllers;

use CyberCraft\OrderMate\models\Customer;
use CyberCraft\OrderMate\models\Order;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Bouncer;

class OrdersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
        if( !Bouncer::can('browse',Order::class) ) return view( 'ordermate::unauth', [ 'success' => false ]);
        $items = (new Order())->with('customer');

        if( !isset($request->customer)) {
            $items = $items->paginate(10);
        } else {
            $items = $items->where( 'customer_id', $request->customer )->paginate(10);
        }

        return view('ordermate::orders.index', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( Request $request )
    {
        if( !Bouncer::can('create',Order::class) ) return view( 'ordermate::unauth', [ 'success' => false ]);
        $order_statuses = config('ordermate.order_status');
        $item = new Order();
        $customer = new Customer();
        $item->customer = $customer;

        return view('ordermate::orders.create', [
            'item' => $item,
            'order_statuses' => $order_statuses
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if( !Bouncer::can('create',Order::class) ) return view( 'ordermate::unauth', [ 'success' => false ]);

        $validator = Validator::make($request->all(), [
            'phone' => 'required|numeric'
        ]);

        if( $validator->fails() ) {
            return redirect()->route('ordermate.orders.create')
                ->withErrors($validator)
                ->withInput();
        }

        //check if there already a customer with the phone number
        $customer = Customer::where('phone',$request->phone)->first();

        if( !$customer ) {
            $customer = Customer::create( $request->all() );
        }

        $request->request->set( 'customer_id', $customer->id);

        //set default post status if not set
        if( !isset( $request->order_status ) ) {
            $request->request->set( 'order_status', key( config('ordermate.order_status') ) );
        }

        $item = Order::create( $request->all() );
        return view('ordermate.orders.index', [
            'success' => true,
            'flash_message' => 'Order added!',
            'msg_status' => 'success',
            'item' => $item
        ]);
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
        if( !Bouncer::can('edit',Order::class) ) return view( 'ordermate::unauth', [ 'success' => false ]);

        if( $request->wantsJson() ) {
            $validator = Validator::make( array_merge( $request->all(), $request->customer ), [
                'phone' => 'required|numeric'
            ]);

            if( $validator->fails() ) {
                return view('ordermate.ordermate.create',[
                    'errors' => $validator->errors(),
                    'success' => false
                ], $request);
            }

            //check if there already a customer with the phone number
            $customer = Customer::where('phone',$request->customer['phone'])->first();

            if( !$customer ) {
                $customer = Customer::create( $request->customer );
            }
        } else {
            Validator::make($request->all(), [
                'phone' => 'required|numeric'
            ])->validate();

            //check if there already a customer with the phone number
            $customer = Customer::where('phone',$request->phone)->first();

            if( !$customer ) {
                $customer = Customer::create( $request->all() );
            }
        }

        $request->request->set( 'customer_id', $customer->id);

        //set default post status if not set
        if( !isset( $request->order_status ) ) {
            $request->request->set( 'order_status', key(config('ordermate.order_status') ) );
        }

        $item = Order::with('customer')->find($id);

        if( $item ) {
            $item->fill( $request->all() )->save();
        }

        return view( 'ordermate::orders.edit', [
            'success' => true,
            'flash_message' => 'Order updated!',
            'msg_status' => 'success',
            'item' => $item
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        if( !Bouncer::can('read',Order::class) ) return view( 'ordermate::unauth', [ 'success' => false ]);;

        $item = Order::with('customer')->find($id);

        return view( 'ordermate::orders.show', [
            'item' => $item
        ], $request );
    }

    public function order_detail_pdf($id) {
        if( !Bouncer::can('read',Order::class) ) return view( 'ordermate::unauth', [ 'success' => false ] );;

        $item = Order::with('customer')->find($id);

        $pdf = \PDF::loadView('ordermate::orders.show', [
            'item' => $item
        ]);
        return $pdf->download('invoice.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        if( !Bouncer::can('edit',Order::class) ) return view( 'ordermate::unauth', [ 'success' => false ]);;
        $order_statuses = config('ordermate.order_status');

        $item = Order::with('customer')->find($id);

        return view( 'ordermate::orders.edit', [
            'item' => $item,
            'order_statuses' => $order_statuses
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        if( !Bouncer::can('delete',Order::class) ) return view( 'ordermate::unauth', [ 'success' => false ]);

        Order::destroy($id);
        return view( 'ordermate.orders.index', [
            'success' => true,
            'flash_message' => 'Order deleted !',
            'msg_status' => 'danger',
        ]);
    }
}
