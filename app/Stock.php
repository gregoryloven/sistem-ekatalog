<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $table = 'stocks';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function product()
    {
    	return $this->belongsTo(Product::class, 'product_id');
    }
}
