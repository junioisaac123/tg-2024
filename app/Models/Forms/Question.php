<?php

namespace App\Models\Forms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'category_id', 'description', 'image', 'is_required', 'type'];

    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }

    public function options()
    {
        return $this->hasMany(QuestionOption::class);
    }

    public function category()
    {
        return $this->belongsTo(QuestionCategory::class, 'category_id');
    }
}
