<?php

namespace App;

use App\Traits\CooperationAccountTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceCategory extends Model
{
    use SoftDeletes;

    use CooperationAccountTrait;

    protected $fillable = [
        'parent_id',
        'title',
        'image',
        'description',
        'number',
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
