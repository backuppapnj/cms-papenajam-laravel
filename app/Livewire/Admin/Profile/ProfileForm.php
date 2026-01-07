<?php

namespace App\Livewire\Admin\Profile;

use App\Models\ProfileContent;
use Livewire\Component;

class ProfileForm extends Component
{
    public string $key;
    public string $title = '';
    public string $content = '';

    public function mount(string $key)
    {
        $this->key = $key;
        $profile = ProfileContent::where('key', $key)->first();

        if ($profile) {
            $this->title = $profile->title;
            $this->content = $profile->content;
        } else {
            $this->title = $key === 'visi_misi' ? 'Visi & Misi' : 'Sejarah';
        }
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|min:3',
            'content' => 'required',
        ]);

        ProfileContent::updateOrCreate(
            ['key' => $this->key],
            [
                'title' => $this->title,
                'content' => $this->content,
            ]
        );

        $this->js("Flux.toast('Konten berhasil disimpan.')");
    }

    public function render()
    {
        return view('livewire.admin.profile.profile-form');
    }
}
