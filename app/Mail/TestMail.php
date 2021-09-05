<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    // data mail template e send korar jonno. 
    // sokol public variable mail template e avelable
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data = [10, 26, 50, 60];

    public $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Mail e kono attacment send korte chaile akta method define kore hoy 'attach(path/to/file)'  |OR| attach(public_path('image.png'))
        // Mail e chaile amara subject bole dite parbo 'subject('This is our Mial Subject ')'
        // Attachment er name change kore custom vabe set korte pari, second peramiter e bole dite hoy attach(public_path('image.png'), ['as' => 'biplobjabery.jpg', 'mime' => 'jpg'])
        // jodi image ba file onno kono folder ba clawod e thake se somoy ai method ta use korbo  attachFromStorege('image.png')
        return $this->view('mail.test')
        // ->subject('This is our Mail Subject')
        ->subject("{$this->user->name} 's Email")
        ->attach(public_path('storage/image/1630258191_612bc40f6db24.jpg'), [
            'as' => 'biplobjabery.jpg',
            'mime' => 'jpg'
        ])
        ->with([ // Modifie or customize the data and send to the view file.
            'firstIndex' => $this->data[0],
            'secondIndex' => $this->data[1]
        ]);
    } 
}
