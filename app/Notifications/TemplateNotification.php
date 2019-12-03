<?php

namespace App\Notifications;

use App\MessageTemplate;
use App\Notifications\Channels\TemplateSmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TemplateNotification extends Notification
{
    use Queueable;

    protected $template;
    protected $token;
    protected $token2;
    protected $token3;
    protected $token10;
    protected $token20;
    protected $methods;
    protected $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($template,$methods,$token=null,$token2=null,$token3=null, $token10=null, $token20=null)
    {
        $this->template = $template;
        $this->token = $token;
        $this->token2 = $token2;
        $this->token3 = $token3;
        $this->token10 = $token10;
        $this->token20 = $token20;
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
                    $methods[]=TemplateSmsChannel::class;
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
                    ->line($this->getMessage())
                    ->action('ورود به سیستم', url('/'))
                    ->line('با تشکر از انتخاب ما');
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
            'messaage' =>$this->getMessage()
        ];
    }

    public function getMessage()
    {
        if($this->message)
            return $this->message;

        $message = MessageTemplate::where('name',$this->template)->first();

        if($message)
            $this->message = strtr($message->message, array('{$token}' => $this->token,'{$token2}' => $this->token2,'{$token3}' => $this->token3,'{$token10}' => $this->token10,'{$token20}' => $this->token20));
        else
            $this->message = $this->token.' '.$this->token2.' '.$this->token3.' '.$this->token10.' '.$this->token20;
        return $this->message;

    }

    /**
     * @return mixed
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @return null
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return null
     */
    public function getToken2()
    {
        return $this->token2;
    }

    /**
     * @return null
     */
    public function getToken3()
    {
        return $this->token3;
    }

    /**
     * @return null
     */
    public function getToken10()
    {
        return $this->token10;
    }

    /**
     * @return null
     */
    public function getToken20()
    {
        return $this->token20;
    }



}
