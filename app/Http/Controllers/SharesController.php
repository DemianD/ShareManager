<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShareRequest;
use App\Share;
use App\ShareManager\FinanceApi;
use App\ShareManager\GuruwatchApi;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


class SharesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $shares = Share::with(['prices' => function($query) {
            $query->orderBy('created_at', 'DESC');
        }])->orderBy('symbol', 'ASC')->get();

        if($request->ajax())
            return view('shares._shares')->with('shares', $shares->toArray());

        return view('shares.shares')->with('shares', $shares->toArray());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shares.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShareRequest $request)
    {
        Share::create($request->all());
        return redirect('/shares');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Share $share)
    {
        // todo
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Share $share)
    {
        return view('shares.edit')->with('share', $share);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShareRequest $request, Share $share)
    {
        $share->update($request->all());
        return redirect('/shares');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Share $share)
    {
        $share->delete();
        return redirect('/shares');
    }

    public function updatePrices()
    {
        $shareSymbols = Share::lists('symbol')->toArray();

        $financeApi = new FinanceApi($shareSymbols);
        $financeApi->fetchDataAndStore();
    }

    public function updateGuruwatch()
    {
        $shareSymbols = Share::lists('symbol')->toArray();

        $financeApi = new FinanceApi($shareSymbols);
        $financeApi->storeAdvices();
    }
}
