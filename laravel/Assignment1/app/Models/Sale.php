<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
  use HasFactory;
  use SoftDeletes;
  protected $table="sale";
  protected $fillable = [
    'customerID',
    'productID',
    'ordered_date',
  ];

  protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}
