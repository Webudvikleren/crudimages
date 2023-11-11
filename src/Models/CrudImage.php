<?php

namespace Webudvikleren\CrudImages\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrudImage extends Model
{
    use HasFactory;

	protected $guarded = [];
	protected $table = 'crud_images';
}
