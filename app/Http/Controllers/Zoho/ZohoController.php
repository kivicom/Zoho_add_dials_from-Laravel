<?php

namespace App\Http\Controllers\Zoho;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ZohoController extends Controller
{

    protected $url_token = 'https://accounts.zoho.com/oauth/v2/token';
    protected $refresh_token = [
                                    'refresh_token'	=> '1000.24de957e194b86647e46811b9c1bb04d.39dbf29c06fd6992f8206c188c3cc13a',
                                    'client_id'		=> '1000.QC9IEOXMY79KEU65R7ZT6E3F1DGZWK',
                                    'client_secret'	=> '7efb3b965bb8e9c5868e41d44bd8efa43523101dda',
                                    'grant_type'	=> 'refresh_token'
                                ];

    protected $url_deal = "https://www.zohoapis.com/crm/v2/Deals";
    protected $access_token;


    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deal_data(Request $request)
    {
        $data = $request->except('_token');
        return $this->insert_deal($data);

    }

    /**
     * @param $data
     * @return \Illuminate\Http\RedirectResponse
     */
    public function insert_deal($data)
    {
        $this->access_token = $this->generate_access_token();

        $post_data = [
            'data' => [
                $data
            ]
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url_deal);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Zoho-oauthtoken '.$this->access_token,
            'Content-Type: application/x-www-form-urlencoded'
        ));
        curl_exec($ch);

        /*$response = curl_exec($ch);
        $response = json_decode($response);*/

        return redirect()->route('home')->with('success', 'Сделка добавлена');
    }

    /**
     * @return mixed
     */
    public function generate_access_token()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url_token);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($this->refresh_token));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));

        $response = curl_exec($ch);
        $response = json_decode($response);

        return $response->access_token;
    }
}
