<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function purchaseRequestDetails()
    {
        return $this->hasMany(PurchaseRequestDetail::class, 'product_id');
    }
}
