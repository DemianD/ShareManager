@foreach($shares as $share)
    <h2>
        <a href="/shares/{{ $share['id'] }}/edit">{{ $share['symbol'] }}</a>
        <a href="/shares/{{ $share['id'] }}/buy" class="btn btn-success btn-xs pull-right">Buy</a>
    </h2>
    <table class="table table-bordered">
        <tr>
            @for($i = 0; $i < count($share['prices']); $i++)
                <?php
                    $class = '';
                    $price = $share['prices'][$i]['price'];
                    if(isset($share['prices'][$i+1]['price'])) {
                        $priceNext = $share['prices'][$i+1]['price'];
                        if($price > $priceNext)
                            $class = 'style="color:green; font-weight:bold"';
                    }

                    echo '<td class="col-md-1" '.$class.' title="'.date("d-m-Y h:i", strtotime($share['prices'][$i]['lastTradeDate'])).'">'.$share['prices'][$i]['price'].'</td>';
                ?>
            @endfor
        </tr>
    </table>
    <br />
@endforeach