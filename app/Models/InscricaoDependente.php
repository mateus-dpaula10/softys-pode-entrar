<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InscricaoDependente extends Model
{
    use HasFactory;

    protected $table = 'inscricoes_dependentes';

    protected $fillable = [
        'inscricao_colaborador_id', 'nome', 'nascimento', 'rg', 
        'parentesco', 'email', 'autorizacao'
    ];

    public function colaborador()
    {
        return $this->belongsTo(InscricaoColaborador::class, 'inscricao_colaborador_id');
    }
}
