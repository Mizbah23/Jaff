<?php

namespace Jaff\Notifications;
use Jaff\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendMail extends Notification
{
    use Queueable;
    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user=$user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        
        // $img_url = env('APP_URL')."public/img/app-logo.png";
        return (new MailMessage)
                    ->subject('OTP')
                    ->greeting('Hello '.$this->user->username.'!')
                    ->line('Your OTP code is '. $this->user->vcode.'.')
                    // ->action('Notification Action', url('/'))
                    ->line('For any query call us 0011223344.');
                    // ->line('html.message', ['url_img'=>$img_url]);
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
            //
        ];
    }
}
