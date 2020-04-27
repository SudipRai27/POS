<?php

namespace Modules\Products\Entities;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = ['product_code', 'product_name', 'description', 'sales_price' ,'category_id', 'subcategory_id', 'image', 'status'];

    protected $table = 'products';

    protected $guarded = ['id', 'created_at', 'updated_at'];

   
}
