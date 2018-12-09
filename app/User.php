<?php
 namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Transformers\UserTransformer;

class User extends Authenticatable
{

    use Notifiable ,SoftDeletes;
    const VERIFIED_USER = '1';
    const UNVERIFIED_USER = '0';
    const ADMIN_USER = 'true' ;
    const REGULAR_USER = 'false';
    protected $dates =['deleted_at'] ;
    protected $table =  'users' ;
    public $transformer = UserTransformer::class ;
    //not a good idea to keep values in boolean or int , should be string

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','verified','verification_token','admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
        // 'verification_token',
    ];

 public function isVerified(){
     return $this->verified == User::VERIFIED_USER;
 }

 public function isAdmin(){
    return $this->admin == User::ADMIN_USER;
}

// public function setNameAttribute($name){
//     $this->attributes['name'] = strtolower($name) ;
// }

// public function getNameAttribute(){
//     return ucwords($name) ;
// }

// public function setEmailAttribute($email){
//     $this->attributes['email'] = strtolower($email) ;
// }

//generating verification code manually
public static function generateVerificationCode(){
    return str_random(40);
}
}
