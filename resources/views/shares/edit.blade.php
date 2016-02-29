@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h2>Edit share</h2>
                <br />
                {!! Form::model($share, array('route' => array('shares.update', $share->id), 'method' => 'put')) !!}
                    @include('shares._shareForm', array('formSubmitText' => 'Edit share'))
                {!! Form::close() !!}

                <br />
                @include('layouts._errors')
                <br />
                {!! Form::open(array('route' => array('shares.destroy', $share->id), 'method' => 'delete')) !!}
                    {!! Form::submit('Delete this share', array('class' => 'btn btn-default')) !!}
                {!! Form::close() !!}

                <br />
            </div>
        </div>
    </div>
@endsection