@extends('layouts.app')

@section('content')
    <div class="container">
        @include('portfolio._credit')

        <div class="row">
            <div id="portfolio">
                @include('portfolio._portfolio')
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function updateShares() {
            $.get("/portfolio", function (data) {
                $("#portfolio").html(data);
            });
        }

        window.setInterval(function(){
            updateShares();
        }, 5000);
    </script>
@endsection