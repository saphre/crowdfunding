<?php

namespace App\Models\Utilities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

class WebServiceAPI extends Model
{
    use HasFactory;

    /**
     * Calls the Web Service API and returns the adequate data
     * 
     */

    private function callAPI($method, $url, $data, $bearerToken = null)
    {

        $curl = curl_init();
        $csrf_token = csrf_token();
        // OPTIONS:

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $bearerToken,
            'X-XSRF-TOKEN : ' . $csrf_token

        ));
        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                }
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($data) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                }
                break;
            case "DELETE":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
                
                break;
            case "GET":
                if ($data) {
                    $url = sprintf("%s?%s", $url, http_build_query($data));
                } else {
                    curl_setopt($curl, CURLOPT_URL, $url);
                }
        }

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //  curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        // EXECUTE:
        $result = curl_exec($curl);
        if (!$result) {
            die("Connection Failure");
        }
        curl_close($curl);
        return $result;
    }

    public function login($data)
    {

        return $this->callAPI('POST', '127.0.0.2:8080/api/auth/login', $data);
    }

    /**
     * Donations
     */

    public function createDonation($data)
    {
        $bearerToken = session(0)->token;
        return $this->callAPI('POST', '127.0.0.2:8080/api/donations', $data, $bearerToken);
    }

    public function getDonations($data)
    {
        $bearerToken = session(0)->token;
        return $this->callAPI('GET', '127.0.0.2:8080/api/donations', $data, $bearerToken);
    }
    public function findDonation($data)
    {
        $bearerToken = session(0)->token;
        return $this->callAPI('GET', '127.0.0.2:8080/api/donations/' . $data, null, $bearerToken);
    }
    public function updateDonation($data, $id)
    {
        $bearerToken = session(0)->token;
        return $this->callAPI('PUT', '127.0.0.2:8080/api/donations/' . $id, $data, $bearerToken);
    }
    public function deleteDonation($data)
    {
        $bearerToken = session(0)->token;
        return $this->callAPI('DELETE', '127.0.0.2:8080/api/donations/' . $data, null, $bearerToken);
    }
    public function donate($data)
    {
        $bearerToken = session(0)->token;
        return $this->callAPI('POST', '127.0.0.2:8080/api/donation/donate', $data, $bearerToken);
    }
    public function myDonations($data)
    {
        $bearerToken = session(0)->token;
        return $this->callAPI('GET', '127.0.0.2:8080/api/donations/my-donations/' . $data, null, $bearerToken);
    }

    /**
     * Categories
     */
    public function getCategories($data)
    {
        $bearerToken = session(0)->token;
        return $this->callAPI('GET', '127.0.0.2:8080/api/categories', $data, $bearerToken);
    }


    /**
     * Currencies
     */
    public function getCurrencies($data)
    {
        $bearerToken = session(0)->token;
        return $this->callAPI('GET', '127.0.0.2:8080/api/currencies', $data, $bearerToken);
    }
}
