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
    public function view( $view_path, $data, Request $request ) {
        if( $request->wantsJson() ) {
            return response()->json($data);
        }
        return view($view_path,$data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
        if( !Bouncer::can('browse',Order::class) ) return view( 'ordermate::unauth');
        $items = (new Order())->with('customer');

        if( !isset($request->customer)) {
            $items = $items->paginate(10);
        } else {
            $items = $items->where( 'customer_id', $request->customer )->paginate(10);
        }

        if( $request->wantsJson() ) {
            return response()->json( [
                'items' => $items
            ] );
        }
        return $this->view('ordermate::orders.index', [
            'items' => $items
        ], $request );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( Request $request )
    {
        if( !Bouncer::can('create',Order::class) ) return view( 'ordermate::unauth');
        $order_statuses = config('ordermate.order_status');
        return $this->view('ordermate::orders.create', [
            'item' => new Order(),
            'order_statuses' => $order_statuses
        ], $request );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if( !Bouncer::can('create',Order::class) ) return view( 'ordermate::unauth');

        Validator::make($request->all(), [
            'phone' => 'required|numeric'
        ])->validate();
        $requestData = $request;
        //check if there already a customer with the phone number
        $customer = Customer::where('phone',$requestData->phone)->first();

        if( !$customer ) {
            $customer = Customer::create( $requestData->all() );
        }

        $requestData->request->set( 'customer_id', $customer->id);

        //set default post status if not set
        if( !isset( $requestData->order_status ) ) {
            $requestData->request->set( 'order_status', key( config('ordermate.order_status') ) );
        }

        Order::create( $requestData->all() );

        return redirect()->route('ordermate.orders.index')
            ->with('flash_message', 'Order added!')
            ->with('msg_status', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        if( !Bouncer::can('read',Order::class) ) return view( 'ordermate::unauth');

        $item = Order::with('customer')->find($id);

        return $this->view( 'ordermate::orders.show', [
            'item' => $item
        ], $request );
    }

    public function order_detail_pdf($id) {
        if( !Bouncer::can('read',Order::class) ) return view( 'ordermate::unauth');

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
        if( !Bouncer::can('edit',Order::class) ) return view( 'ordermate::unauth');
        $order_statuses = config('ordermate.order_status');

        $item = Order::with('customer')->find($id);

        return $this->view( 'ordermate::orders.edit', [
            'item' => $item,
            'order_statuses' => $order_statuses
        ], $request );
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
        if( !Bouncer::can('edit',Order::class) ) return view( 'ordermate::unauth');

        Validator::make($request->all(), [
            'phone' => 'required|numeric'
        ])->validate();

        $requestData = $request;

        //check if there already a customer with the phone number
        $customer = Customer::where('phone',$requestData->phone)->first();

        if( !$customer ) {
            $customer = Customer::create( $requestData->all() );
        }

        $requestData->request->set( 'customer_id', $customer->id);

        //set default post status if not set
        if( !isset( $requestData->order_status ) ) {
            $requestData->request->set( 'order_status', key(config('ordermate.order_status') ) );
        }

        $item = Order::find($id);

        if( $item ) {
            $item->fill( $requestData->all() )->save();
        }

        return redirect()->route('ordermate.orders.edit', $id)
            ->with('flash_message', 'Order added!')
            ->with('msg_status', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if( !Bouncer::can('delete',Order::class) ) return view( 'ordermate::unauth');

        Order::destroy($id);
        return redirect()->route('ordermate.orders.index')
            ->with('flash_message', 'Order deleted!')
            ->with('msg_status', 'danger');
    }
}
