<?php

namespace App;

use App\Models\Order;
use App\Models\Wishlist;
use App\Models\FamilyRelation;
use App\Models\ProductCompare;
use App\Models\ShippingAddress;
use App\Models\UserFollower;
use App\Models\QAAnswer;
use App\Models\QA;
use App\Models\Upvote;
use App\Models\QAAnswerLike;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    public mixed $email;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'f_name', 'l_name', 'name', 'email', 'password', 'phone', 'image', 'login_medium','is_active','social_id','is_phone_verified','temporary_token','referral_code','referred_by','street_address','country','city','zip'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'integer',
        'is_phone_verified'=>'integer',
        'is_email_verified' => 'integer',
        'wallet_balance'=>'float',
        'loyalty_point'=>'float',
        'referred_by'=>'integer',
    ];

    public function wish_list()
    {
        return $this->hasMany(Wishlist::class, 'customer_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function shipping()
    {
        return $this->belongsTo(ShippingAddress::class, 'shipping_address');
    }
    public function compare_list()
    {
        return $this->hasMany(ProductCompare::class, 'user_id');
    }

    public function children(){
        return $this->hasMany(FamilyRelation::class,'user_id','id');
    }
    
    public function followers()
    {
        return $this->hasMany(UserFollower::class, 'userID');
    }

    public function answers()
    {
        return $this->hasMany(QAAnswer::class, 'userID');
    }

    public function qa()
    {
        return $this->hasMany(QA::class, 'user_id');
    }

    public function upvotes()
    {
        return $this->hasMany(Upvote::class, 'userID');
    }

    public function likes()
    {
        return $this->hasMany(QAAnswerLike::class, 'userID');
    }

}
