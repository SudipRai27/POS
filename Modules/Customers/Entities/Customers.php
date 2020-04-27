<?php

namespace Modules\Customers\Entities;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $fillable = ['customer_code', 'customer_name', 
    					   'address', 'phone_no', 
    					   'customer_note', 'status'
    						];
}
