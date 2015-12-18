<?php

namespace Poll\Model;

use Illuminate\Database\Eloquent\Model;

class Pergunta extends Model
{
    protected $fillable = ['titulo', 'status'];
}
