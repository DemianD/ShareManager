<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuyRequest;
use App\Share;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PortfolioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $shares = array();
        foreach(\Auth::user()->shares as $share)
        {
            $shares[] = $this->getSharePortfolio($share);
        }

        if($request->ajax())
            return view('portfolio._portfolio')->with('shares', $shares);
        else
            return view('portfolio.index')->with('shares', $shares);
    }

    public function showShare($id)
    {
        $share = Auth::user()->shares()->where('pivot_id', $id)->first();
        return view('portfolio.show')->with('share', $share);
    }

    public function showBuy(Share $share)
    {
        return view('portfolio.buy')->with('share', $share);
    }

    public function pushBuy(Share $share, BuyRequest $request)
    {
        $currentPrice = $share->getlastPrice();
        \Auth::user()->shares()->save($share, ['boughtFor' => $currentPrice, 'amount' => $request->input('amount')]);

        return redirect('portfolio');
    }


    private function getSharePortfolio(Share $share)
    {
        $past_price                 = $share->pivot->boughtFor;
        $now_price                  = $share->getlastPrice();
        $profit_price               = ($now_price - $past_price);
        $profit_price_percentage    = (($now_price/$past_price))-1;

        $past_amount                = $share->pivot->amount;
        $now_amount                 = $past_amount * ($profit_price_percentage+1);

        $profit_amount              = $now_amount - $past_amount;
        $profit_amount_percentage   = (($now_amount/$past_amount))-1;

        return [
            'id' =>                     $share->pivot->id,
            'name' =>                   $share->name,
            'past_price' =>             number_format((float)$past_price, 2, '.', ''),
            'past_amount'  =>           number_format((float)$past_amount, 2, '.', ''),
            'now_price' =>              number_format((float)$now_price, 2, '.', ''),
            'now_amount' =>             number_format((float)$now_amount, 2, '.', ''),
            'profit_price' =>           number_format((float)$profit_price, 2, '.', ''),
            'profit_price_percentage' =>    number_format((float)$profit_price_percentage*100, 2, '.', '') . ' %',
            'profit_amount' =>              number_format((float)$profit_amount, 2, '.', ''),
            'profit_amount_percentage' =>   number_format((float)$profit_amount_percentage*100, 2, '.', '') . ' %',
        ];
    }
}
