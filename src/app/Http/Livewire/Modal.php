<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Contact;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Session;

class Modal extends Component
{
    use WithPagination;
    protected $contacts;
    public $showModal = false;
    public $contact;
    public $genderLabel;


    public function mount()
    {
        $this->contacts = Session::get('contacts');
    }

    public function openModal($id)
    {
        $this->contact = Contact::with('category')->find($id);
        $this->contacts = Session::get('contacts');
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->contact = null;
        $this->contacts = Session::get('contacts');
    }

    public function genderLabel()
    {
        if (!$this->contact) {
            return '';
        }
        if ($this->contact['gender'] == 1) {
            return '男性';
        } elseif ($this->contact['gender'] == 2) {
            return '女性';
        } elseif ($this->contact['gender'] == 3) {
            return 'その他';
        } else {
            return '';
        }
    }

    public function render()
    {
        return view('livewire.modal', ['contacts' => $this->contacts]);
    }
}
