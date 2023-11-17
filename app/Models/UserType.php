<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;

    protected $table='user_types';

    protected $fillable = ['id','name' ];

     public $role = ['Admin', 'Manager', 'Staff', 'Cashier'];

    const admin     = 'Admin';

    const manager   = 'Manager';

    const staff     = 'Staff';

    const user      = 'User';

    const cashier   = 'Cashier';

    // const audit = 'Audit';
}
