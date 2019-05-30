<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SolResUpdateRequest extends FormRequest
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
            'FK_SolResSolSer' => 'required|max:255',
            'SolResTypeUnidad' => 'nullable',
            'SolResEmbalaje' => 'required',
            'SolResKgEnviado' => 'max:11|required',
            'SolResKgRecibido' => 'max:11|nullable',
            'SolResKgConciliado' => 'max:11|nullable',
            'SolResKgTratado' => 'max:11|nullable',
            'SolResAlto' => 'max:20|nullable',
            'SolResAncho' => 'max:20|nullable',
            'SolResProfundo' => 'max:20|nullable',
            'SolResFotoDescargue_Pesaje' => 'numeric|max:1|nullable',
            'SolResFotoTratamiento' => 'max:1|nullable',
            'SolResVideoDescargue_Pesaje' => 'max:1|nullable',
            'SolResVideoTratamiento' => 'max:1|nullable',
        ];
    }
}
