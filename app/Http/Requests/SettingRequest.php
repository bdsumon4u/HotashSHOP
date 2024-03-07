<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
        if ($this->isMethod('GET')) return [];

        if ($this->get('tab') == 'company') {
            return [
                'logo' => 'sometimes|array',
                'logo.*' => 'nullable|image',
                'company' => 'required|array',
                'company.name' => 'required',
                'company.email' => 'required',
                'company.phone' => 'required',
                'company.tagline' => 'required',
                'company.address' => 'required',
            ];
        }

        if ($this->get('tab') == 'delivery') {
            return [
                'delivery_charge.inside_dhaka' => 'sometimes|integer',
                'delivery_charge.outside_dhaka' => 'sometimes|integer',
                'delivery_text' => 'sometimes',
                'free_delivery' => 'sometimes',
            ];
        }

        if ($this->get('tab') == 'analytics') {
            return [
                'gtm_id' => 'sometimes',
                'pixel_ids' => 'sometimes',
            ];
        }

        if ($this->get('tab') == 'courier') {
            return [
                'Pathao' => 'required|array',
                'SteadFast' => 'required|array',
            ];
        }

        if ($this->get('tab') == 'sms') {
            return [
                'BDWebs' => 'required|array',
            ];
        }

        if ($this->get('tab') == 'fraud') {
            return [
                'fraud' => 'required|array',
            ];
        }

        if ($this->get('tab') == 'color') {
            $rules = [];
            foreach (['topbar', 'header', 'search', 'navbar', 'category_menu', 'section', 'footer', 'primary', 'secondary'] as $key) {
                $rules['color.'.$key] = 'required|array';
                foreach (['background_color', 'background_hover', 'text_color', 'text_hover'] as $color) {
                    $rules['color.' . $key . '.' . $color] = ['required', 'regex:/^#([a-f0-9]{6}|[a-f0-9]{3})$/i'];
                }
            }
            return $rules;
        }

        if ($this->get('tab') == 'services') {
            return [
                'services' => 'required|array',
            ];
        }

        return [
            'products_page' => 'required|array',
            'related_products' => 'required|array',
            'call_for_order' => 'required',
            'scroll_text' => 'nullable',
        ];
    }
}
