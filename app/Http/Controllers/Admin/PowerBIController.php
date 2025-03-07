<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Auth;
use DB;
use Alert;

class PowerBIController extends Controller
{
	public function getEmbedInfo()
	{
		$client = new Client();

		$response = $client->request('POST', 'https://login.microsoftonline.com/common/oauth2/token', [
			'form_params' => [
				'grant_type' => 'password',
				'username' => 'pbview@ifciltd.com',
				'password' => 'Dashboard@1948',
				'client_id' => '3646f7fa-262f-48ae-8fef-6c6b9213ee76',
				'client_secret' => 'gLg8Q~bqahzcstbKX~YqRnOisIOyjRyG~0eA5cEx',
				'resource' => 'https://analysis.windows.net/powerbi/api'
			]
		]);

		$access_token = json_decode($response->getBody()->getContents())->access_token;

//238d5817-6b9a-424b-b61c-9a2a703d1167
		$response = $client->request('GET', 'https://api.powerbi.com/v1.0/myorg/groups/c21ff94e-1642-40ad-90a0-bdff6451faf6/dashboards/0f7722f4-a1e9-41b9-aaa7-826b7f3d37b5', [

			'headers' => [
				'Content-Type' => 'application/json',
				'Authorization' => 'Bearer ' . $access_token
			],
			'json' => [
				'accessLevel' => 'View',
				'allowSaveAs' => 'false'
			]
		]);

		$embed_url = json_decode($response->getBody()->getContents())->embedUrl;

		$response = $client->request('POST', 'https://api.powerbi.com/v1.0/myorg/groups/c21ff94e-1642-40ad-90a0-bdff6451faf6/dashboards/0f7722f4-a1e9-41b9-aaa7-826b7f3d37b5/GenerateToken', [
			'headers' => [
				'Content-Type' => 'application/json',
				'Authorization' => 'Bearer ' . $access_token
			],
			'json' => [
				'accessLevel' => 'View',
				'allowSaveAs' => 'false'
			]
		]);

		$embed_token = json_decode($response->getBody()->getContents())->token;
		return view('admin.report', compact('embed_url', 'embed_token'));

	}
}
