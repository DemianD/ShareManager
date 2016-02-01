<?php namespace App\ShareManager\YahooFinanceApi;



class ApiClient {

    private $consumerKey;
    private $consumerSecret;

    private $httpClient;
    public function __construct()
    {
        $this->consumerKey = env('API_YAHOO_CONSUMER_KEY');
        $this->consumerSecret = env('API_YAHOO_CONSUMER_SECRET');

        $this->httpClient = new HttpClient($this->consumerKey, $this->consumerSecret);
    }

    public function getDataFromSymbols($symbols)
    {
        if(!is_array($symbols)) {
            $symbols = Array($symbols);
        }

        $q = 'select symbol, LastTradePriceOnly, LastTradeTime, StockExchange from yahoo.finance.quotes where symbol in ("'.implode('","', $symbols).'")';
        $data = $this->httpClient->executeQuery($q);

        var_dump($data['query']['results']);
        return $data['query']['results'];
    }
}