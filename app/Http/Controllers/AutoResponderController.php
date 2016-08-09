<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Heonozis\AR\MailChimp;
use Heonozis\AR\GetResponse;

class AutoResponderController extends Controller
{
    public function mailchimp(Request $request)
    {
    	return MailChimp::lists($request->get('key'));
    }

    public function getresponse(Request $request)
    {
    	return GetResponse::campaigns($request->get('key'));
    }
}
