<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InscricaoVoluntario extends Model
{
    use HasFactory;

    protected $table = 'inscricoes_voluntarios';

    protected $fillable = [
        'full_name', 'email', 'phone', 'shirt_size', 'unit',
        'support_unit', 'terms_accepted'
    ];
}
