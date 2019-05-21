<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\userController;

class ContactosUpdateRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'CliNit' => ['required','min:13','max:13',Rule::unique('clientes')->where(function ($query) use ($request){
                $id = userController::IDClienteSegunUsuario();

                $Cliente = DB::table('clientes')
                    ->select('clientes.CliNit')
                    ->where('CliNit', $request->input('CliNit'))
                    ->where('CliCategoria', $request->input('CliCategoria'))
                    ->where('CliDelete', 0)
                    ->where('ID_Cli', '<>', $id)
                    ->first();

                if(isset($Cliente->CliNit)){
                    $query->where('clientes.CliNit','=', $Cliente->CliNit);
                }else{
                    $query->where('clientes.CliNit','=', null);
                }
            })],
            'CliName'       => 'required|max:255|min:1',
            'CliShortname'  => 'required|max:255|min:1',
            'CliCategoria'  => 'required|max:32',
        ];
    }
}
