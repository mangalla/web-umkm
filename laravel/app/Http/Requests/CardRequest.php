<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CardRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Form mengirim "features" sebagai satu textarea (satu baris = satu poin),
     * sedangkan database menyimpannya sebagai array JSON. Checkbox yang tidak
     * dicentang juga tidak ikut terkirim sama sekali.
     */
    protected function prepareForValidation(): void
    {
        // TODO(human): ubah input mentah form menjadi bentuk yang siap divalidasi.
        //  - "features": string textarea → array of string
        //  - "is_popular" & "is_visible": checkbox → boolean
        // Gunakan $this->merge([...]).
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'speed' => ['required', 'string', 'max:20'],
            'unit' => ['nullable', 'string', 'max:20'],
            'price' => ['required', 'string', 'max:50'],
            'price_suffix' => ['nullable', 'string', 'max:50'],
            'pill' => ['nullable', 'string', 'max:100'],
            'promo' => ['nullable', 'string', 'max:255'],
            'is_popular' => ['boolean'],
            'badge' => ['nullable', 'string', 'max:50'],
            'features' => ['array', 'max:15'],
            'features.*' => ['string', 'max:150'],
            'cta_label' => ['nullable', 'string', 'max:50'],
            'wa_text' => ['nullable', 'string', 'max:500'],
            'is_visible' => ['boolean'],
        ];
    }

    public function attributes(): array
    {
        return collect(config('cms.card_field_meta'))->map(fn ($m) => strtolower($m['label']))->all()
            + ['features.*' => 'poin keunggulan'];
    }

    /**
     * Data tervalidasi. Kolom opsional yang dikosongkan tetap null (agar nilai lama terhapus),
     * kecuali kolom yang di database tidak boleh null: diisi default.
     */
    public function cardData(): array
    {
        $data = $this->validated();
        $data['unit'] ??= 'Mbps';
        $data['cta_label'] ??= 'Pesan Sekarang';
        $data['features'] ??= [];

        return $data;
    }
}
