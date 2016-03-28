<?php namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Webpatser\Uuid\Uuid;
use Illuminate\Auth;

class UserController extends Controller {

    protected $roles = null;
    protected $super_admin = false;

    /**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {
        // Require that the user is a guest (logged out)
        $this->middleware('guest', ['only' => ['getLogin', 'postLogin']]);

        // Require that the user is logged in
        $this->middleware('auth', ['only' => ['getLogout', 'getProfile']]);

        if(User::get()) {
            $this->super_admin = User::get()->isSuperAdmin(User::$user->id);
        }

        View::share('super_admin', $this->super_admin);

        return View::make('welcome',[
            'users' => User::all()
        ]);
    }

    /**
     * User login
     *
     * GET
     */
    public function getUsers()
    {
        return View::make('welcome',[
            'users' => User::all()
        ]);
    }

    /**
     * User login
     *
     * POST
     */
    public function postLogin()
    {
        $user = User::auth(array('email' => Input::get('email'), 'password' => Input::get('password')));

        if($user)
        {
            return Redirect::to('/home');
        }
        else
        {
            Session::flash('error', 'Invalid email or password!');
            return Redirect::to('user/login');
        }
    }

    /**
     * User logout
     */
    public function anyLogout()
    {
        User::logout();

        if(User::logout()) {
            return Redirect::to('user/login');
        } else {
            return Redirect::to('/home');
        }
    }

    public function anyRegister()
    {
        $page_title = 'Login';

        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ];

        $validator = \Validator::make(Input::all(), $rules);

        $error_msg = [];

        // If registering
        if (Request::isMethod('post'))
        {
            if(!$validator->fails()) {
                $first_name = Input::get('first_name');
                $last_name = Input::get('last_name');
                $email = Input::get('email');
                $password = Input::get('password');

                // check email is not already taken
                $existing_email = User::where("email", '=', $email)->count();

                if ($existing_email == 0) {
                    // create user account
                    $user = new User;
                    $user->uid = Uuid::generate()->string;
                    $user->first_name = $first_name;
                    $user->last_name = $last_name;
                    $user->email = $email;
                    $user->password = Hash::make($password);
                    $user->save();

                    // log user in
                    Auth::login($user);

                    return Redirect::to('/')->with('registration_success', true);
                }
            } else {
                $error_msg[] = 'Invalid email and password';

                return Redirect::back()->withErrors($validator)->withInput();
            }
        } else {
            $user = User::check();

            if($user)
            {
                return Redirect::to('/home');
            } else {
                return View::make('account.signup', array('page_title' => $page_title, 'error_msg' => $error_msg));
            }
        }
    }

    public function anyMyBookings()
    {
        $bookings = NULL;

        if(User::check()) {
            $bookings = Bookings::
            where('user_id', User::get()->id)
                ->orderBy('updated_at', 'DESC')
                ->get();
        }

        return view('account.my_bookings', [
            'bookings' => $bookings
        ]);
    }

}
