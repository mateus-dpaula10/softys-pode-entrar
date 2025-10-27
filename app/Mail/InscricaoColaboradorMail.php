<?php

namespace App\Mail;

use App\Models\InscricaoColaborador;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InscricaoColaboradorMail extends Mailable
{
    use Queueable, SerializesModels;

    public $colaborador;

    /**
     * Create a new message instance.
     */
    
    public function __construct(InscricaoColaborador $colaborador)
    {
        $this->colaborador = $colaborador;
    }

    public function build() 
    {
        return $this->subject('Confirmação de Inscrição - Colaborador')
                    ->view('emails.inscricao_colaborador');
    }
}
