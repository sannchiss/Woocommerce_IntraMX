<?php

require_once PLUGIN_DIR_PATH . 'traits/configurationTrait.php';


class createShippingController {

    use configurationTrait;
    
    public function __construct(){
        
        global $wpdb;
        global $table_prefix;
        
        $this->wpdb = $wpdb;
        $this->table_prefix = $table_prefix;
        $this->table_name_ordersend = $table_prefix . 'fedex_shipping_intra_mx_ordersend';
        $this->table_name_responseshipping = $table_prefix . 'fedex_shipping_intra_mx_responseshipping';
        $this->table_name_posts = $table_prefix . 'posts';
        
    }
    
    public function index($collection){

        
        $params  = configurationTrait::account();

         /**Datos de la cuenta */
         $accountNumber = $params['accountNumber'];
         $meterNumber = $params['meterNumber'];
         $wskeyUserCredential = $params['wskeyUserCredential'];
         $wskeyPasswordCredential = $params['wskeyPasswordCredential'];


        if($params['environment'] == 'PRODUCTION'){
            $url = "https://ws.fedex.com/LAC/ServicesAPI-v2dev.app.wtcdev2.paas.fedex.com/ship/createShipment";
        }else{
            $url = 'https://lac-ship-service-v2dev.app.wtcdev2.paas.fedex.com/ship/createShipment';
        }


        // Inserto en BD
           $this->wpdb->insert($this->table_name_ordersend, $collection);


        /** */
 
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
                "accountNumber": "'.$accountNumber.'",
                "meterNumber": "'.$meterNumber.'",
                "wskeyUserCredential": "' .$wskeyUserCredential. '",
                "wspasswordUserCredential": "'.$wskeyPasswordCredential.'"
            },
            "shipper": {
                "contact": {
                    "personName": "' .$collection['personNameShipper']. '",
                    "phoneNumber": "' .$collection['phoneShipper']. '",
                    "companyName": "' .$collection['companyNameShipper']. '",
                    "email": "' .$collection['emailShipper']. '",
                    "vatNumber": "' .$collection['vatNumberShipper']. '"
                },
                "address": {
                    "city": "' .$collection['cityShipper'].'",
                    "stateOrProvinceCode": "' .$collection['stateOrProvinceCodeShipper']. '",
                    "postalCode": "' .$collection['postalCodeShipper']. '",
                    "countryCode": "' .$collection['countryCodeShipper']. '",
                    "residential": false,
                    "streetLine1": "' .$collection['addressLine1Shipper']. '",
                    "streetLine2": " ' .$collection['addressLine2Shipper']. '",
                    "taxId": " ' .$collection['taxIdShipper']. '",
                    "ie": "' .$collection['ieShipper']. '"
                }
            },
            "recipient": {
                "contact": {
                    "personName": "' .$collection['personNameRecipient']. '", 
                    "phoneNumber": "' .$collection['phoneNumberRecipient']. '",
                    "companyName": "' .$collection['companyNameRecipient']. '",
                    "email": "' .$collection['emailRecipient']. '",
                    "vatNumber": "' .$collection['vatNumberRecipient']. '"
                },
                "address": {
                    "city": "' .$collection['cityRecipient']. '",
                    "stateOrProvinceCode": "' .$collection['stateOrProvinceCodeRecipient']. '",
                    "postalCode": "' .$collection['postalCodeRecipient']. '",
                    "countryCode": "' .$collection['countryCodeRecipient']. '",
                    "residential": false,
                    "streetLine1": "' .$collection['streetLine1Recipient']. '",
                    "streetLine2": "' .$collection['streetLine2Recipient']. '",
                    "taxId": "' .$collection['taxIdRecipient']. '",
                    "ie": "' .$collection['ieRecipient']. '"
                }
            },
            "shipDate": "'.$collection['orderDate'].'",
            "serviceType": "' .$collection['serviceType']. '",
            "packagingType": "' .$collection['packagingType']. '",
            "shippingChargesPayment": {
                "paymentType": "' .$collection['paymentType']. '",
                "accountNumber": "' .$params['accountNumber']. '"
            },            
            "labelType": "'.$collection['labelType'].'",
            "requestedPackageLineItems": [
                {
                    "itemDescription": "Ver Nota Fiscal",
                    "weight": {
                        "value": ' .$collection['weight']. ',
                        "units": "' .strtoupper($collection['weightUnits']). '"
                    },
                    "dimensions": {
                        "length": ' .$collection['length']. ',
                        "width": ' .$collection['width']. ',
                        "height": ' .$collection['height']. ',
                        "units": "' .strtoupper($collection['dimensionUnits']). '"
                    }
                }
            ],
            "clearanceDetail": {
                "documentContent": "NON_DOCUMENT",
                "commodities": [
                    {
                        "description": "Ver Nota Fiscal",
                        "countryOfManufacture": "MX",
                        "numberOfPieces": 1,
                        "weight": {
                            "value": ' .$collection['weight']. ',
                            "units": "' .$collection['weightUnits']. '"
                        },
                        "quantity": ' .$collection['numberOfPieces']. ',
                        "quantityUnits": "unit",
                        "unitPrice": {
                            "amount": 0,
                            "currency": "NMP"
                        }
                    }
                ]
            },
            "references": [
                {
                    "customerReferenceType": "CUSTOMER_REFERENCE",
                    "value": ' .$collection['orderNumber']. '
                }
            ],
            "declaredValue": {
                "amount": 0,
                "currency": "NMP"
            },
            "insuranceValue": {
                "amount": 0,
                "currency": "NMP"
            }
        }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $arrayResponse[] = json_decode($response, true);

        
        foreach ($arrayResponse as $key => $value) {

            $masterTrackingNumber['masterTrackingNumber'] = $value["masterTrackingNumber"];
            $status['status'] = $value["status"];
            $comments['comments'] = $value['comments'];

            foreach($value["labelResponse"] as $key2 => $value2){

                foreach($value2["contentResponse"] as $key3 => $value3){

                    $labelBase64[$key2][$key3] = $value3["bufferBase64"];

                }

            }
       
        
        }



        // Selecciono el tipo de etiqueta de la configuración

        if($collection['labelType']== 'PDF'){

            $labelType = 'PDF';

        }elseif($collection['labelType']== 'PNG'){

            $labelType = 'PNG';

        }elseif($collection['labelType']== 'ZPL'){

            $labelType = 'ZPL';    

        }elseif($collection['labelType']== 'EPL'){             

            $labelType = 'EPL';

        }



     

    if($status['status'] == 'AUTHORIZED')
       {

      foreach ($labelBase64 as $key => $value) {

        $this->wpdb->insert($this->table_name_responseshipping, array(
            
            'orderNumber' => $collection['orderNumber'],
            'orderDate' => date('Y-m-d H:i:s'),
            'masterTrackingNumber' => $masterTrackingNumber['masterTrackingNumber'],
            'status' => $flat['status'],
            'labelType' => $collection['labelType'],
            'labelBase64IMG' => $labelType == 'PNG' ? $value[0] : '',
            'labelBase64PDF' => $labelType == 'PDF' ? $value[0] : '',
            'labelBase64ZPL' => $labelType == 'ZPL' ? $value[0] : '',
            'labelBase64EPL' => $labelType == 'EPL' ? $value[0] : '',

        ));


        }

        //Edito el estado de la orden a Enviado con FedEx
        $post_status = "wc-fedex";
        $this->wpdb->update($this->table_name_posts, array(
            'post_status' => $post_status,
            
        ), array(
            'id' => $collection['orderNumber'],
        ));

        //Edito la tabla orders y le asigno la masterTrackingNumber
        $this->wpdb->update($this->table_name_ordersend, array(
            'masterTrackingNumber' => $masterTrackingNumber['masterTrackingNumber'],
            
        ), array(
            'orderNumber' => $collection['orderNumber'],
        ));


        //Mensaje de exito

        echo json_encode(
            array(
                "status" => "AUTHORIZED",
                'message' => 'Envio Generado y almacenado con exito'
            ), 
            true
        );
      
    

    }else{

        //Mensaje de error

        echo json_encode(
            array(
                "status" => "error",
                'message' => 'Error en la solictud de envío',
                'comments' =>  $comments['comments'],
            ), 
            true
        );


    }

        die();

    }
}   