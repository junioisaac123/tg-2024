<?php

namespace App\Models\Forms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionnaireCategory extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['text'];

    public function questionnaires()
    {
        return $this->hasMany(Questionnaire::class);
    }
}
