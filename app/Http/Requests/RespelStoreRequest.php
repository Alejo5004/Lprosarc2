<?php

namespace App\Http\Requests;

// use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;



class RespelStoreRequest extends FormRequest
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
     *max:1024|mimes:jpeg,png
     * @return array
     */

    public function rules()
        {
            $request = $this->instance()->all();
            if (isset($request['RespelFoto'])) {
                $images = $request['RespelFoto'];
                foreach($images as $key => $file) {
                    $rules['RespelFoto.'.$key] = 'max:1024|mimes:jpeg,png';
                }
            }

            // $nombresderesiduos = $request['RespelFoto'];

            $rules = [
                'RespelName.*' => 'max:128|alpha_num',
                'RespelDescrip.*' => 'max:512|alpha_num',
                'RespelIgrosidad.*' => 'max:12',
                'RespelEstado.*' => 'max:12|alpha',
                'RespelHojaSeguridad.*' => 'max:1024|mimes:pdf',
                'YRespelClasf4741.*' => 'sometimes|max:12',
                'ARespelClasf4741.*' => 'sometimes|max:12',
                'RespelTarj.*' => 'sometimes|max:1024|mimes:pdf',
                'SustanciaControlada.*' => 'max:12|alpha_num',
                'SustanciaControladaNombre.*' => 'max:12|alpha_num',
                'SustanciaControladaDocumento.*' => 'max:1024|mimes:pdf',

            ];

            
            return $rules;
        }

    public function attributes()
    {   
        $request = $this->instance()->all();
        $attributes = [];

        
        if (isset(var) $request['RespelFoto']) {
            $images = $request['RespelFoto'];
            foreach($images as $key => $value){
                $attributes['RespelFoto.'.$key] = '"Fotografía N° '.($key+1).'"';
            }
        }


        return $attributes;
    }

    public function messages()
    {
        $request = $this->instance()->all();
        if (isset($request['RespelFoto'])) {
            $imagesmesage = $request['RespelFoto'];
            foreach($imagesmesage as $key => $file) {
                $messages['RespelFoto.'.$key.'.mimes'] = 'el archivo que adjuntó en el campo "Fotografía" del Residuo N° .'.($key+1).' no corresponde con los formatos permitidos: jpg, :values ';
                $messages['RespelFoto.'.$key.'.max'] = 'el archivo que adjuntó en el campo "Fotografía" del Residuo N° .'.($key+1).' excede el máximo permitido de :max Kilobytes';
            }
        }
        $messages = [
            // 'RespelFoto.required' => 'You must upload a file.'
        ];

        

        
        return $messages;
    }
    // protected function failedValidation(Validator $validator)
    // {
    //     throw (new ValidationException($validator))
    //                 ->errorBag($this->errorBag)
    //                 ->redirectTo(back());
    // }
}
