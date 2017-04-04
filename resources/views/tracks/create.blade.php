<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	{!! Html::style('css/bootstrap-combobox.css') !!}
	{!! Html::script('js/bootstrap-combobox.js') !!}
</head>
<body>
<div class="container">
	<h1>Create new Track</h1>
	{!! Form::open(['url' => route('tracks.store') ]) !!}
	{!! Form::token() !!}
		<div class="form-group">
			{!!Form::label('title', 'Titulo: ', ['class' => 'labelClass'])!!}
			{!!Form::text('title',null,['class'=>'form-control','placeholder'=>'title'])!!}
	  	</div>
	  <div class="form-group">
			{!!Form::label('release_date', 'Fecha de lanzamiento: ', ['class' => 'labelClass'])!!}
	    	{!!Form::date('release_date',null, ['class'=>'form-control','placeholder'=>'title'])!!}
	  </div>
	  <div class="form-group">
			{!! Form::checkbox('name', 'value', true) !!}
			{!! Form::radio('name', 'value', true) !!}
	  </div>
	  <div class="form-group">
	  		{!! Form::label('label_id', 'Compañia Discografica: ', ['class' => 'labelClass']) !!}
	    	{!! Form::select('label_id', $labels, null, ['class' => 'form-control']) !!}
	  </div>
	  {!! Form::submit('Click Me!',['class'=>'btn btn-success']) !!}
	{!! Form::close() !!}
</div>
<script>
	$(document).ready(function() {
		$('#label_id').combobox();
	});
</script>
</body>
</html>