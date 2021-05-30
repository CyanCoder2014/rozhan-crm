<?php

namespace App\Traits;

use App\Scopes\CooperationAccountScope;
use Illuminate\Support\Facades\Auth;

trait CooperationAccountTrait
{
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new CooperationAccountScope());

        static::creating(function ($model) {
            $model->co_account_id = Auth::user()->co_account_id;
        });
    }
}
