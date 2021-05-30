<?php

namespace App;

use App\Traits\CooperationAccountTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use SoftDeletes;

    use CooperationAccountTrait;

    protected $fillable = [
        'product_id',
        'product_category_id',
        'title',
        'image',
        'description',
        'unit',
        'initial_amount',
        'remaining_number',
        'blocked_number',
        'price',
        'predicted_price',
        'tax',
        'star',
        'type',
        'state',
        'created_by',
        'updated_by',
        'deleted_at',
    ];

    public function cooperationAccount()
    {
        return $this->belongsTo(CooperationAccount::class, 'co_account_id', 'id');
    }
}
