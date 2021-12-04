<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class FileUploader extends Component
{
    use WithFileUploads;

    public $photos = [];

    // public function updatedPhoto(){

    //     $this->validate([

    //         'photo'=> 'image|max:1024'
    //     ]);
    // }

    public function save()
    {
        $this->validate([
            'photos.*' => 'image|max:1024', // 1MB Max
            // 'photos.*' => 'file|mimes:png,jpg,pdf|max:1024',
        ]);

        foreach($this->photos as $photo){

            // $photo->store('photos');
            $photo->storePublicly('photos');
        }

        $this->photos = [];

        session()->flash('message', 'File Uploaded !');
    }

    // SUPPRIMER 
    public function remove($index){

        array_splice($this->photos, $index, 1);
    }

    public function render()
    {
        return view('livewire.file-uploader');
    }
}
