<?php namespace App\ShareManager;

use App\Share;
use App\ShareManager\YahooFinanceApi\ApiClient;
use App\SharePrice;
use Carbon\Carbon;

class FinanceApi {

    private $apiClient;
    private $symbols;

    public function __construct($symbols)
    {
        if(!is_array($symbols)) {
            $symbols = Array($symbols);
        }
        $this->symbols = $symbols;

        $this->apiClient = new ApiClient();
    }

    public function getDataFromSymbols()
    {
        return $this->apiClient->getDataFromSymbols($this->symbols);
    }

    public function fetchDataAndStore()
    {
        $shares = $this->getDataFromSymbols();
        foreach($shares['quote'] as $share)
        {
            $shareObj = Share::where('symbol', $share['symbol'])->firstOrFail();

            $date = Carbon::createFromFormat('G:ia', $share['LastTradeTime']);
            $price = new SharePrice(['price' => $share['LastTradePriceOnly'], 'lastTradeDate' => $date]);

            if($shareObj->prices()->count() >= 12)
                $shareObj->prices()->orderBy('id', 'ASC')->first()->delete();

            $shareObj->prices()->save($price);
        }
    }

    public function storeAdvices()
    {
        $guruwatchApi = new GuruwatchApi();

        foreach($this->symbols as $symbol) {
            $share = Share::where('symbol', $symbol)->firstOrFail();
            $guruwatchApi->storeAdvices($share);
        }
    }
}