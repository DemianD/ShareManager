@foreach($shares as $share)
    @include('portfolio._share', array('share' => $share))
@endforeach