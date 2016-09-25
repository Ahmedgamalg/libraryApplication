<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
	protected $table='books';

	public function section()
{
    return $this->belongsTo('App\Section','section_id','id');
}


public function authors()
{

	return $this->BelongsToMany('App\Author','books_authors_relationship','book_id','author_id');
}

    //
}
