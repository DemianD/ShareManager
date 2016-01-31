<?php namespace App\ShareManager\YahooFinanceApi;



class ApiClient {

    private $consumerKey;
    private $consumerSecret;

    private $httpClient;
    public function __construct()
    {
        $this->consumerKey = $_ENV['API_YAHOO_CONSUMER_KEY'];
        $this->consumerSecret = $_ENV['API_YAHOO_CONSUMER_SECRET'];

        $this->httpClient = new HttpClient($this->consumerKey, $this->consumerSecret);
    }

    public function getDataFromSymbols($symbols)
    {
        if(!is_array($symbols)) {
            $symbols = Array($symbols);
        }

        $q = 'select symbol, LastTradePriceOnly, StockExchange from yahoo.finance.quote where symbol in ("'.implode('","', $symbols).'")';
        $data = $this->httpClient->executeQuery($q);

        return $data['query']['results'];
    }
}