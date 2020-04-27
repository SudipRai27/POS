<?php

namespace Modules\Suppliers\Entities;

use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    protected $fillable = ['supplier_code', 'supplier_name', 
    					   'address', 'contact_person', 'phone_no',
    					   'status'
    						];

   	protected $table = 'suppliers';
}
