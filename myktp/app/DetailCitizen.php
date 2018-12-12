<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailCitizen extends Model
{
  use SoftDeletes;

  protected $table = 'tbl_detail_citizens';
  protected $primaryKey = 'id';
  public $timestamps = true;
  protected $guarded = ['id'];
  protected $fillable = ['id_citizen', 'matrix_linear_image', 'eigen_vector', 'mein_flat_vector'];
}
