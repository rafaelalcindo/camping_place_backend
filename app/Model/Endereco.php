<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Endereco extends Model
{
    use Notifiable;

    protected $table = 'enderecos';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'logradouro', 'numero', 'cep',
        'complemento', 'cidade', 'estado',
        'latitude', 'longitude', 'acampamento_id'
    ];

    public function acampamento()
    {
        return $this->belongsTo(Acampamento::class);
    }
}
