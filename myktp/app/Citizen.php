<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Citizen extends Model
{
  use SoftDeletes;

  protected $table = 'tbl_citizens';
  protected $primaryKey = 'id';
  public $timestamps = true;
  protected $guarded = ['id'];
  protected $fillable = ['name', 'nik', 'place_of_birth', 'birth_date', 'type_blood', 'address', 'state'];
}
