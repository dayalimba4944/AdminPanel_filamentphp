<?php
// app/Http/Livewire/BannerForm.php

namespace App\Http\Livewire;

use Livewire\Component;

class BannerForm extends Component
{
    public $banner;
    public $mediaValidationRules = [];

    protected $rules = [
        'banner.media_types' => 'required|in:image,video',
        'banner.media' => 'required',
    ];

    public function updatedBannerMediaTypes($value)
    {
        $this->mediaValidationRules = $value === 'video' ? 'mimes:mp4,mov,avi' : 'image|mimes:jpeg,png,jpg,gif';
        $this->validateOnly('banner.media');
    }

    public function render()
    {
        return view('livewire.banner-form');
    }
}
