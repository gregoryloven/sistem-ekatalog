<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    use HasFactory;
    protected $table = 'purchase_requests';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
