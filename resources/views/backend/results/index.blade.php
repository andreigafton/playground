@extends('layouts.app')

@section('content')
    <div class="container">

        <h1>Results</h1>

        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <td>#</td>
                <td>Balls</td>
                <td>Groups</td>
            </tr>
            </thead>
            <tbody>
            @foreach($entities as $key => $value)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @foreach(json_decode($value->balls) as $ball)
                            <span class="dot" style="background-color: {{ $ball }}"></span>
                        @endforeach
                    </td>
                    <td>
                        @foreach(json_decode($value->groups) as $balls)
                            <p>Group {{ $loop->iteration }}</p>
                            @foreach($balls as $color => $ball)
                                @for($i=1;$i<=$ball; $i++)
                                    <span class="dot" style="background-color: {{ $color }}"></span>
                                @endfor
                            @endforeach
                            <br />
                        @endforeach
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection

@section('after_styles')
    @parent()
    <style>
        .dot {
            height: 15px;
            width: 15px;
            border-radius: 50%;
            display: inline-block;
            border:1px solid black;
        }
    </style>
@endsection
