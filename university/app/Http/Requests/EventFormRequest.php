<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EventFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'titre' => [
                'required',
                'string',
                'max:191',
            ],
            'description' => [
                'required',
                'string',
            ],
            'adresse' => [
                'string',
                'max:191',
            ],
            'date' => [
                'required',
                'string',
            ],  
            'rating' => [
                'integer',
            ], 
            'views' => [
                'integer',
            ], 
            'image' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,gif,svg',
            ], 
        ];

        if($this->getMethod() == "POST") {
            $rules += [
                'titre' => [
                    'required',
                    'string',
                    'max:191',
                ],
            ];
        }

        if($this->getMethod() == "PUT") {
            $event = $this->route('event');
            $rules += [
                'titre' => [
                    'required',
                    'string',
                    'max:191',
                    Rule::unique('events')->ignore($event->id),
                ],
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'titre.required' => 'Veuillez entrer le titre',
            'description.required' => 'Veuillez entrer une description',
            'date.required' => 'Veuillez entrer la date event',
            'image.required' => 'Veuillez entrer une image',
        ];
    }
}
