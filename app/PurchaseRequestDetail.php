<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequestDetail extends Model
{
    use HasFactory;
    protected $table = 'purchase_request_details';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function purchase_request()
    {
    	return $this->belongsTo(PurchaseRequest::class, 'purchase_id');
    }

    public function product()
    {
    	return $this->belongsTo(Product::class, 'product_id');
    }
}
