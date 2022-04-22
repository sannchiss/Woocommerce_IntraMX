<?php if (current_user_can('manage_options')) : #Condicional Alternativa 

?>

<div class="accordion" id="accordionExample">
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button collapsed bg-primary bg-gradient py-3" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                aria-controls="collapseOne">

                <div class="bg-primary bg-gradient text-wrap text-white" style="width: 20rem;">
                    <i class="fas fa-tasks"></i> <span>Configuración de Cuenta </span>
                </div>

            </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
            data-bs-parent="#accordionExample">

            <div class="accordion-body">

                <div class="container">

                    <form id="configuration">

                        <div class="row">

                            <div class="col-md-12">

                                <div class="shadow p-3 mb-5 bg-white rounded">

                                    <div class="container-fluid" style="z-index:1">

                                        <div class="panel-heading">

                                            <h3 class="panel-title mb-3">Credenciales</h3>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-5">

                                                <div class="form-floating mb-3">
                                                    <input type="password" class="form-control" placeholder=""
                                                        id="accountNumber" name="accountNumber" minlength="9"
                                                        maxlength="30" value="" required>
                                                    <label for="accountNumber">Account Number</label>
                                                </div>

                                            </div>

                                        </div>

                                        <!--Meter Number--->

                                        <div class="row">

                                            <div class="col-md-5">

                                                <div class="form-floating mb-3">
                                                    <input type="password" class="form-control" placeholder=""
                                                        id="meterNumber" name="meterNumber" minlength="9" maxlength="30"
                                                        required>
                                                    <label for="meterNumber">Meter Number</label>
                                                </div>


                                            </div>

                                        </div>

                                        <!--wskey User Credential--->
                                        <div class="row">

                                            <div class="col-md-5">

                                                <div class="form-floating mb-3">
                                                    <input type="password" class="form-control" placeholder=""
                                                        id="wskeyUserCredential" name="wskeyUserCredential"
                                                        minlength="9" maxlength="50" required>
                                                    <label for="wskeyUserCredential">Wskey User Credential</label>
                                                </div>


                                            </div>

                                        </div>

                                        <!--wspassword User Credential--->
                                        <div class="row">

                                            <div class="col-md-5">

                                                <div class="form-floating mb-3">
                                                    <input type="password" class="form-control"
                                                        id="wskeyPasswordCredential" name="wskeyPasswordCredential"
                                                        minlength="9" maxlength="50" required>
                                                    <label for="wskeyPasswordCredential">Wspassword User
                                                        Credential</label>
                                                </div>

                                                <div id="html_bl"></div>

                                            </div>

                                        </div>

                                        <hr>

                                        <!--service Type--->
                                        <div class="row">

                                            <div class="panel-heading">

                                                <h3 class="panel-title mb-3">Servicios/Tipos de emblaje/Tipo
                                                    pagador/Impresión/Unidad de
                                                    medida</h3>

                                            </div>

                                            <div class="col-md-3">

                                                <div class="form-floating mb-3">
                                                    <select class="form-select" id="serviceType" name="serviceType"
                                                        required aria-label="Floating label select example">
                                                        <option selected disabled value="">Search...</option>
                                                        <option value="ECONOMY">ECONOMY</option>
                                                        <option value="STANDARD_OVERNIGHT" selected>STANDARD_OVERNIGHT
                                                        </option>
                                                        <option value="PRIORITY_OVERNIGHT">PRIORITY_OVERNIGHT</option>
                                                        <option value="FIRST_OVERNIGHT">FIRST_OVERNIGHT</option>
                                                        <option value="FREIGHT_1D">FREIGHT_1D</option>
                                                        <option value="FREIGHT_2D">FREIGHT_2D</option>

                                                    </select>
                                                    <label for="serviceType">Service Type</label>
                                                </div>
                                            </div>

                                            <!--Packaging Type--->
                                            <div class="col-md-3">

                                                <div class="form-floating mb-3">
                                                    <select class="form-select" id="packagingType" name="packagingType"
                                                        required aria-label="Floating label select example">
                                                        <option selected disabled value="">Search...</option>
                                                        <option value="YOUR_PACKAGING" selected>YOUR_PACKAGING</option>
                                                        <option value="FEDEX_ENVELOPE">FEDEX_ENVELOPE</option>
                                                        <option value="FEDEX_PAK">FEDEX_PAK</option>
                                                        <option value="FEDEX_BOX">FEDEX_BOX</option>
                                                        <option value="FEDEX_TUBE">FEDEX_TUBE</option>
                                                        <option value="FEDEX_BOX_10">FEDEX_BOX_10</option>
                                                        <option value="FEDEX_BOX_25">FEDEX_BOX_25</option>
                                                    </select>
                                                    <label for="packagingType">Packaging Type</label>
                                                </div>
                                            </div>

                                        </div>

                                        <!--label Type--->
                                        <div class="row">

                                            <div class="col-md-2">

                                                <div class="form-floating mb-3">
                                                    <select class="form-select" id="paymentType" name="paymentType"
                                                        required aria-label="Floating label select example">
                                                        <option selected disabled value="">Search...</option>
                                                        <option value="SENDER" selected>SENDER</option>
                                                        <option value="RECIPIENT">RECIPIENT</option>
                                                        <option value="THIRD_PARTY">THIRD_PARTY</option>
                                                    </select>
                                                    <label for="paymentType">Payment Type</label>
                                                </div>
                                            </div>

                                            <div class="col-md-2">

                                                <div class="form-floating mb-3">
                                                    <select class="form-select" id="labelType" name="labelType" required
                                                        aria-label="Floating label select example">
                                                        <option selected disabled value="">Search...</option>
                                                        <option value="PDF" selected>PDF</option>
                                                        <option value="PNG" selected>PNG</option>
                                                        <option value="ZPL">ZPL</option>
                                                    </select>
                                                    <label for="labelType">label Type</label>
                                                </div>
                                            </div>

                                            <div class="col-md-2">

                                                <div class="form-floating mb-3">
                                                    <select class="form-select" id="measurementUnits"
                                                        name="measurementUnits" required
                                                        aria-label="Floating label select example">
                                                        <option selected disabled value="">Search...</option>
                                                        <option value="KG/CM" selected>KG/CM</option>
                                                        <option value="LBS/IN">LBS/IN</option>
                                                    </select>
                                                    <label for="measurementUnits">Measurement Units</label>
                                                </div>

                                            </div>



                                        </div>

                                        <hr>
                                        <!--Environment--->
                                        <div class="row">

                                            <div class="panel-heading">

                                                <h3 class="panel-title mb-3">Ambiente</h3>

                                            </div>

                                            <div class="col-md-2">

                                                <div class="form-floating mb-3">
                                                    <select class="form-select" id="environment" name="environment"
                                                        required aria-label="Floating label select example">
                                                        <option selected disabled value="">Search...</option>
                                                        <option value="QA" selected>QA</option>
                                                        <option value="PRODUCTION">PRODUCTION</option>
                                                    </select>
                                                    <label for="environment">Environment</label>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <hr>


                                    <div class="footer">

                                        <div class="container">

                                            <div class="row">

                                                <div class="col-md-12">

                                                    <div class="footer">
                                                        <button type="submit"
                                                            class="send_config btn btn-primary">Guardar</button>
                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>


                    </form>

                </div>



            </div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">

            <button class="accordion-button collapsed bg-primary bg-gradient py-3" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true"
                aria-controls="collapseTwo">

                <div class="bg-primary bg-gradient text-wrap text-white" style="width: 12rem;">
                    <i class="fas fa-tasks"></i> <span>Datos de Origen </span>
                </div>

            </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
            data-bs-parent="#accordionExample">
            <div class="accordion-body">


                <div class="container-fluid">


                    <div class="row">

                        <div class="col-md-12">

                            <div class="shadow p-3 mb-5 bg-white rounded">


                                <div class="card-body">

                                    <form id="originShipper">


                                        <div class="row">

                                            <div class="col-md-6">

                                                <div class="form-floating mb-3">
                                                    <input type="text" class="typeaheadShipperOrigin form-control" id="personNameShipper"
                                                        name="personNameShipper"
                                                        aria-label="Floating label example input">
                                                    <label for="personNameShipper">Person Name </label>
                                                </div>


                                            </div>

                                            <div class="col-md-4">

                                                <div class="form-floating mb-3">
                                                    <input type="tel" class="form-control" id="phoneShipper"
                                                        name="phoneShipper" aria-label="Floating label example input">
                                                    <label for="phoneShipper">Phone </label>
                                                </div>


                                            </div>


                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">

                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="companyNameShipper"
                                                        name="companyNameShipper"
                                                        aria-label="Floating label example input">
                                                    <label for="companyNameShipper">Company Name</label>
                                                </div>

                                            </div>

                                            <div class="col-md-4">

                                                <div class="form-floating mb-3">
                                                    <input type="email" class="form-control" id="emailShipper"
                                                        name="emailShipper" aria-label="Floating label example input">
                                                    <label for="emailShipper">Email</label>
                                                </div>
                                            </div>


                                        </div>

                                        <div class="row">

                                            <div class="col-md-2">

                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="vatNumberShipper"
                                                        name="vatNumberShipper"
                                                        aria-label="Floating label example input">
                                                    <label for="vatNumberShipper">Nif</label>
                                                </div>

                                            </div>

                                            <div class="col-md-3">

                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="cityShipper"
                                                        name="cityShipper" aria-label="Floating label example input">
                                                    <label for="cityShipper">City</label>
                                                </div>

                                            </div>

                                            <div class="col-md-2">

                                                <div class="form-floating mb-3">

                                                    <select class="form-control" id="stateOrProvinceCodeShipper"
                                                        name="stateOrProvinceCodeShipper"
                                                        aria-label="Floating label example input">
                                                        <option selected disabled value="">Search...</option>
                                                        <option value="DF">Distrito Federal</option>
                                                        <option value="AG">Aguascalientes</option>
                                                        <option value="BC">Baja California</option>
                                                        <option value="BS">Baja California Sur</option>
                                                        <option value="CM">Campeche</option>
                                                        <option value="CH">Chihuahua</option>
                                                        <option value="CS">Chiapas</option>
                                                        <option value="CO">Coahuila</option>
                                                        <option value="CL">Colima</option>
                                                        <option value="DG">Durango</option>
                                                        <option value="GR">Guerrero</option>
                                                        <option value="GT">Guanajuato</option>
                                                        <option value="HG">Hidalgo</option>
                                                        <option value="JA">Jalisco</option>
                                                        <option value="MX">Mexico</option>
                                                        <option value="MI">Michoacán</option>
                                                        <option value="MO">Morelos</option>
                                                        <option value="NA">Nayarit</option>
                                                        <option value="NL">Nuevo Leon</option>
                                                        <option value="OA">Oaxaca</option>
                                                        <option value="PU">Puebla</option>
                                                        <option value="QT">Querétaro</option>
                                                        <option value="QR">Quintana Roo</option>
                                                        <option value="SI">Sinaloa</option>
                                                        <option value="SL">San Luis Potosí</option>
                                                        <option value="SO">Sonora</option>
                                                        <option value="TB">Tabasco</option>
                                                        <option value="TM">Tamaulipas</option>
                                                        <option value="TL">Tlaxcala</option>
                                                        <option value="VE">Veracruz</option>
                                                        <option value="YU">Yucatan</option>
                                                        <option value="ZA">Zacatecas</option>
                                                    </select>
                                                    <label for="stateOrProvinceCodeShipper">State</label>
                                                </div>

                                            </div>


                                            <div class="col-md-2">

                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="postalCodeShipper"
                                                        name="postalCodeShipper"
                                                        aria-label="Floating label example input">
                                                    <label for="postalCodeShipper">Postal Code</label>
                                                </div>

                                            </div>

                                            <div class="col-md-1">

                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="countryCodeShipper"
                                                        name="countryCodeShipper" value="MX"
                                                        aria-label="Floating label example input" readonly>
                                                    <label for="countryCodeShipper">Country</label>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">

                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="addressLine1Shipper"
                                                        name="addressLine1Shipper"
                                                        aria-label="Floating label example input">
                                                    <label for="addressLine1Shipper">Address Line 1</label>
                                                </div>

                                            </div>

                                            <div class="col-md-6">

                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="addressLine2Shipper"
                                                        name="addressLine2Shipper"
                                                        aria-label="Floating label example input">
                                                    <label for="addressLine2Shipper">Address Line 2</label>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="row">


                                            <div class="col-md-3">

                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="taxIdShipper"
                                                        name="taxIdShipper" aria-label="Floating label example input">
                                                    <label for="taxIdShipper">Tax</label>
                                                </div>

                                            </div>

                                            <div class="col-md-3">

                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="ieShipper"
                                                        name="ieShipper" aria-label="Floating label example input">
                                                    <label for="ieShipper">Ie</label>
                                                </div>

                                            </div>


                                        </div>
                                        <hr>

                                        <div class="row">

                                            <div class="col-md-12">

                                                <div class="footer">
                                                    <button type="submit"
                                                        class="send_config btn btn-primary">Guardar</button>
                                                </div>

                                            </div>


                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>



                <div class="container-fluid">


                    <!- CARGA MASIVA DE SHIPPER ORIGEN -->
                        <div class="row">





                            <div class="col-md-12">

                                <div class="shadow p-3 mb-5 bg-white rounded">


                                    <div class="card-body">

                                        <div class="row">


                                            <div class="container">
                                                <div class="row align-items-start">
                                                    <div class="col">


                                                        <form id="uploadMasiveShipper" method="post"
                                                            enctype="multipart/form-data">

                                                            <!--form upload file-->
                                                            <div class="mb-3">
                                                                <label for="archivo">Selecciona un archivo
                                                                    <code>.csv</code></label>
                                                                <input type="file" class="form-control" name="file"
                                                                    id="file" accept=".csv">
                                                            </div>
                                                            <button class="btn btn-success"
                                                                type="submit">Importar</button>

                                                        </form>




                                                    </div>
                                                    <div class="col">

                                                        <!--Download file-->
                                                        <a href="https://drive.google.com/file/d/1CapWK66ILXcUiRMoY_xmN5zrtUQezZs7/view?usp=sharing"
                                                        target="_blank" class="btn btn-primary" Download>Descargar
                                                            <code>.csv</code></a>


                                                    </div>
                                                    <div class="col">





                                                    </div>
                                                </div>




                                            </div>







                                        </div>











                                    </div>
                                </div>


                            </div>


                            <div id="parsed_csv_list"></div>


                            <?php else : ?>
                            <p>
                                No tienes acceso a esta sección
                            </p>
                            <?php endif; ?>