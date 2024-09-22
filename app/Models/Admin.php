<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Hash;
class Admin extends Authenticatable
{
    protected $table = 'sys_user';
    static $field_group ;
    static $guard_name = '';
    static $roleGroup;
    static $roleFunction;
    protected $auth;
    use Notifiable;

    public function __construct(){
        self::$guard_name = "admin";
        $this->auth = auth("admin")->user();
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public static function _key()
    {
        return Auth::guard("admin")->user()->getKeyName();
    }
    public static function _table()
    {
        return Auth::guard("admin")->user()->getTable();
    }
    public static function _name($field)
    {
        return Auth::guard("admin")->user()->{$field};
    }

    public static function _full_name()
    {
        return Auth::guard("admin")->name();
    }

    public static function role_group_table(){
        $role_group = auth("admin")->role();
        return $role_group['table'];
    }
    public static function role_group_key(){
        $role_group = auth("admin")->role();
        return $role_group['id'];
    }

    public static function _id()
    {
        return Auth::guard("admin")->id();
    }

    public static function Hash_password($value)
    {
        $password = Hash::make($value);
        return $password;
    }

    public static function check_password($cur_password)
    {
        return Hash::check($cur_password,Auth::guard("admin")->user()->password);
    }

    public static function check_password_string($cur_password,$pass)
    {
        return Hash::check($cur_password,$pass);
    }
    public function change_password($cur_password)
    {
        $user_id = Auth::guard("admin")->user()->id;
        $obj_user = User::find($user_id);
        $obj_user->password = Hash::make($cur_password);
        $obj_user->save();
    }
    // public static function group(){
    //     $role_group = auth("admin")->role();
    //     $group = md::find_cache($role_group['table'],$role_group['table'],$role_group['id']."='".auth("admin")->group()."'");
    //     return $group;
    // }
    // public static function role_group(){
    //     $role_group = auth("admin")->role();
    //     $_function = md::scalar($role_group['table'],$role_group['id']."='".auth("admin")->group()."'",$role_group['role']);
    //     $function = \h::array_group_alone(json_decode($_function,true),'function_id');
    //     return $function;
    // }
    public function scopeGetAttribute($value){
        return $this->auth->{$value};
    }
    public function scopeName(){
        return $this->auth->{auth("admin")->user()->nameKey};
    }
    public function scopeGroupID()
    {
        $groupField = auth("admin")->user()->primaryGroup;
        $group = $this->auth->{$groupField};
        return $group;
    }
    public static function group(){
        if(\h::session("roleGroup")==""){
            $role_group = auth("admin")->user()->role_group;
            $groupField = auth("admin")->user()->primaryGroup;
            $group = auth("admin")->user()->{$groupField};
            $result = md::find_cache($role_group['table'],$role_group['table'],$role_group['id']."='$group'");
            \h::session_put("roleGroup",$result);
        }
        return \h::session("roleGroup");
    }
    public static function role_group(){
        if(!empty(auth("admin")->user()->role_group)){
            if(\h::session("roleFunction")==""){
                $role_group = auth("admin")->user()->role_group;
                $groupField = auth("admin")->user()->primaryGroup;
                $group = auth("admin")->user()->{$groupField};
                $_function = md::scalar($role_group['table'],$role_group['id']."='$group'",$role_group['role']);
                $function = \h::array_group_alone(json_decode($_function,true),'function_id');
                \h::session_put("roleFunction",$function);
            }
            return \h::session("roleFunction");
        }
        else{
            return null;
        }
    }
}
