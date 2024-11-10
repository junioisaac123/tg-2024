<?php

namespace App\Models\Forms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionOption extends Model
{
    use HasFactory;

    protected $fillable = ['text', 'score', 'question_id'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
