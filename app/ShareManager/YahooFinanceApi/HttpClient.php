<?php namespace App\ShareManager\YahooFinanceApi;

use App\ShareManager\YahooFinanceApi\Exception\YahooFinanceApiException;

use App\ShareManager\OAuth\OAuthRequest;
use App\ShareManager\OAuth\OAuthConsumer;
use App\ShareManager\OAuth\OAuthSignatureMethod_HMAC_SHA1;
use App\ShareManager\OAuth\OAuthUtil;


class HttpClient
{
    private $url = 'http://query.yahooapis.com/v1/yql';

    private $consumer;

    public function __construct($cKey, $cSecret)
    {
        $this->consumer = new OAuthConsumer($cKey, $cSecret);
    }

    public function executeQuery($q, $token = null, $method = "GET")
    {
        $args = ['format' => 'json', 'q' => 'env \'store://datatables.org/alltableswithkeys\'; '.$q];

        $request = OAuthRequest::from_consumer_and_token(
            $this->consumer,
            $token,
            $method,
            $this->url,
            $args);

        $request->sign_request(new OAuthSignatureMethod_HMAC_SHA1(), $this->consumer, NULL);
        $url = sprintf("%s?%s", $this->url, OAuthUtil::build_http_query($args));

        return $this->doCurl([$request->to_header()], $url);
    }

    /**
     * @param $headers
     * @param $url
     * @throws YahooFinanceApiException
     */
    private function doCurl($headers, $url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $rsp = curl_exec($ch);
        curl_close($ch);
        $rsp = json_decode($rsp, true);

        if(isset($rsp['error']))
            throw new YahooFinanceApiException("Error: " . $rsp['error']['description']);

        return $rsp;
    }
}

