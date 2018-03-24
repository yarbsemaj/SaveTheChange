<?php

namespace App\Http\Controllers;

use App\StarlingUser;

class OauthController extends Controller
{
    protected $provider;

    public function __construct()
    {
        $this->provider = new \League\OAuth2\Client\Provider\GenericProvider([
            'clientId' => env("clientId"),    // The client ID assigned to you by the provider
            'clientSecret' => env("clientSecret"),   // The client password assigned to you by the provider
            'urlAuthorize' => env("authURL"),
            'urlAccessToken' => env("apiURL") . '/oauth/access-token',
            'urlResourceOwnerDetails' => env("apiURL") . '/api/v1/me',
            'redirectUri' => "http://savethechange.yarbsemaj.com/api/callback"
        ]);
    }

    public function authorise()
    {

// If we don't have an authorization code then get one
        if (!isset($_GET['code'])) {
            $authorizationUrl = $this->provider->getAuthorizationUrl();
            session()->put("oauth2state", $this->provider->getState());
            header('Location: ' . $authorizationUrl);
            exit;
// Check given state against previously stored one to mitigate CSRF attack
        } elseif (empty($_GET['state']) || (session()->has("oauth2state") && $_GET['state'] !== session()->get("oauth2state"))) {
            if (session()->has("oauth2state"))
                session()->remove('oauth2state');
            exit('Invalid state');
        } else {
            try {
                // Try to get an access token using the authorization code grant.
                $accessToken = $this->provider->getAccessToken('authorization_code', [
                    'code' => $_GET['code']
                ]);
                // We have an access token, which we may use in authenticated
                // requests against the service provider's API.
                echo 'Access Token: ' . $accessToken->getToken() . "<br>";
                echo 'Refresh Token: ' . $accessToken->getRefreshToken() . "<br>";
                echo 'Expired in: ' . $accessToken->getExpires() . "<br>";
                echo 'Already expired? ' . ($accessToken->hasExpired() ? 'expired' : 'not expired') . "<br>";

                // Using the access token, we may look up details about the
                // resource owner.
                $resourceOwner = $this->provider->getResourceOwner($accessToken);


                $user = StarlingUser::updateOrCreate(
                    [
                        "customer_uid" => $resourceOwner->toArray()['customerUid']
                    ],
                    [
                        "access_token" => $accessToken->getToken(),
                        "refresh_token" => $accessToken->getRefreshToken(),
                        "expires_at" => $accessToken->getToken()
                    ]);

                session()->put("user_id", $user->id);
            } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {

                print_r($e->getResponseBody());
                // Failed to get the access token or user details.
                exit($e->getMessage());

            }

        }
    }
}
