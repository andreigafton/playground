@extends('layouts.app')

@section('content')
    <div class="container">

        <h1>Settings</h1>

        <!-- will be used to show any messages -->
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif

        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <td>Name</td>
                <td>Value</td>
                <td>Actions</td>
            </tr>
            </thead>
            <tbody>
            @foreach($entities as $key => $value)
                <tr>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->value }}</td>
                    <td><a href="{{ route('settings.edit', $value) }}" class="btn btn-xs">Edit</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection
