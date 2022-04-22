<?php


trait configurationTrait {
    
    
    public function account() {

        global $wpdb;
        global $table_prefix;

       
        $sql = "SELECT * FROM " . $table_prefix . "fedex_shipping_intra_MX_configuration";
        $result = $wpdb->get_results($sql);

        foreach ($result as $key => $value) {
            $params['id'] = $value->id;
            $params['accountNumber'] = $value->accountNumber;
            $params['meterNumber'] = $value->meterNumber;
            $params['wskeyUserCredential'] = $value->wskeyUserCredential;
            $params['wskeyPasswordCredential'] = $value->wskeyPasswordCredential;
            $params['serviceType'] = $value->serviceType;
            $params['packagingType'] = $value->packagingType;
            $params['paymentType'] = $value->paymentType;
            $params['labelType'] = $value->labelType;
            $params['measurementUnits'] = $value->measurementUnits;
            $params['environment'] = $value->environment;
        }

        return $params;

    
    }

}