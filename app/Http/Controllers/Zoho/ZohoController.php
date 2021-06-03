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
    protected $access_token;

    protected $url_deal = "https://www.zohoapis.com/crm/v2/Deals";
    protected $url_tasks = "https://www.zohoapis.com/crm/v2/Tasks";




    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * @param $data
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add_deal(Request $request)
    {
        $this->access_token = $this->generate_access_token();

        $data_deal = $request->only(['Deal_Name','Account_Name','Closing_Date','Stage','Description']);
        $data_task = $request->only(['Subject','Due_Date','Priority','Description']);

        $post_deal = [
            'data' => [
                $data_deal
            ]
        ];
        $ch = $this->curl_init($this->url_deal, $post_deal);
        $ch = json_decode($ch, true);
        $id = $ch['data'][0]['details']['id'];

        return $this->add_task($id,$data_task);
    }

    public function add_task($id, $data_task)
    {
        $this->access_token = $this->generate_access_token();

        $data_task['$se_module'] = 'Deals';
        $data_task['What_Id'] = $id;

        $post_task = [
            'data' => [
                $data_task
            ]
        ];

        $this->curl_init($this->url_tasks, $post_task);

        return redirect()->route('home')->with('success', 'Сделка добавлена');
    }

    public function curl_init($url, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Zoho-oauthtoken '.$this->access_token,
            'Content-Type: application/x-www-form-urlencoded'
        ));
        return curl_exec($ch);
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
