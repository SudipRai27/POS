<?php

namespace Modules\Products\Entities;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable = ['subcategory_name','description','category_id'];

    protected $table = 'product_subcategory';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public static function getTableName()
    {
    	return with(new static)->getTable();
    }
}
