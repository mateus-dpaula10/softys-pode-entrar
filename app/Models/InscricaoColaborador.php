<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InscricaoColaborador extends Model
{
    use HasFactory;

    protected $table = 'inscricoes_colaboradores';

    protected $fillable = [
        'nome', 'email', 'telefone', 'unidade', 'diretoria',
        'unidade_escolha_comercial', 'unidade_escolha_comercial_vo', 'transporte_caieiras',
        'transporte_pirai', 'rota_pirai'
    ];

    public function dependentes()
    {
        return $this->hasMany(InscricaoDependente::class, 'inscricao_colaborador_id');
    }
}
