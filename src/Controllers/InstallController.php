<?php

namespace CyberCraft\OrderMate\Controllers;

use App\User;
use CyberCraft\OrderMate\models\Customer;
use CyberCraft\OrderMate\models\Order;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use Silber\Bouncer\BouncerFacade;
use Bouncer;

class InstallController extends Controller
{
    public function prompt() {
        $users = User::all();
        return view('ordermate::install.prompt', [
            'users' => $users
        ]);
    }

    public function install(Request $request) {
        //composer install
        //Artisan::call('composer install');

        //php artisan vendor publish of each package, including ordermate itself
        //bouncer
        Artisan::call('vendor:publish', ['--tag' => 'bouncer.migrations']);
        //metable
        //Artisan::call('vendor:publish --provider="Plank\Metable\MetableServiceProvider"');
        Artisan::call('vendor:publish', ['--provider' => 'Plank\Metable\MetableServiceProvider']);
        //vue localization
        Artisan::call('vendor:publish', ['--provider' => 'MartinLindhe\VueInternationalizationGenerator\GeneratorProvider'] );
        //package publishes
            //later
        //php artisan migrate
        //Artisan::call('migrate');

        //install roles and permission for bouncer
        $admin = Bouncer::role()->firstOrCreate([
            'name' => 'ordermate_admin',
            'title' => 'OrderMate Administrator',
        ]);
        Bouncer::allow('ordermate_admin')->toOwnEverything();
        $user = User::find(1);//$request->promptdata['user']['id']
        Bouncer::assign('ordermate_admin')->to($user);

        //abilities assigned to bouncer_admin role
        Bouncer::allow('bouncer_admin')->to([
            'browse' => [ Order::class, Customer::class],
            'create' => [ Order::class, Customer::class],
            'read' => [ Order::class, Customer::class],
            'edit' => [ Order::class, Customer::class],
            'delete' => [ Order::class, Customer::class],
        ]);

        return response()->json([
            'success' => true
        ]);
    }
}
