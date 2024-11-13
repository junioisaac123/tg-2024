<?php

namespace App\Models\Forms;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormStudent extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'form_students';

    protected $fillable = [
        'user_id',
        'questionnaire_id',
        'rating',
        'attempt',
        'answers'
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }
}
