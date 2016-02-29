@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Adviezen
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            @foreach($share->recentGuruwatches as $guruwatch)
                                <tr>
                                    <td>{{ $guruwatch->pubDate->format('d-m') }}</td>
                                    <td><b>{{ $guruwatch->title }}</b><br />
                                        {{ $guruwatch->description }}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection