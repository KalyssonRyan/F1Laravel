<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Laravel\Scout\Searchable;
class Equipe extends Model
{
    use HasFactory;
    use Searchable;
   protected $fillable = [
    'nome',
    'descricao',
    'foto', // Adicionando a foto aqui
];
 public function scopeFilter(Builder $query, array $filters)
     {
         if ($title = $filters['title'] ?? false) {
             $query->where('nome', 'like', '%' . $title . '%');
         }
 
         if ($description = $filters['description'] ?? false) {
             $query->where('descricao', 'like', '%' . $description . '%');
         }
     }
    public function storeArquivo($arquivo)
    {
        if ($arquivo) {
            $path = $arquivo->store('arquivos', 'public');
            $this->foto = Storage::url($path);
            $this->save(); // Salva o modelo para persistir o campo 'url' no banco de dados
        }
 
    }
    
     // Adicione os campos que você deseja indexar
     public function toSearchableArray()
     {
         return [
             'id' => $this->id,
             'nome' => $this->nome,
             'descricao' => $this->descricao,
         ];
     }
}
