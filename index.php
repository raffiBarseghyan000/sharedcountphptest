<?php
class Sharedcount {
    private $apiToken;
    private $curl;

    function __construct($apiToken) {
        $this->setApiToken($apiToken);
        $this->curl = curl_init();
    }
   
    function setApiToken($apiToken) {
        $this->apiToken = $apiToken;
    }

    function getQuota($urlToCheck) {
        curl_setopt_array($this->curl, array(
            CURLOPT_URL => "https://api.sharedcount.com/v1.0?apikey=" . $this->apiToken . "&url=" . $urlToCheck,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($this->curl);
        curl_close($this->curl);
        return json_decode($response, true);
    }

    function getBulkId($urlArray) {
        $urlArray = implode("\n",$urlArray);
        curl_setopt_array($this->curl, array(
            CURLOPT_URL => "https://api.sharedcount.com/v1.0/bulk?apikey=" . $this->apiToken,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $urlArray,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: text/plain"
            ),
        ));

        $response = curl_exec($this->curl);
        curl_close($this->curl);
        return json_decode($response, true);
    }

    function getBulkQuota($bulkId) {
        curl_setopt_array($this->curl, array(
            CURLOPT_URL => "https://api.sharedcount.com/v1.0/bulk?apikey=" . $this->apiToken . "&bulk_id=" . $bulkId,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($this->curl);
        curl_close($this->curl);
        return json_decode($response, true);
    }
}
