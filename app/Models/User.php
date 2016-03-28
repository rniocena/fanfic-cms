<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class User extends Model{

    /**
     * Define global model variables
     */

    public static $user;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Authenticate user based on the portal
     */
    public static function auth(array $credentials, $log_session = TRUE)
    {
        $user = User::
        where('email', $credentials['email'])
            ->first();

        if($user === NULL)
        {
            return FALSE;
        }
        else
        {
            if(Hash::check($credentials['password'], $user->password))
            {
                // Put logged in User ID in sessions
                if($log_session)
                {
                    Session::put('user_id', $user->id);
                }

                // Put User object into model global variable
                self::$user = $user;

                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }

    }

    /**
     * Check if a user is logged in for the given portal
     */
    public static function check()
    {
        if(Session::has('user_id'))
        {
            $user = User::get();

            if($user) {
                return TRUE;
            }
        }

        return FALSE;
    }

    /**
     * Log user out
     */
    public static function logout()
    {
        Session::flush();

        return TRUE;
    }

    /**
     * Select the logged in user object
     */
    public static function get()
    {
        if(self::$user)
        {
            return self::$user;
        }

        if(Session::has('user_id'))
        {
            $user = User::find(Session::get('user_id'));

            if($user)
            {
                self::$user = $user;
                return $user;
            }
        }

        return FALSE;
    }

    public function checkRole($seller_id, $user_id)
    {
//        $userLinkSeller = UserLinkSellers::getUserSeller($seller_id, $user_id);
//
//        $roles = [];
//
//        if($userLinkSeller) {
//            $userLinkSellerRoles = UserLinkSellerRoles::where('user_link_seller_id', $userLinkSeller->id)->get();
//
//            if($userLinkSellerRoles) {
//                foreach($userLinkSellerRoles as $userRole) {
//                    $roles[] = $userRole->roles->role;
//                }
//            } else {
//                $roles = null;
//            }
//        } else {
//            $userLinkSeller = null;
//        }
//
//
//        return $roles;
    }

    public function isSuperAdmin($user_id)
    {
        $user = User::where('id', $user_id)->first();

        $isSuperAdmin = false;

        if($user->super_admin == 1) {
            $isSuperAdmin = true;
        }

        return $isSuperAdmin;
    }
}
