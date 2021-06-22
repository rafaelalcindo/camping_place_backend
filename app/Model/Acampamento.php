<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Acampamento extends Model
{
    use Notifiable;

    protected $table = 'acampamentos';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'nome_local', 'foto_principal', 'descricao',
        'preco_1', 'preco_2'
    ];

    public function enderecos()
    {
        return $this->hasOne(Endereco::class);
    }

    public function anexos()
    {
        return $this->hasMany(Anexo::class);
    }

    public function getFotoPrincipalAttribute()
    {
        if ($this->attributes['foto_principal']) {
            return Storage::url('public/images/' . $this->attributes['foto_principal']);
        }
    }
}
