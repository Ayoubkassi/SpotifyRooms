<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\Http;
use Auth;
use Carbon\Carbon;


use App\Models\Spotify;
use Illuminate\Http\Request;
use App\Http\Resources\Spotify as SpotifyResource;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Client\Response;


class SpotifyController extends BaseController
{
    
    public function getAuth(){
        $scopes = 'user-read-playback-state user-modify-playback-state user-read-currently-playing';
        $Client_id = "741cacc868864ff2b0aeea1bb4a27cbf";
        $Client_secret = "410ac875256846a2be3c3f65753f13ed";
        $redirect_uri = "";

        $url = Http::get('https://accounts.spotify.com/authorize', [
                            'scope'           => $scopes,
                            'response_type'   => 'code',
                            'redirect_uri'    => $redirect_uri,
                            'client_id'       => $Client_id,
                        ]); 

        return $this->sendResponse($url ,'URL generated succefully');

    }

    public function spotify_callback(Request $request){
        $Client_id = "741cacc868864ff2b0aeea1bb4a27cbf";
        $Client_secret = "410ac875256846a2be3c3f65753f13ed";
        $redirect_uri = "";
        $code = $request['code'];
        $error = $request['error'];

        $response = Http::post('https://accounts.spotify.com/api/token', [
                        'grant_type'    => 'authorization_code',
                        'code'          => $code ,
                        'redirect_uri'  => $redirect_uri,
                        'client_id'     => $Client_id,
                        'client_secret' => $Client_secret,
                    ])->json(); 

        $access_token = $response['acess_token'];
        $token_type = $response['token_type'];
        $refresh_token = $response['refresh_token'];
        $expires_in = $response['expires_in'];
        $error = $response['error'];


    }

    

    public function update_or_create_access_token($access_token,$token_type,$expires_in,$refresh_token){
        $tokens = Auth::user()['id'];
        $currentDateTime = Carbon::now();
        $expires_in = Carbon::now()->addHour();
    }

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Spotify  $spotify
     * @return \Illuminate\Http\Response
     */
    public function show(Spotify $spotify)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Spotify  $spotify
     * @return \Illuminate\Http\Response
     */
    public function edit(Spotify $spotify)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Spotify  $spotify
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spotify $spotify)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spotify  $spotify
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spotify $spotify)
    {
        //
    }
}
