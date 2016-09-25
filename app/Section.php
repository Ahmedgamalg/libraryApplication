<?php

namespace App;
use App\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;
use App\Http\Controllers\view;

class Section extends Model
{
	use softDeletes;
	protected $table='section';
    //
   public function books(){
	return $this->hasMany('App\Book');
}  

}

