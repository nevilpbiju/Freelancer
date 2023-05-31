<?php
include_once 'api.php';
$file= $_GET['img'];
$IMGUR_CLIENT_ID ="7286e62c3558d10";
$imgurDataDP;
$imgurDataWall;

$extension = pathinfo($file, PATHINFO_EXTENSION);
$ext = strtolower($extension);
$ext_allowed = array('jpeg', 'jpg', 'png');
if(in_array($ext, $ext_allowed)){
    $source = file_get_contents($_FILES['dp']['tmp_name']);
    $postFileds = array('image' => base64_encode($source));
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.imgur.com/3/image'); 
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Client-ID 7286e62c3558d10'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFileds);
    $response = curl_exec($ch);
    curl_close($ch);
    $responseArr = json_decode($response);
    // print_r($response);
    if(!empty($responseArr->data->link)){
        $imgurDataDP = $responseArr->data->link;
    }
}
?>