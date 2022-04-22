<?php

require_once PLUGIN_DIR_PATH . 'traits/configurationTrait.php';


class cancelShippingController{

    use configurationTrait;

    public function __construct(){

        global $wpdb;
        global $table_prefix;

        $this->wpdb = $wpdb;
        $this->table_prefix = $table_prefix;
        $this->table_name_responseshipping = $table_prefix . 'fedex_shipping_intra_mx_responseshipping';
        $this->table_name_ordersend = $table_prefix . 'fedex_shipping_intra_mx_ordersend';
        $this->table_name_posts = $table_prefix . 'posts';

    }

    public function index($orderId){

        $params  = configurationTrait::account();

        $result = $this->wpdb->get_results("SELECT masterTrackingNumber FROM $this->table_name_ordersend WHERE orderNumber = $orderId", ARRAY_A);


        foreach ($result as $key => $value) {
            $masterTrackingNumber = $value['masterTrackingNumber'];
        }

        /**Datos de la cuenta */
        $accountNumber = $params['accountNumber'];
        $meterNumber = $params['meterNumber'];
        $wskeyUserCredential = $params['wskeyUserCredential'];
        $wskeyPasswordCredential = $params['wskeyPasswordCredential'];

        if($params['environment'] == 'PRODUCTION'){
            $url = "https://lac-ship-service-v2dev.app.wtcdev2.paas.fedex.com/ship/cancelShipment";
        }else{
            $url = 'https://lac-ship-service-v2dev.app.wtcdev2.paas.fedex.com/ship/cancelShipment';
        }

        /******************************************** */

        /**Solicitud de eliminación */
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "credential": {
                "accountNumber": "' .$accountNumber. '",
                "meterNumber": "' .$meterNumber . '",
                "wskeyUserCredential": "' .$wskeyUserCredential. '",
                "wspasswordUserCredential": "' .$wskeyPasswordCredential. '"
            },
            "masterTrackingNumber": "'.$masterTrackingNumber.'"
        }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        //echo $response;


        $arrayResponse[] = json_decode($response, true);

        foreach ($arrayResponse as $key => $value) {
            $arrayResponse = $value;

        }
        

        if($arrayResponse['status'] == 'AUTHORIZED'){

            //Borro de las tablas el envio generado
            $this->wpdb->delete($this->table_name_ordersend, array('orderNumber' => $orderId));
            $this->wpdb->delete($this->table_name_responseshipping, array('orderNumber' => $orderId));
            $this->wpdb->update($this->table_name_posts, array('post_status' => 'wc-completed'), array('id' => $orderId));

         echo json_encode(
            array(
                "status" => "AUTHORIZED",
                'message' => 'Se eliminaron los registros del envío'
            ), 
            true
        ); 
 
    }else{
        echo json_encode(
            array(
                "status" => "ERROR",
                'message' => 'No se pudo eliminar el envío',
                'status_message' => $arrayResponse['status_message']
            ), 
            true
        ); 
    }

    

    die();

    }



}