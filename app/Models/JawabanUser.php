<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanUser extends Model
{
    use HasFactory;

    protected $table = 'jawaban_user';
    protected $primaryKey = 'id_jawaban';
    protected $fillable = ['id_kuis', 'jawaban_user', 'benar_salah'];

    public function kuis()
    {
        return $this->belongsTo(Kuis::class, 'id_kuis', 'id');
    }
}
