<?php

namespace Samaphp\LaravelKeyValue\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeyValue extends Model
{
  public $timestamps = false;
  protected $fillable = ['collection', 'key', 'value'];
}
