@extends('layouts.app')

@section('content')
    <div class="container">
        @include('portfolio._credit')

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Buy share</div>
                    <div class="panel-body">
                        <ul>
                            <li>Share name: {{ $share->name }}</li>
                            <li>Share price: {{ $share->getLastPrice() }}</li>
                        </ul>
                        <hr />
                        {!! Form::open(array('url' => 'shares/'.$share->id.'/buy')) !!}
                        <div class="form-group">
                            {!! Form::label('amount', 'Amount') !!}
                            {!! Form::number('amount', null, array('class' => 'form-control')) !!}
                        </div>
                        {!! Form::submit('Buy', array('class' => 'btn btn-default')) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
                @include('layouts._errors')
            </div>
        </div>
    </div>
@endsection