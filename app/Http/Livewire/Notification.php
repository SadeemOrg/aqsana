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
            ['read_at',null],

        ])->get();
        $this->count = $wordlist->count();





         $this->notificationsArray= ModelsNotification::where('notifiable_id', $id)->latest()->take(10)
        ->orderBy('created_at', 'ASC')
        ->with('user')->get();


        $this->alertSuccess();
        return view('livewire.notification');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function alertSuccess()
    {
        // $this->count++;

        $id = Auth::id();
        $receiveNotification=  ModelsNotification::where([
            ['notifiable_id',$id],
            ['receive',null],

        ])->get();

        foreach ($receiveNotification as $key => $notification) {
            $dataNotifications = json_decode($notification->data);
            $this->dispatchBrowserEvent('alert',
            ['type' => 'success',  'message' => 'لديك مهمة جديدة ' .$dataNotifications->Notifications]);
        }


                ModelsNotification::where([
                    ['notifiable_id',$id],
                    ['receive',null],

                ])->update(['receive' => 1]);
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
