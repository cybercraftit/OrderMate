<?php

namespace CyberCraft\OrderMate\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;

class AjaxController extends Controller
{
    public function get_users(Request $request) {
        if( !isset( $request->user_query ) ) return [];
        return User::where( 'email', 'like', '%'.$request->user_query.'%' )
            ->orWhere( 'name', $request->user_query )
            ->get();
    }

    public function makePdf() {
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML();
        return $pdf->stream();
    }
}
