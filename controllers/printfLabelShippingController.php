<?php

require_once PLUGIN_DIR_PATH . 'traits/configurationTrait.php';


class printfLabelShippingController{


    use configurationTrait;


    public function __construct(){


        global $wpdb;
        global $table_prefix;

        $this->wpdb = $wpdb;
        $this->table_prefix = $table_prefix;

        $this->table_name_responseshipping = $table_prefix . 'fedex_shipping_intra_mx_responseshipping';


    }

    public function index($orderId){


        $params  = configurationTrait::account();

        $labelType = $params['labelType'];

        $result = $this->wpdb->get_results("SELECT labelType, labelBase64IMG, labelBase64PDF, labelBase64ZPL, labelBase64EPL FROM $this->table_name_responseshipping WHERE orderNumber = $orderId", ARRAY_A);

        

        foreach ($result as $key => $value) {

            $labelBase64[] = array(

                'labelType' => $value['labelType'],
                'labelBase64IMG' => $value['labelBase64IMG'],
                'labelBase64PDF' => $value['labelBase64PDF'],
                'labelBase64ZPL' => $value['labelBase64ZPL'],
                'labelBase64EPL' => $value['labelBase64EPL'],

            );
            
        }



        foreach ($labelBase64 as $key => $value) {

            if($value['labelType'] == $labelType){

                $labelBase64BD[] = $value['labelBase64'.$labelType];

            }

        }



        // IMPRESION EN PDF
        if($labelType == 'PDF'){


            foreach ($labelBase64BD as $key => $value) {

                $labelBase64BD = $value;

                $label[] = array(
                    'status' => 'success',
                    'message' => 'Se ha generado el label correctamente',
                    'labelBase64' => $labelBase64BD,
                   );

            }

            echo json_encode($label, true);

        // IMPRESION EN IMAGEN
        }elseif($labelType == 'PNG'){


        // IMPRESION EN ZPL    
        }elseif($labelType == 'ZPL'){
            
            
            $content = array();
            

            foreach ($labelBase64BD as $key => $value) {

                $curl = curl_init();

                curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://api.labelary.com/v1/printers/8dpmm/labels/4x6/0/',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $value,
                CURLOPT_HTTPHEADER => array(
                    'Accept: application/pdf',
                    'Content-Type: application/x-www-form-urlencoded'
                ),
                ));
                
                
                $response = curl_exec($curl);

                $content = array_merge($content, array($response));


            }

            foreach ($content as $key => $value) {

               $label[] = array(
                'status' => 'success',
                'message' => 'Se ha generado el label correctamente',
                'labelBase64' => base64_encode($value),
               );

            curl_close($curl);

        }
            
        echo json_encode($label, true);

        //IMPRESION EN EPL
        }elseif($labelType == 'EPL'){

        }



        die();


    }




}