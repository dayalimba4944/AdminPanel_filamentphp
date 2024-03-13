<?php
// app/Http/Livewire/MediaTypesSelect.php

namespace App\Http\Livewire;

use Livewire\Component;

class MediaTypesSelect extends Component
{
    public $acceptedFileTypes = [];

    protected $listeners = ['mediaTypeChanged'];

    public function mediaTypeChanged($mediaType)
    {
        if ($mediaType === 'image') {
            $this->acceptedFileTypes = ['image/jpg', 'image/jpeg', 'image/png'];
        } elseif ($mediaType === 'video') {
            $this->acceptedFileTypes = ['video/mp4'];
        } else {
            $this->acceptedFileTypes = [];
        }
    }

    public function render()
    {
        return view('livewire.media-types-select');
    }
}
