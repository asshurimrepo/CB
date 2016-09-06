<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Heonozis\AR\MailChimp;
use Heonozis\AR\GetResponse;
use Heonozis\AR\AweberSettings;
use Heonozis\AR\Aweber;

class AutoResponderController extends Controller
{

	private $consumerKey = 'AkNTNlHOWZxTWQlsO4498KIE';
	private $consumerSecret = 'dhfSIpepCwRzCf4SfuoL7Hrcmy3b4vMpHJv8CxpK';

    public function mailchimp(Request $request)
    {
    	return MailChimp::lists($request->get('key'));
    }

    public function getresponse(Request $request)
    {
    	return GetResponse::campaigns($request->get('key'));
    }

    public function aweberAuthorize(Request $request)
    {
		$application = new \AWeberAPI($this->consumerKey, $this->consumerSecret);

		list($requestToken, $tokenSecret) = $application->getRequestToken('oob');

		session()->forget(['request_token', 'token_secret']);

		session()->put('request_token', $requestToken);
		session()->put('token_secret', $tokenSecret);

		return $application->getAuthorizeUrl();
    }

    public function aweberAccessToken(Request $request)
    {
    	$application = new \AWeberAPI($this->consumerKey, $this->consumerSecret);

    	$application->user->requestToken = session()->get('request_token');
		$application->user->tokenSecret = session()->get('token_secret');
		$application->user->verifier = $request->get('key');

		list($access_token, $access_secret) = $application->getAccessToken();

		return compact('access_token', 'access_secret');
    }

    public function aweber(Request $request)
    {
		$application = new \AWeberAPI($this->consumerKey, $this->consumerSecret);

		return Aweber::lists(
			$application,
			$request->get('access_token'),
			$request->get('access_secret')
		);

    }

}

