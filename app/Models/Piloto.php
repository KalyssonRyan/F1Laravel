<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Laravel\Scout\Searchable;
class Piloto extends Model
{
    use HasFactory;
    use Searchable;
    
    protected $fillable = [
        'nome',
        'nacionalidade',
        'data_nascimento',
        'foto', // Caso queira adicionar uma foto do piloto
    ];
     
    // Query Scopes
     public function scopeFilter(Builder $query, array $filters)
     {
         if ($name = $filters['name'] ?? false) {
             $query->where('nome', 'like', '%' . $name . '%');
         }
 
         if ($nationality = $filters['nationality'] ?? false) {
             $query->where('nacionalidade', 'like', '%' . $nationality . '%');
         }
     }

    // Função para armazenar a foto do piloto (caso tenha um campo foto)
    public function storeFoto($foto)
    {
        if ($foto) {
            $path = $foto->store('fotos', 'public'); // Aqui a pasta seria "fotos"
            $this->foto = Storage::url($path);
            $this->save(); // Salva o modelo para persistir o campo 'foto' no banco de dados
        }
    }

    // Adicione os campos que você deseja indexar para pesquisa
    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'nacionalidade' => $this->nacionalidade,
            'data_nascimento' => $this->data_nascimento,
        ];
    }
}