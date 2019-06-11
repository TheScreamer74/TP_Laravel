<?php

namespace App\Http\Controllers;

use App\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class UrlsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('welcome');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $url = request('url');
        Validator::make(
            compact('url'),
            ['url' => 'required|url'],
            [
                'url.require' => 'vous devez fournir une URL',
                'url.url' => "l'URL est invalide"
            ])->validate();
        $record = Url::where('url', $url)->first();
        if($record) {
            return view('result')->with('shortened', $record->shortened);
        }
        $row = Url::create([
            'url' => $url,
            'shortened' => Url::getUniqueShortUrl()
        ]);
        if($row) {
            return view('result')->with('shortened', $row->shortened);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  $shortened
     * @return \Illuminate\Http\Response
     */
    public function show($shortened)
    {
        $url = Url::where('shortened', $shortened)->first();
        if(! $url){
            return redirect('/');
        }
        return redirect($url->url);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function edit(Url $url)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Url $url)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function destroy(Url $url)
    {
        //
    }
}
