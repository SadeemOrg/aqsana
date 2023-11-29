<?php

namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class TasksNotification extends Notification
{
    use Queueable;
    private $offerData;
    private $date;
    private $userSchema;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($offerData , $date,$userSchema)
    {
        $this->offerData = $offerData;
        $this->date = $date;
        $this->userSchema = $userSchema;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Hello'."  ". $this->userSchema->name)
                    // ->line()
                    ->line('A new task has been created:')
                    ->line('by'  ."  ".  Auth::user()->name )
                    ->line('Description :'."  ". $this->offerData)
                    ->line('date :'."  ".$this->date)
                    ->line('Thank you')
                    ->line('alaqsa');



                }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'sender_id'=>Auth::id(),
            'Notifications' => $this->offerData,
            'date' => $this->date,
        ];
    }
}
