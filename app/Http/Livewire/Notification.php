<?php

namespace App\Http\Livewire;

use App\Models\Notification as ModelsNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Notification extends Component
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public $count ;
    public $notificationsArray= array();


    public function render()
    {
        $id = Auth::id();

        $wordlist = ModelsNotification::where([
            ['notifiable_id',$id],
            ['receive',null],

        ])->get();
        $this->count = $wordlist->count();

        ModelsNotification::where([
            ['notifiable_id',$id],
            ['receive',null],

        ])->update(['receive' => 1]);



         $this->notificationsArray= ModelsNotification::where('notifiable_id', $id)->latest()->take(10)
        ->orderBy('created_at', 'ASC')
        ->with('user')->get();


        // $this->alertSuccess();
        return view('livewire.notification');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function alertSuccess()
    {
        $this->count++;
        $this->dispatchBrowserEvent('alert',
                ['type' => 'success',  'message' => 'User Created Successfully! ' .$this->count]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function alertError()
    {
        $this->dispatchBrowserEvent('alert',
                ['type' => 'error',  'message' => 'Something is Wrong!']);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function alertInfo()
    {
        $this->dispatchBrowserEvent('alert',
                ['type' => 'info',  'message' => 'Going Well!']);
    }
}

// return view('livewire.notification');
