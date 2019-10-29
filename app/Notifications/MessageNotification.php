<?php

namespace App\Notifications;

use App\Notifications\Channels\SMSChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MessageNotification extends Notification
{
    use Queueable;
    /**
     * @var string
     */
    protected $message;
    protected $methods;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $message,array $methods)
    {
        $this->message = $message;
        $this->methods = $methods;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        $methods=[];
        foreach ($this->methods as $value)
            switch ($value){
                case 'sms':
                    $methods[]=SMSChannel::class;
                    break;
                case 'email':
                    $methods[]='mail';
                    break;
                case 'db':
                    $methods[]='database';
                    break;
            }

        return $methods;
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
                    ->line($this->message)
                    ->action('ورود به سیستم', url('/'))
                    ->line('با تشکر از انتخاب ما');
    }
    public function toArray($notifiable)
    {
        return ['messaage' =>$this->message];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toSms($notifiable)
    {
        return $this->message;
    }
}
