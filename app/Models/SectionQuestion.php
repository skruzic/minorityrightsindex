<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class SectionQuestion extends Pivot
{
    protected $table = 'section_questions';
}
