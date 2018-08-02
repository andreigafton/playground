@section('after_styles')
    @parent()
    <style>
        .dot {
            height: 40px;
            width: 40px;
            border-radius: 50%;
            display: inline-block;
            border:1px solid black;
        }
    </style>
@endsection

{{ Form::open(array('url' => route('color.store'), 'method' => 'POST', 'id'=>'colorsForm')) }}
<div class="form-group">
    {{ Form::label('colors', 'Number of colors') }}
    {{ Form::number('colors', old('colors'), array('class' => 'form-control')) }}
    <div class="invalid-feedback">

    </div>
</div>


{{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

<div class="col-md-12" id="balls"></div>
<div class="col-md-12" id="groups"></div>

@section('after_scripts')
    @parent()
    <script type='text/javascript'>
        $(document).ready(function() {
            $("form#colorsForm").submit(function(e){
                e.preventDefault(e);

                var form = $(this);

                var route = form.attr('action');
                var method = form.attr('method');

                form.find("input[type=submit]").attr('disabled', true);

                $.ajax({
                    url: route,
                    type: method,
                    dataType: 'json',
                    data: $(this).serialize(),
                    success: function(data) {
                        console.log(data);

                        $('#balls').html('<hr/><h1>Generated Balls</h1>');
                        $('#groups').html('<hr/><h1>Generated Groups</h1>');

                        $.each(data.balls, function(i, ball){
                            var ballHTML = '<span class="dot" style="background-color: '+ball+'"></span>'
                           $('#balls').append(ballHTML)
                        });

                        $.each(data.groups, function(i, group){
                            $('#groups').append('<div class="col-md-12" id="group_'+i+'"><h2>Group '+ (i+1) +'</h2></div>');
                            $.each(group, function(j, ball){
                                for(b=1;b<=ball;b++){
                                    var ballHTML = '<span class="dot" style="background-color: '+j+'"></span>'
                                    $("#group_"+i).append(ballHTML);
                                }

                            });
                        });
                        form.find("input[type=submit]").removeAttr('disabled');

                    },
                    error(data){
                        console.log(data.responseJSON);
                        alert(data.responseJSON.message);
                        $.each(data.responseJSON.errors, function(name, message){
                            $('[name="'+name+'"]').addClass('is-invalid');
                            $('[name="'+name+'"]').parent().find('.invalid-feedback').html(message[0]);
                        });
                        form.find("input[type=submit]").removeAttr('disabled');
                    }
                });

            });
        });
    </script>
@endsection