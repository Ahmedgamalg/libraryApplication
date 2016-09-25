
@extends('site/master')
@section('content')
<script type="text/javascript" src="{{asset('js/jquery-3.1.0.js')}}"></script>
<script type="text/javascript">
	$(function(){
		$('#errorMass').hide();
		var files;
		$('input[name="image"]').change(function(e){
          files=e.target.files;
		});
		$('#CreateSection').submit(function(e){
            e.PreventDefault();
            var _token =$('input[name="_token"]').val();
            var section_name=$('input[name="section_name"]').val();
            var data = new FormData() ;
            data.append('_token',_token);
            data.append('section_name',section_name);
            $.each(files,function(k,v){
              data.append('image',v);
            });
            $.ajax({
            	url:'store'
            	type:'POST'
            	data:data,
            	contentType:"multipart/form-data",
            	processData:false,
            	success:function(data){alert('section create successful !!';},
            	error:function(data){
            		$('#errorMass').Show();
            		$('#errorMass').Html('');
            		var errors=data.responseJSON;
            		$.each(errors,function(k,v){
                     $('#errorMass').append(v+"</br>")
            		});
            	}
            });
		});
	});
                   
                 
</script>




<h2>create anew section</h2>
@if(count($errors)>0)
<div class="alert alert-danger" id="errorMass"></div>

<div class="alert alert-danger">
	<ul>
		@foreach($errors->all() as $error)
		<li>{{$error}}</li>
		@endforeach
	</ul>
</div>
@endif
{!! Form::open( [ 'url' => 'library','files' =>'true','id'=>'CreateSection']) !!}
{!! csrf_field() !!}
	enter the section name<br> {!!Form::text("section_name", "",["class"=>"text-section"])!!}<br>
	enter the section name<br> {!!Form::text("books_total", "",["class"=>"text-section"])!!}<br>
	upload an image {!!Form::file("section_pic",["class"=>"form-control","name"=>"image"])!!}
	{!!Form::submit("add",["class"=>"btn btn-info"])!!}
	{!!Form::close()!!}

	<div class="container">
	

<table class="table">
<th></th>

@foreach($section as $section)
@if($section->trashed())
<tr style="background-color:#301"></tr>
@else
<tr style="background-color:#261"></tr>
@endif
<tr>



{!! Form::open( [ "url" => "library/$section->id","files" =>"true","method"=>"PATCH" ]) !!}

<td>
{!!Form::text("section_name", "$section->section_name",["class"=>"text-section"])!!}
	
</td>
<td>
{!!Form::text("books_total", "$section->books_total",["class"=>"text-section"])!!}
	
</td>
<td>
	{!!Form::submit("UPDATE",["class"=>"btn btn-info"])!!}
</td>
{!!Form::close()!!}
<td>
@if($section->trashed())
{!! Form::open( [ "url" => "library/deleteforever/$section->id","files" =>"true"]) !!}
	{!!Form::submit("Delete For Ever",["class"=>"btn btn-info"])!!}
    {!!Form::close()!!}
@else
{!! Form::open( [ "url" => "library/$section->id","files" =>"true","method"=>"DELETE" ]) !!}
	
{!!Form::submit("DELETE",["class"=>"btn btn-info"])!!}
{!!Form::close()!!}

@endif
</td>
<td>
{!! Form::open( [ "url" => "library/$section->id","files" =>"true","method"=>"GET"]) !!}
	{!!Form::submit("Show",["class"=>"btn btn-info"])!!}
    {!!Form::close()!!}
</td>
@if($section->trashed())
<td>
	{!! Form::open( [ "url" => "library/restored/$section->id","files" =>"true"]) !!}
	{!!Form::submit("RESTORED",["class"=>"btn btn-info"])!!}
    {!!Form::close()!!}
</td>
@endif
</tr>


@endforeach

</table>
</div>

@stop