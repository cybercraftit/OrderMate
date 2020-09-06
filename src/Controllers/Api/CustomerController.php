<?php

namespace CyberCraft\OrderMate\Controllers\Api;

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
        if( !Bouncer::can('browse',Customer::class) ) return response()->json( [ 'success' => false, 'msg' => 'Action not allowed !' ]);

        $items = Customer::paginate(10);
        return response()->json( [
            'success' => true,
            'items' => $items
        ] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if( !Bouncer::can('create',Customer::class) ) return response()->json( [ 'success' => false, 'msg' => 'Action not allowed !' ]);
        $item = new Customer();
        return response()->json([
            'success' => true,
            'item' => $item
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
        if( !Bouncer::can('create',Customer::class) ) return response()->json( [ 'success' => false, 'msg' => 'Action not allowed !' ]);

        $validator = Validator::make($request->all(), [
            'phone' => 'required|unique:CyberCraft\OrderMate\models\Customer,phone',
            'email' => 'required',
        ]);

        if( $validator->fails() ) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }


        $customer = Customer::create( $request->all() );

        return response()->json([
            'success' => true,
            'flash_message' => 'Customer Added !',
            'msg_status' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if( !Bouncer::can('read',Customer::class) ) return response()->json( [ 'success' => false, 'msg' => 'Action not allowed !' ]);

        $item = Customer::find($id);
        return response()->json( [
            'success' => true,
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
        if( !Bouncer::can('edit',Customer::class) ) return response()->json( [ 'success' => false, 'msg' => 'Action not allowed !' ]);

        $item = Customer::find($id);
        return response()->json([
            'success' => true,
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
        if( !Bouncer::can('edit',Customer::class) ) return response()->json( [ 'success' => false, 'msg' => 'Action not allowed !' ]);

        Validator::make($request->all(), [
            'phone' => 'required|unique:CyberCraft\OrderMate\models\Customer,phone,'.$id.',id',
            'email' => 'required',
        ])->validate();

        $requestData = $request;
        $item = Customer::find($id);

        if( $item ) {
            $item->fill( $requestData->all() )->save();
        }

        return response()->json( [
            'success' => true,
            'flash_message' => 'Customer Updated !',
            'msg_status' => 'success',
            'item' => $item
        ] );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if( !Bouncer::can('delete',Customer::class) ) return response()->json( [ 'success' => false, 'msg' => 'Action not allowed !' ]);

        Customer::destroy($id);
        return response()->json([
            'success' => true,
            'flash_message' => 'Customer Deleted !',
            'msg_status' => 'danger',
        ] );
    }
}
