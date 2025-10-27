<?php

namespace App\Mail;

use App\Models\InscricaoVoluntario;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InscricaoVoluntarioMail extends Mailable
{
    use Queueable, SerializesModels;

    public $voluntario;

    /**
     * Create a new message instance.
     */

    public function __construct(InscricaoVoluntario $voluntario)
    {
        $this->voluntario = $voluntario;
    }

    public function build()
    {
        return $this->subject('Confirmação de Inscrição - Voluntário')
                    ->view('emails.inscricao_voluntario');
    }
}
