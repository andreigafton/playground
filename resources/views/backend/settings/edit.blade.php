@extends('layouts.app')

@section('content')
    <div class="container">

        <nav class="navbar navbar-inverse">
            <ul class="nav navbar-nav">
                <li></li>
            </ul>
        </nav>

        <h1><a href="{{ route('settings.index') }}">Back</a></h1>

        <!-- if there are update errors, they will show here -->
        {{ Html::ul($errors->all()) }}

        {{ Form::open(array('url' => route('settings.update', $entity), 'method' => 'patch')) }}

        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', old('name', $entity->name), array('class' => 'form-control', 'readonly'=>'readonly')) }}
        </div>

        <div class="form-group">
            {{ Form::label('value', 'Value') }}
            {{ Form::text('value', old('value', $entity->value), array('class' => 'form-control')) }}
        </div>


        {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}

    </div>

@endsection