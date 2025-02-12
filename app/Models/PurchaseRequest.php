<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    protected $table = 'purchase_requests';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function purchaseRequestDetails()
    {
        return $this->hasMany(PurchaseRequestDetail::class, 'purchase_id');
    }

}
