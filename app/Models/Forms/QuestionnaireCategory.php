<?php

namespace App\Models\Forms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionnaireCategory extends Model
{
    use HasFactory;
    protected $fillable = ['text'];

    public function questionnaires()
    {
        return $this->hasMany(Questionnaire::class);
    }
}
