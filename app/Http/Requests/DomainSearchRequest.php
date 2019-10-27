<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DomainSearchRequest extends FormRequest
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
        $this->sanitize();

        return [
            'domainList' => 'required',
        ];
    }

    public function sanitize()
    {
        $input = $this->all();

        $domainList = $input['domainList'];

        foreach($domainList as &$domain){
                $domain = filter_var($domain, FILTER_SANITIZE_URL);
                $domain = filter_var($domain, FILTER_SANITIZE_STRING);
        }

        $input['domainList'] = $domainList;

        // dd($input['domainList']);
        $this->replace($input);
    }
}
