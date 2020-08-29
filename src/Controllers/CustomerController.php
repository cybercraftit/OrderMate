<?php

namespace CyberCraft\OrderMate\Controllers;

use CyberCraft\OrderMate\models\Customer;
use CyberCraft\OrderMate\models\Order;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Bouncer;

class CustomerController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( !Bouncer::can('browse',Customer::class) ) return view( 'ordermate::unauth');

        $items = Customer::paginate(10);
        return view( 'ordermate::customers.index', compact('items') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if( !Bouncer::can('create',Customer::class) ) return view( 'ordermate::unauth');
        return view( 'ordermate::customers.create', [ 'item' => new Customer() ] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if( !Bouncer::can('create',Customer::class) ) return view( 'ordermate::unauth');

        Validator::make($request->all(), [
            'phone' => 'required|unique:CyberCraft\OrderMate\models\Customer,phone',
            'email' => 'required',
        ])->validate();

        $requestData = $request;
        $customer = Customer::create( $requestData->all() );

        return redirect()->route('ordermate.customers.index')
            ->with('flash_message', 'Order added!')
            ->with('msg_status', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if( !Bouncer::can('read',Customer::class) ) return view( 'ordermate::unauth');

        $item = Customer::find($id);
        return view('ordermate::customers.show', [
            'item' => $item
        ] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if( !Bouncer::can('edit',Customer::class) ) return view( 'ordermate::unauth');

        $item = Customer::find($id);
        return view('ordermate::customers.edit', [
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
        if( !Bouncer::can('edit',Customer::class) ) return view( 'ordermate::unauth');

        Validator::make($request->all(), [
            'phone' => 'required|unique:CyberCraft\OrderMate\models\Customer,phone,'.$id.',id',
            'email' => 'required',
        ])->validate();

        $requestData = $request;
        $item = Customer::find($id);

        if( $item ) {
            $item->fill( $requestData->all() )->save();
        }

        return redirect()->route('ordermate.customers.edit', $id )
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
        if( !Bouncer::can('delete',Customer::class) ) return view( 'ordermate::unauth');

        Customer::destroy($id);
        return redirect()->route('ordermate.customers.index')
            ->with('flash_message', 'Order deleted!')
            ->with('msg_status', 'danger');
    }
}
