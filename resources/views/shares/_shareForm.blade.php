<div class="form-group">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', null, array('class' => 'form-control')) !!}
</div>

<div class="form-group">
    {!! Form::label('symbol', 'Symbol') !!}
    {!! Form::text('symbol', null, array('class' => 'form-control')) !!}
</div>

<div class="form-group">
    {!! Form::label('guruwatch', 'Guruwatch') !!}
    {!! Form::text('guruwatch', null, array('class' => 'form-control')) !!}
</div>


{!! Form::hidden('exchange_id', '1') !!}


{!! Form::submit($formSubmitText, array('class' => 'btn btn-default')) !!}