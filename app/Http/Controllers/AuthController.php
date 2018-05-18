<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\OAuth2\Client\Provider\GenericProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;

class AuthController extends Controller
{
    public function callback(Request $request)
    {
        $provider = new GenericProvider([
            'clientId'                => getenv('SLACK_CLIENT_ID'),
            'clientSecret'            => getenv('SLACK_CLIENT_SECRET'),
            'redirectUri'             => getenv('SLACK_REDIRECT_URI'),
            'urlAuthorize'            => 'https://slack.com/oauth/authorize',
            'urlAccessToken'          => 'https://slack.com/api/oauth.access',
            'urlResourceOwnerDetails' => 'https://slack.com/api/users.info'
        ]);

        if ($request->input('code')) {
            try {
                // We'll just request an access token and do nothing with it, which will complete the OAuth flow.
                $provider->getAccessToken('authorization_code', [
                    'code' => $request->input('code')
                ]);
            } catch (IdentityProviderException $e) {
                // Silently fail... shhhh.
            }
        }

        return redirect()->to('/thanks');
    }
}
