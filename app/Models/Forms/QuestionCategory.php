<?php

namespace App\Models\Forms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionCategory extends Model
{
    use HasFactory;
    protected $fillable = ['text'];

    public function questions()
    {
        return $this->hasMany(Question::class, 'category_id');
    }
}
