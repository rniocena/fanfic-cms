<?php namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller {

    protected $roles = null;
    protected $super_admin = false;

    public function __construct()
    {
        // Require that the user is a guest (logged out)
        $this->middleware('guest', ['only' => ['getLogin', 'postLogin']]);

        // Require that the user is logged in
        $this->middleware('auth', ['only' => ['getLogout', 'getProfile']]);

        if(User::get()) {

//            $this->roles = User::get()->checkRole(Seller::get()->id, User::get()->id);

            $this->super_admin = User::get()->isSuperAdmin(User::$user->id);
        }

//        View::share('user_roles', $this->roles);

        View::share('super_admin', $this->super_admin);
    }

    public function getDashboard()
    {
//        $website_views = WebsiteViews::all();
//        $total_pending = Bookings::where('pending', 1)->count();
//        $total_consulted = Bookings::where('consulted', 1)->count();
//        $total_completed = Bookings::where('completed', 1)->count();
//        $total_cancelled = Bookings::where('cancelled', 1)->count();
//
//        $total_service_sales = 0;
//        $total_shop_sales = 0;

        return View::make('dashboard.dashboard');
    }

}
