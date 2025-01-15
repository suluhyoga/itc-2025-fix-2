<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KunciJawaban extends Model
{
    use HasFactory;

    protected $table = 'kunci_jawaban';
    protected $primaryKey = 'id_kunci';
    protected $fillable = ['id_kuis', 'jawaban_kunci'];

    public function kuis()
    {
        return $this->belongsTo(Kuis::class, 'id_kuis', 'id');
    }
}
