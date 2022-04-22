<?php


class createTables{


    public function __construct(){

        global $wpdb;
        global $table_prefix;
        global $confCharset;

        $this->wpdb = $wpdb;
        $this->table_prefix = $table_prefix;
        $this->confCharset = $confCharset = $this->wpdb->get_charset_collate();

    }

    public function configuration(){
       
        $tabla = $this->table_prefix . 'fedex_shipping_intra_MX_configuration';

        $sql = "CREATE TABLE IF NOT EXISTS $tabla (
            id INT(11) NOT NULL AUTO_INCREMENT,
            accountNumber VARCHAR(150),
            meterNumber VARCHAR(150),
            wskeyUserCredential VARCHAR(150),
            wskeyPasswordCredential VARCHAR(150),
            serviceType VARCHAR(100),
            packagingType VARCHAR(100),
            paymentType VARCHAR(50),
            labelType VARCHAR(50),
            measurementUnits VARCHAR(100),
            environment VARCHAR(50),

            PRIMARY KEY (id)
        ) $this->confCharset;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );

        //VACIAR LA TABLA SI CONTIENEN DATOS
        $sql = "TRUNCATE " . $tabla;
        $this->wpdb->query($this->wpdb->prepare($sql));
        /******************************************* */

    }

    public function originShipper(){

        $tabla = $this->table_prefix . 'fedex_shipping_intra_MX_originShipper';


        $sql = "CREATE TABLE IF NOT EXISTS $tabla (
            id INT(11) NOT NULL AUTO_INCREMENT,
            personNameShipper VARCHAR(150),
            phoneShipper VARCHAR(150),
            companyNameShipper VARCHAR(100),
            emailShipper VARCHAR(60),
            vatNumberShipper VARCHAR(50),
            cityShipper VARCHAR(50),
            stateOrProvinceCodeShipper VARCHAR(20),
            postalCodeShipper VARCHAR(20),
            countryCodeShipper VARCHAR(150),
            addressLine1Shipper VARCHAR(150),
            addressLine2Shipper VARCHAR(150),
            taxIdShipper VARCHAR(150),
            ieShipper VARCHAR(150),
           

            PRIMARY KEY (id)
        ) $this->confCharset;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );

        //VACIAR LA TABLA SI CONTIENEN DATOS
        $sql = "TRUNCATE " . $tabla;
        $this->wpdb->query($this->wpdb->prepare($sql));
        /******************************************* */

    }


    public function orderSend(){
            
            $tabla = $this->table_prefix . 'fedex_shipping_intra_MX_orderSend';

            $sql = "CREATE TABLE IF NOT EXISTS $tabla (
                id INT(11) NOT NULL AUTO_INCREMENT,
                orderNumber INT(11),
                masterTrackingNumber VARCHAR(150),
                orderDate DATETIME,
                totalOrderAmount DECIMAL(10,2),
                personNameRecipient VARCHAR(150),
                phoneNumberRecipient VARCHAR(150),
                companyNameRecipient VARCHAR(100),
                vatNumberRecipient VARCHAR(50),
                emailRecipient VARCHAR(60),
                notesRecipient VARCHAR(150),
                cityRecipient VARCHAR(50),
                stateOrProvinceCodeRecipient VARCHAR(20),
                postalCodeRecipient VARCHAR(20),
                countryCodeRecipient VARCHAR(150),
                streetLine1Recipient VARCHAR(150),
                streetLine2Recipient VARCHAR(150),
                serviceType VARCHAR(100),
                packagingType VARCHAR(100),
                paymentType VARCHAR(50),
                measurementUnits VARCHAR(100),
                numberOfPieces INT(11),
                weight VARCHAR(50),
                weightUnits VARCHAR(50),
                length VARCHAR(50),
                width VARCHAR(50),
                height VARCHAR(50),
                dimensionUnits VARCHAR(50),
                labelType VARCHAR(50),
                personNameShipper VARCHAR(150),
                phoneShipper VARCHAR(150),
                companyNameShipper VARCHAR(100),
                emailShipper VARCHAR(60),
                vatNumberShipper VARCHAR(50),
                cityShipper VARCHAR(50),
                stateOrProvinceCodeShipper VARCHAR(20),
                postalCodeShipper VARCHAR(20),
                countryCodeShipper VARCHAR(150),
                addressLine1Shipper VARCHAR(150),
                addressLine2Shipper VARCHAR(150),
                taxIdShipper VARCHAR(150),
                ieShipper VARCHAR(150),
                status VARCHAR(50),
                error VARCHAR(150),

                PRIMARY KEY (id)
            ) $this->confCharset;";

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta( $sql );

            //VACIAR LA TABLA SI CONTIENEN DATOS
            $sql = "TRUNCATE " . $tabla;
            $this->wpdb->query($this->wpdb->prepare($sql));
            /******************************************* */
                

    }

    public function responseShipping(){
            
            $tabla = $this->table_prefix . 'fedex_shipping_intra_MX_responseShipping';
    
            $sql = "CREATE TABLE IF NOT EXISTS $tabla (
                id INT(11) NOT NULL AUTO_INCREMENT,
                orderNumber INT(11),
                orderDate DATETIME,
                masterTrackingNumber VARCHAR(150),
                status VARCHAR(150),
                labelType VARCHAR(50),
                labelBase64IMG longtext,
                labelBase64PDF longtext,
                labelBase64ZPL longtext,
                labelBase64EPL longtext,

                PRIMARY KEY (id)
            ) $this->confCharset;";

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta( $sql );
            
            //VACIAR LA TABLA SI CONTIENEN DATOS
            $sql = "TRUNCATE " . $tabla;
            $this->wpdb->query($this->wpdb->prepare($sql));
            /******************************************* */

    }

    public function orderDetail(){

        $tabla = $this->table_prefix . 'fedex_shipping_intra_MX_orderDetail';

        $sql = "CREATE TABLE IF NOT EXISTS $tabla (

            id INT(11) NOT NULL AUTO_INCREMENT,
            orderNumber INT(11),
            weight VARCHAR(50),
            weightUnits VARCHAR(50),
            length VARCHAR(50),
            width VARCHAR(50),
            height VARCHAR(50),
            dimensionUnits VARCHAR(50),
            productDescription VARCHAR(150),
            quantity VARCHAR(50),
            totalPrice VARCHAR(50),
            created_at DATETIME,

            PRIMARY KEY (id)
        ) $this->confCharset;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );

        //VACIAR LA TABLA SI CONTIENEN DATOS
        $sql = "TRUNCATE " . $tabla;
        $this->wpdb->query($this->wpdb->prepare($sql));
        /******************************************* */



    }



}