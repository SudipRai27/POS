<?php

namespace Modules\Products\Entities;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['category_name','description'];

    protected $table = 'product_category';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
