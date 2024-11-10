<?php

namespace App\Models\Forms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'questionnaire_category_id'];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function scopeWithQuestionCount($query)
    {
        return $query->withCount('questions');
    }
}
