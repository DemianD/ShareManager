@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h2>New share</h2>
                <br />
                {!! Form::open(array('url' => 'shares')) !!}
                    @include('shares._shareForm', array('formSubmitText' => 'New share'))
                {!! Form::close() !!}

                <br />
                @include('layouts._errors')


            </div>
        </div>
    </div>
@endsection