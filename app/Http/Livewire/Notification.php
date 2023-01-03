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
    public $count;
    public $notificationsArray = array();
    public  $receiveNotification;
    public $receiveNotificationcount;


    public function render()
    {
        $id = Auth::id();

        $wordlist = ModelsNotification::where([
            ['notifiable_id', $id],
            ['read_at', null],

        ])->get();
        $this->count = $wordlist->count();





        $this->notificationsArray = ModelsNotification::where('notifiable_id', $id)->latest()->take(10)
            ->orderBy('created_at', 'ASC')
            ->with('user')->get();


            $this->receiveNotification =  ModelsNotification::where([
                ['notifiable_id', $id],
                ['receive', null],

            ])->get();
            $this->receiveNotificationcount = $this->receiveNotification->count();


            ModelsNotification::where([
                ['notifiable_id', $id],
                ['receive', null],
            ])->update(['receive' => 1]);
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
        $this->dd++;
        // $this->count++;

        // $id = Auth::id();
        // $receiveNotification =  ModelsNotification::where([
        //     ['notifiable_id', $id],
        //     ['receive', null],

        // ])->get();


        // ModelsNotification::where([
        //     ['notifiable_id', $id],
        //     ['receive', null],
        // ])->update(['receive' => 1]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function alertError()
    {
        $this->notify('Hello Web Artisan', 'Love beautiful code? We do too!');
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'error',  'message' => 'Something is Wrong!']
        );
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function alertInfo()
    {
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'info',  'message' => 'Going Well!']
        );
    }
}

// return view('livewire.notification');
