<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreReportsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'string|max:255|nullable',
            's_date' => 'nullable|date_format:'.config('app.date_format'),
            'e_date' => 'nullable|date_format:'.config('app.date_format'),
        ];
    }
}
