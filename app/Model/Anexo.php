<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class Anexo extends Model
{
    use Notifiable;

    protected $table = 'anexos';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'arquivo', 'nome_arquivo', 'acampamento_id'
    ];

    public function acampamento()
    {
        return $this->belongsTo(Acampamento::class);
    }

    public function getArquivoAttribute()
    {
        if ($this->attributes['arquivo']) {
            return Storage::url('public/images/' . $this->attributes['arquivo']);
        }
    }
}
