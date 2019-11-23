<?php


namespace App\Http\Requests\Admin\Role;


use App\Http\Requests\BaseFormRequest;

class ChangeUserRoleRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'userId'     => 'required',
            'roleId' => 'required'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
