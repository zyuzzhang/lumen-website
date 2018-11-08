<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Enewsletter extends Model
{
	
	protected $table = 'enewsletter';
	protected $primaryKey = 'e_id';
	public $timestamps = false;
	
	
}