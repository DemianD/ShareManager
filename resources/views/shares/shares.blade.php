@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1" id="shares">
                @include('shares._shares')
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="btn-group" role="group" aria-label="...">
                    <a href="{{ url('/shares') }}" class="btn btn-default">Refresh</a>
                    <a href="{{ url('/shares/create') }}" class="btn btn-default">New share</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    function updateShares() {
        $.get("/shares", function (data) {
            $("#shares").html(data);
        });
    }

    window.setInterval(function(){
        updateShares();
    }, 5000);
</script>
@endsection
