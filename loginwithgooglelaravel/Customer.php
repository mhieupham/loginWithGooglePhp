<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $table = 'tbl_customer';
    protected $fillable = ['customer_name','customer_email','customer_password','customer_address','customer_numberphone'];
    protected $primaryKey = 'customer_id';

}
