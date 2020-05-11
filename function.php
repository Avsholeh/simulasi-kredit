<?php
header("Content-Type:application/json");

if (isset($_GET['param'])) {
    
} else {

    response("param");

}

function response($param){
    $response['param'] = $param;
    $json_response = json_encode($response);
    echo $json_response;
}

function metode_flat() {

}

function metode_efektif() {

}

function metode_anuitas() {

}
?>