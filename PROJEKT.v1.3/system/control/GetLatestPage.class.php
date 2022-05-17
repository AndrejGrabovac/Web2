<?php
include('../util/AbstractPage.class.php');

class GetLatestPage extends AbstractPage
{
    function code()
    {
        $url = "https://openexchangerates.org/api/latest.json?app_id=" . APP_ID;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $json = curl_exec($ch);
        curl_close($ch);

        $latest = json_decode($json, true);

        var_dump($latest);

        
    }
}
