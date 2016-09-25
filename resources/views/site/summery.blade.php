@extends('site/master')
@section('content')
<div class="container">
<h1 class="well text-cont"> library summery</h1>
<table class="table" border="1">
	<tr>
		<th style="width:25%">section name</th>
		<th style="width:25%">book title</th>
		<th style="width:25%">book discription</th>
		<th style="width:25%">book auther(s)</th>

	</tr>
	
	@foreach( $resultes as $resulte)
	<tr>
		<?php $sectionName=$resulte->section;?>
		<td>
         {{$sectionName->section_name}}
		</td>
		
	</tr>
	@endforeach

</table>	



</div>


@stop