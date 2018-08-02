@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @includeIf('frontend.color.partials.create_form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('after_styles')

@endsection

@section('after_scripts')

@endsection