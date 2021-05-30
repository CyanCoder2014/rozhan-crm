<?php

namespace App\Http\Requests\SuperAdmin\CooperationAccount;

use App\Http\Requests\BaseFormRequest;

class UpdateRequest extends BaseFormRequest
{
    /**
     * @inheritDoc
     */
    public function rules()
    {
        return [
            'status'     => 'boolean',
            'expired_at' => 'date'
        ];
    }

    /**
     * @inheritDoc
     */
    public function authorize()
    {
        return true;
    }
}
