<div class="col-lg-6">
    <div class="panel panel-default">
        <div class="panel-heading"><a href="/portfolio/{{ $share['id'] }}">{{ $share['name'] }}</a></div>
        <div class="panel-body">
            <table class="table">
                <tr>
                    <td></td><td>Past</td><td>Now</td><td>Profit</td><td>%</td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td>{{ $share['past_price'] }}</td>
                    <td>{{ $share['now_price'] }}</td>
                    <td>{{ $share['profit_price'] }}</td>
                    <td>{{ $share['profit_price_percentage'] }}</td>
                </tr>
                <tr>
                    <td>Amount</td>
                    <td>{{ $share['past_amount'] }}</td>
                    <td>{{ $share['now_amount'] }}</td>
                    @if($share['profit_amount'] > 0)
                        <td><b style="color:green;">{{ $share['profit_amount'] }}</b></td>
                    @else
                        <td><b style="color:red;">{{ $share['profit_amount'] }}</b></td>
                    @endif
                </tr>
            </table>
        </div>
    </div>
</div>