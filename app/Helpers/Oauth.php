<?php

if (!function_exists('getProvider')) {
    function getProvider()
    {
        return new \League\OAuth2\Client\Provider\GenericProvider([
            'clientId' => env("clientId"),    // The client ID assigned to you by the provider
            'clientSecret' => env("clientSecret"),   // The client password assigned to you by the provider
            'urlAuthorize' => env("authURL"),
            'urlAccessToken' => env("apiURL") . '/oauth/access-token',
            'urlResourceOwnerDetails' => env("apiURL") . '/api/v1/me',
            'redirectUri' => "http://savethechange.yarbsemaj.com/api/callback"
        ]);
    }
}

if (!function_exists('refreshToken')) {
    function refreshToken(\League\OAuth2\Client\Token\AccessToken $existingAccessToken, $userID)
    {
        if ($existingAccessToken->hasExpired()) {
            $newAccessToken = getProvider()->getAccessToken('refresh_token', [
                'refresh_token' => $existingAccessToken->getRefreshToken()
            ]);
            $user = \App\StarlingUser::findOrFail($userID);
            $user->access_token = $newAccessToken->getToken();
            $user->refresh_token = $newAccessToken->getRefreshToken();
            $user->expires_at = $newAccessToken->getExpires();
            $user->save();
            return $newAccessToken;
        }
        return $existingAccessToken;
    }
}

if (!function_exists('getAccessToken')) {
    function getAccessToken($userID)
    {
        print $userID;
        $user = \App\StarlingUser::find(1);

        return refreshToken(new \League\OAuth2\Client\Token\AccessToken($user->toArray()), 1);
    }
}

if (!function_exists('apiRequest')) {
    function apiRequest($accessToken, $url, $method, $options = [])
    {
        $provider = getProvider();
        $request = $provider->getAuthenticatedRequest(
            $method,
            env("apiURL") . $url,
            $accessToken,
            $options
        );
        return $provider->getParsedResponse($request);
    }
}

if (!function_exists('apiRequestForCurrentUser')) {
    function apiRequestForCurrentUser($url, $method, $options = [])
    {
        $provider = getProvider();
        $request = $provider->getAuthenticatedRequest(
            $method,
            env("apiURL") . $url,
            getAccessToken(session()->get("user_id")),
            $options);
        return $provider->getParsedResponse($request);
    }
}
