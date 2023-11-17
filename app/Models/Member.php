<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;
use App\Models\Country;
use URL;

class Member extends Model
{
    //HasApiTokens,
    use  HasFactory, Notifiable;
    protected $table = 'members';
    protected $fillable = [
        'id', 'name', 'email', 'phone', 'image', 'password', 'device_token', 'user_token'
    ];

  
    protected $hidden = [
        'password', 'remember_token',
    ];

  
    protected $casts = [
        'email_verified_at' => 'datetime',
        // 'phone_verified_at' => 'datetime',
    ];




    /*
    *
    *   Get Member API Data
    *
    */

    public function getMemberApi($member_id){
        $user = [];

        $customer = Member::where('id', '=', $member_id)->get()[0];
        // $customer = Member::find($member_id);

        if(!$customer || empty($customer))
        {
            return $user;
        }

        $user = array(
            "id"    => $customer['id'],
            "name"  => $customer['name'],
            "email" => ($customer['email'] == NULL)?"":$customer['email'],
            "phone" => ($customer['phone'] == NULL)?"":$customer['phone'],
            "image" => ($customer['image'] == NULL)?"":base_url($customer['image']),
            "country_id"   => $customer->country->id,
            "country_name" => $customer->country->name,
            "device_token" => $customer['device_token'],
            "created_at" => strtotime($customer['created_at']),
            "updated_at" => strtotime($customer['updated_at']),
        );

        return $user;
    }


    /*
    *
    *   Eloquent methods
    *
    */

    public function issues()
    {
        return $this->hasMany(Issue::class);
    }
}
