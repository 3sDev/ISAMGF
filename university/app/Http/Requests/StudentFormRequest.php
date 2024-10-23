<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StudentFormRequest extends FormRequest
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
        $rules = [
            'matricule' => [
                'required',
                'max:10',
            ],
            'nom' => [
                'required',
                'string',
                'max:191',
            ],
            'prenom' => [
                'required',
                'string',
                'max:191',
            ],
            'login' => [
                'string',
            ],
            'password' => [
                'string',
            ], 
        ];

        if($this->getMethod() == "POST") {

            $rules += [
                'email' => [
                    'required',
                    'email',
                    'max:191',
                    'unique:students,email',
                ],
            ];
        }

        if($this->getMethod() == "PUT") {
            $student = $this->route('student');
            $rules += [
                'email' => [
                    'required',
                    'email',
                    'max:191',
                    Rule::unique('students')->ignore($student->id),
                ],
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'matricule.required' => 'Veuillez entrer votre matricule',
            'nom.required' => 'Veuillez entrer votre nom',
            'prenom.required' => 'Veuillez entrer votre prenom',
            'email.required' => 'Veuillez entrer votre email',
            'email.email' => 'Votre adresse mail est incorrecte',
            'phone.required' => 'Veuillez entrer votre nom',
        ];
    }
}

