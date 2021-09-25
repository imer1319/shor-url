<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Classes\CodeGenerator;

class Url extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'user_id'];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function short_url($long_url)
    {
        // Crear Url
        $url = self::create([
            'url' => $long_url,
            'user_id' => auth()->id()
        ]);
        // generar código
        $code = (new CodeGenerator())->get_code($url->id);
        // Actualizar URl
        $url->code = $code;
        $url->save();
        // Retornar código
        return $url->code;

    }
}
