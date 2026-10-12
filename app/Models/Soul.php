<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attribute\Fillable;

#[Fillable(['victim', 'reaper', 'power', 'soul_perished'])]
class Soul extends Model
{
    protected $guarded = [];
}
