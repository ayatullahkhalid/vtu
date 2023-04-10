<?php
class VTU {
  
  private $curl;
  private $curlPostOpts;
  private $curlGetOpts;

  public function __construct(){
    $this->curl = curl_init();
    $this->curlPostOpts = array(
      CURLOPT_URL => 'https://www.gladtidingsdata.com/api/',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Token 755ac52b4f54941e0c4ecc493ababad61dd5264f',
        'Content-Type: application/json'
      ));
    $this->curlGetOpts = array(
      CURLOPT_URL => 'https://gladtidingsdata.com/api/',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Token 755ac52b4f54941e0c4ecc493ababad61dd5264f',
        'Content-Type: application/json'
      ));
  }
  
  /**
  * @param Integer $network
  * @param String $phone
  * @param String $plan
  */
  public function buyData($network, $phone, $plan){
    $url = "data/";
    $postFields = json_encode([
      "network" => $network,
      "mobile_number" => $phone,
      "plan" => $plan,
      "Ported_number" => true
    ]);
    
    return $this->executePost($url, $postFields);
  }
  
  public function getDataPurchaseHistory(){
    $url = "data/";
    
    return $this->executeGet($url);
  }
  
  /**
  * @param Integer $network
  * @param String $phone
  * @param Integer $amount
  */
  public function buyAirtime($network, $phone, $amount){
    $url = "topup/";
    $postFields = json_encode([
      "network" => $network,
      "amount" => $amount,
      "mobile_number" => $phone,
      "Ported_number" => true,
      "airtime_type" => "VTU"
     ]);
    
    return $this->executePost($url, $postFields);
  }
  
  /**
  * @param String $exam; type of exam 
  * @param String $quantity; number of pins
  */
  public function buyEPin($exam, $quantity){
    $url = "epin/";
    $postFields = json_encode([
      "exam_name" => $exam,
      "quantity" => "$quantity"
     ]);
    
    return $this->executePost($url, $postFields);
  }
  
  /**
  * @param  $disco
  * @pqram Integer $amount
  * @param String $meter
  * @param String $type; type of comnection 1: Prepaid | 2: Postpaid 
  */
  public function buyElectricity($disco, $amount, $meter, $type){
    $url = "billpayment/";
    $postFields = json_encode([
      "disco_name" => $disco,
      "amount" => $amount,
      "meter_number" => $meter,
      "MeterType" => $type
     ]);
    
    return $this->executePost($url, $postFields);
  }
  
  
  /**
  * @param Integer $name; cable name id
  * @param String $plan; cable plan id
  * @param String $card_num; card number
  */
  public function buyCableSub($name, $plan, $card_num){
    $url = "cablesub/";
    $postFields = json_encode([
      "cablename" => $name,
      "cableplan" => $plan,
      "smart_card_number" => $card_num
     ]);
    
    return $this->executePost($url, $postFields);
  }
  
  /**
  * @param String $url
  * @param Array $postFields
  * 
  * return Array
  */
  private function executePost($url, $postFields){
    $curl = $this->curl;
    $options = $this->curlPostOpts;
   
    $options[CURLOPT_URL] = $options[CURLOPT_URL].$url;
    $options[CURLOPT_POSTFIELDS] = $postFields;
 
    curl_setopt_array($curl, $options);
    $response = curl_exec($curl);

    echo $response;
  }
  
  /**
  * @param String $url
  * 
  * return Array
  */
  private function executeGet($url){
    $curl = $this->curl;
    $options = $this->curlGetOpts;
   
    $options[CURLOPT_URL] = $options[CURLOPT_URL].$url;
 
    curl_setopt_array($curl, $options);
    $response = curl_exec($curl);
  
    echo $response;
  }
}
?>
