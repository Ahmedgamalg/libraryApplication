@extends('site/master')
@section('background')

<style type="text/css">
      body{
        background: url("{{asset('website/images/ax8kqQr.jpg')}}");
        background-size: 100% auto;
      }
    </style>
    @stop
@section('content')

<div class="container" style="opacity:0.9">
	<div class="row">
		@foreach($section as $sections)

		<div class="col-md-3">
			<div class="thumbnail">
			<img style="  width: 218px; height: 349px;" src="/website/images/{{$sections->section_pic}}" alt="">
				
				<h1 > <a class="class="btn btn-primary">{{$sections->section_name}}</a></h1>

			</div>
		</div>
		@endforeach
		
	</div>
	<div class="row text-center">
{{ $section->links() }}
</div>	
</div>


@stop