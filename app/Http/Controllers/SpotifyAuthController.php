<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SpotifyWebAPI\SpotifyWebAPI;
use SpotifyWebAPI\Session;

class SpotifyAuthController extends Controller
{
    public function redirectToSpotify()
    {
        $session = new Session(
            config('services.spotify.client_id'),
            config('services.spotify.client_secret'),
            config('services.spotify.redirect')
        );

        $options = [
            'scope' => [
                'user-read-private',
                'user-read-email',
                'user-modify-playback-state',
                'user-read-playback-state'
            ]
        ];

        return redirect($session->getAuthorizeUrl($options));
    }

    public function handleSpotifyCallback(Request $request)
    {
        $session = new Session(
            config('services.spotify.client_id'),
            config('services.spotify.client_secret'),
            config('services.spotify.redirect')
        );

        // Try to get an access token
        $session->requestAccessToken($request->get('code'));

        $accessToken = $session->getAccessToken();
        $refreshToken = $session->getRefreshToken();

        // Store tokens securely (in session or database)
        session([
            'spotify_access_token' => $accessToken,
            'spotify_refresh_token' => $refreshToken
        ]);

        return redirect('/music');
    }
}