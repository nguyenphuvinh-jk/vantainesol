<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaiDat extends Model
{
    protected $fillable = ['id', 'songay', 'solit'];
    protected $primaryKey='id';
    protected $table = 'tbl_caidat';
}
