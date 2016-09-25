
@extends('site/master')
@section('content')
<h1>{{$section->section_name}}</h1>
<h2>create anew book</h2>
@if(count($errors)>0)
<div class="alert alert-danger">
	<ul>
		@foreach($errors->all() as $error)
		<li>{{$error}}</li>
		@endforeach
	</ul>
</div>
@endif
{!! Form::open( [ 'url' => 'book','files' =>'true' ]) !!}
{!!Form::hidden("section_id","$section->id")!!}
{!! csrf_field() !!}
	enter the book title<br> {!!Form::text("book_title", "",["class"=>"text-section"])!!}<br>
	enter the book edition<br> {!!Form::text("book_edition", "",["class"=>"text-section"])!!}<br>

	enter the book discrebtion<br> {!!Form::textarea("book_discrebtion", "",["class"=>"text-section"])!!}<br>
	anther auther <br> {!!Form::text("anather_auther", "",["class"=>"text-section"])!!}<br>
	{!!Form::submit("add",["class"=>"btn btn-info"])!!}
	{!!Form::close()!!}
	
@if (!$all_books->isEmpty())
	
	<table class="table" border="1">
<tr>
	<th>عنوان الكتاب </th>
	<th>اصدار الكتاب </th>
	<th>وصف الكتاب</th>
<th>المؤلف</th>
<th></th>
<th></th>
</tr>

<?php $i=0; ?>
@foreach($all_books as $book)
<tr>
{!! Form::open( [ "url" => "book/$book->id","files" =>"true","method"=>"PATCH" ]) !!}
{!!Form::hidden("section_id","$section->id")!!}
	<td>{!!Form::text("book_title", "$book->book_title",["class"=>"text-section"])!!}</td>
	<td>{!!Form::text("book_edition", "$book->book_edition",["class"=>"text-section"])!!}</td>
	<td>{!!Form::textarea("book_discrebtion", "$book->book_discrebtion",["class"=>"text-section"])!!}</td>
	<td>
	<?php $authers=$array_of_authers[$i]; ?>
	@foreach($authers as $auther)
	<a href="/auther/{{$auther->id}}"><span class="label label-info">{{$auther->first_name}}</span></a>
	@endforeach
	</td>
	<?php $i= $i+1;?>
	
	<td>{!!Form::submit("UPDATE",["class"=>"btn btn-info"])!!}
     {!! Form::close() !!}
	</td>
	

	<td>
	{!! Form::open( [ "url" => "book/$book->id","files" =>"true","method"=>"DELETE" ]) !!}
	{!!Form::hidden("section_id","$section->id")!!}
	{!!Form::submit("Delete",["class"=>"btn btn-info"])!!}	
	{!! Form::close() !!}
	</td>
</tr>
	@endforeach
</table>

@endif





@stop