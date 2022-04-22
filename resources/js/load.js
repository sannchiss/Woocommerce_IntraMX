(function ($) {

  $(document).ready(function () {

    var table = $(".shippingList").DataTable({

      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
      },
      "order": [
        [0, "asc"]
      ],
      "columnDefs": [{
        "targets": [0],
        "orderable": false
      }],
      "lengthMenu": [
        [10, 25, 50, -1],
        [10, 25, 50, "Todos"],
      ],
      "pageLength": 10,


    /*   initComplete: function () {
        table.columns([1,2,7]).every( function () {
            var column = this;
            var select = $('<select><option value=""></option></select>')
                .appendTo( $(column.header()).empty() )
                .on( 'change', function () {
                    var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                    );
                    column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                } );

            column.data().unique().sort().each( function ( d, j ) {

              alert(d);
                select.append( '<option value="'+d+'">'+d+'</option>' )
            } );
        } );
    } */
      


    });



    $('#orderStatus').change(function() {
      // $(this).val() will work here
      alert($(this).val());

      $('.shippingList').DataTable().ajax.url(

        "admin-ajax.php?action=get_shipping_list&status="+$(this).val()
  
      ).load();


     /*  $.ajax({

        url: "admin-ajax.php?action=get_shipping_list&status="+$(this).val(),
        type: "GET",
        dataType: "json",
        success: function(data) {
          console.log(data);

          table.DataTable().ajax.reload();

        },
        error: function(error) {
          console.log(error);
        }


        
      }); */


  });





    



    $("a.toggle-vis").on("click", function (e) {
      e.preventDefault();

      // Get the column API object
      var column = table.column($(this).attr("data-column"));

      // Toggle the visibility
      column.visible(!column.visible());
    });

    // Load configuration
    $.ajax({
      async: false,
      url: "admin-ajax.php",
      type: "POST",
      data: {
        action: "load_configuration",
        nonce: " load_configuration",
      },
      success: function (response) {

        var parse = JSON.parse(response);

        console.log(parse);

        if (parse != null) {

          /**Input accountNumber */
          $("#accountNumber").val(parse["configuration"]["accountNumber"]);

          /***************************************************** */

          /**Input meterNumber */
          $("#meterNumber").val(parse["configuration"]["meterNumber"]);

          /***************************************************** */

          /** input wskeyUserCredential */
          $("#wskeyUserCredential").val(parse["configuration"]["wskeyUserCredential"]);

          /***************************************************** */

          /**input wskeyPasswordCredential */
          $("#wskeyPasswordCredential").val(parse["configuration"]["wskeyPasswordCredential"]);

          /***************************************************** */

          $("#serviceType").val(parse["configuration"]["serviceType"]);
          $("#packagingType").val(parse["configuration"]["packagingType"]);
          $("#paymentType").val(parse["configuration"]["paymentType"]);
          $("#labelType").val(parse["configuration"]["labelType"]);
          $("#measurementUnits").val(parse["configuration"]["measurementUnits"]);
          $("#environment").val(parse["configuration"]["environment"]);

          /**Input Data Origin */
          $("#personNameShipper").val(parse["shipper"]["personNameShipper"]);
          $("#phoneShipper").val(parse["shipper"]["phoneShipper"]);
          $("#companyNameShipper").val(parse["shipper"]["companyNameShipper"]);
          $("#emailShipper").val(parse["shipper"]["emailShipper"]);
          $("#vatNumberShipper").val(parse["shipper"]["vatNumberShipper"]);
          $("#cityShipper").val(parse["shipper"]["cityShipper"]);

          parse["shipper"]["stateOrProvinceCodeShipper"] == ""
            ? $("#stateOrProvinceCodeShipper").val("MX")
            : $("#stateOrProvinceCodeShipper").val(
              parse["shipper"]["stateOrProvinceCodeShipper"]
            );
          // $('#stateOrProvinceCodeShipper').val(parse['shipper']['stateOrProvinceCodeShipper);
          $("#postalCodeShipper").val(parse["shipper"]["postalCodeShipper"]);

          parse["shipper"]["countryCodeShipper"] == null ? $("#countryCodeShipper").val("MX") : $("#countryCodeShipper").val(parse["shipper"]["countryCodeShipper"]);


          //$('#countryCodeShipper').val(parse.countryCodeShipper);
          $("#addressLine1Shipper").val(parse["shipper"]["addressLine1Shipper"]);
          $("#addressLine2Shipper").val(parse["shipper"]["addressLine2Shipper"]);
          $("#taxIdShipper").val(parse["shipper"]["taxIdShipper"]);
          $("#ieShipper").val(parse["shipper"]["ieShipper"]);

        }
      },

      error: function (error) {
        console.log(error);
      },
    });

    //Envio de formulario de configuración datos cliente
    jQuery("#configuration").on("submit", function (e) {
      e.preventDefault();

      let inputs = $("#configuration").serializeArray();

      $.ajax({
        url: "admin-ajax.php", // Url to which the request is send
        type: "POST",
        data: {
          inputs: inputs,
          action: "save_configuration",
        },

        beforeSend: function(){

          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          })
          
          Toast.fire({
            icon: 'info',
            title: 'Enviando solicitud',
            text: 'Espere un momento...',
          })

        },
        success: function (data) {
          let timerInterval;
          Swal.fire({
            title: "Autorizado",
            icon: "success",
            html: data,
            timer: 1000,
            timerProgressBar: true,
            didOpen: () => {
              Swal.showLoading();
              const b = Swal.getHtmlContainer().querySelector("b");
              timerInterval = setInterval(() => {
                b.textContent = Swal.getTimerLeft();
              }, 100);
            },
            willClose: () => {
              clearInterval(timerInterval);
            },
          }).then((result) => {
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {
              location.reload();
            }
          });


        },
        error: function (data) {
          console.log(data);
        },
      });
    });

    /**Envio de Formulario OriginShipper */
    jQuery("#originShipper").on("submit", function (e) {
      e.preventDefault();

      let inputs = $("#originShipper").serializeArray();

      $.ajax({
        url: "admin-ajax.php", // Url to which the request is send
        type: "POST",
        data: {
          inputs: inputs,
          action: "save_originShipper",
        },

        beforeSend: function(){

          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          })
          
          Toast.fire({
            icon: 'info',
            title: 'Enviando solicitud',
            text: 'Espere un momento...',
          })

        },
        success: function (data) {
          console.log(data);

          let timerInterval;
          Swal.fire({
            title: "Autorizado",
            icon: "success",
            html: data,
            timer: 1000,
            timerProgressBar: true,
            didOpen: () => {
              Swal.showLoading();
              const b = Swal.getHtmlContainer().querySelector("b");
              timerInterval = setInterval(() => {
                b.textContent = Swal.getTimerLeft();
              }, 100);
            },
            willClose: () => {
              clearInterval(timerInterval);
            },
          }).then((result) => {
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {
              location.reload();
            }
          });
        },
        completed: function () { },
        error: function (data) {
          console.log(data);
          Swal.fire({
            title: "Error",
            text: "Error al guardar los datos de origen",
            icon: "error",
            confirmButtonText: "Cerrar",
          });
        },
      });
    });

    /**Modal Orden Items */

    $(".itemsOrder").on("click", function (e) {
      e.preventDefault();

      // $(".modal-body").empty();

      $("#exampleModal").modal("show");

      $("modal-title").text("Items");

      let id = $(this).attr("data-id");
      $.ajax({
        url: "admin-ajax.php", // Url to which the request is send
        type: "POST",
        data: {
          orderId: $(this).data("order"),
          action: "get_itemsOrder",
        },
        success: function (data) {
          let parse = JSON.parse(data);

          console.log(parse);

          let html = "";

          let i = 1;
          $.each(parse, function (index, value) {
            html += `
            <tr>
            <td>${i}</td>
            <td>${value.name}</td>
            <td>${value.quantity}</td>
            <td>${value.total}</td>
            </tr>
            `;

            i++;
          });

          $("#itemsOrder").html(html); //Agrega el html al modal

          $("#itemsOrder").html(parse["itemsOrder"]);
          //  $("#modalItemsOrder").modal("show");
        },
        error: function (data) {
          console.log(data);
        },
      });
    });

    //Apertura de formulario de envio con datos cliente
    $(".order").click(function () {

      $.ajax({
        url: "admin-ajax.php", // Url to which the request is send
        type: "POST",
        data: {
          orderId: $(this).data("order"),
          action: "get_order",
        },
        success: function (data) {
          let parse = JSON.parse(data);

          console.log(parse);

          var today = new Date();
          var dd = String(today.getDate()).padStart(2, "0");
          var mm = String(today.getMonth() + 1).padStart(2, "0"); //January is 0!
          var yyyy = today.getFullYear();

          //var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();

          today = dd + "-" + mm + "-" + yyyy;

          $("#orderNumber").val(parse.id);
          $("#orderNumber").attr("readonly", true);
          $("#orderDate").val(today);
          $("#personNameRecipient").val(
            parse["billing"]["first_name"] + " " + parse["billing"]["last_name"]
          );
          $("#phoneNumberRecipient").val(parse["billing"]["phone"]);
          $("#companyNameRecipient").val(parse["billing"]["company"]);
          $("#emailRecipient").val(parse["billing"]["email"]);

          if (parse["customer_note"] != "") {
            $("#notesRecipient").val(parse["customer_note"]);
          } else {
            $("#notesRecipient").val("Ver nota fiscal");
          }

          $("#vatNumberRecipient").val(parse["billing"]["vat_number"]);
          $("#cityRecipient").val(parse["billing"]["city"]);
          $("#stateOrProvinceCodeRecipient").val(parse["billing"]["state"]);
          $("#postalCodeRecipient").val(parse["billing"]["postcode"]);
          $("#countryCodeRecipient").val(parse["billing"]["country"]);
          $("#streetLine1Recipient").val(parse["billing"]["address_1"]);
          $("#streetLine2Recipient").val(parse["billing"]["address_2"]);

          if (parse["orderDetails"] != null) {

            $("#numberOfPieces").val(parse["orderDetails"]["quantity"]);
            $("#weight").val(parse["orderDetails"]["weight"]);
            $("#weightUnits").val(parse["orderDetails"]["weightUnits"]);
            $("#length").val(parse["orderDetails"]["length"]);
            $("#width").val(parse["orderDetails"]["width"]);
            $("#height").val(parse["orderDetails"]["height"]);

          }

          console.log(parse);

          $("#orders").html(data);
        },
        error: function (data) {
          console.log(data);
        },
      });
    });


    /******************************************************* */


    // Crear envío definitivo hacia FedEx
    $(document).on("submit", "#orderSend", function (e) {

      e.preventDefault();

      let inputs = $("#orderSend").serializeArray();


      Swal.fire({
        title: "¿Deseas crear el envío definitivo?",
        text: "",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, crear",
        cancelButtonText: "Cancelar",
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: "admin-ajax.php", // Url to which the request is send
            type: "POST",
            data: {
              inputs: inputs,
              action: "create_OrderShipper",
            },
            beforeSend: function () {
              

              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
              })
              
              Toast.fire({
                icon: 'info',
                title: 'Solicitando el servicio',
                text: 'Espere un momento...',
              })



            },

            success: function (data) {

              var parseData = JSON.parse(data);
              
              console.log(parseData.message);

              if (parseData.status == "AUTHORIZED") {

                let timerInterval;
                Swal.fire({
                  title: "Autorizado",
                  icon: "success",
                  html: parseData.message,
                  timer: 1800,
                  timerProgressBar: true,
                  didOpen: () => {
                    Swal.showLoading();
                    const b = Swal.getHtmlContainer().querySelector("b");
                    timerInterval = setInterval(() => {
                      b.textContent = Swal.getTimerLeft();
                    }, 100);
                  },
                  willClose: () => {
                    clearInterval(timerInterval);
                  },
                }).then((result) => {
                  // Read more about handling dismissals below 
                  if (result.dismiss === Swal.DismissReason.timer) {
                    location.reload();
                  }
                });

              } else {
                Swal.fire({
                  title: "Error",
                  icon: "error",
                  html: parseData.message+': '+parseData.comments,
                });
              }

            },
            completed: function () { },
            
            error: function (data) {
              console.log(data);
              Swal.fire({
                title: "Error",
                text: "Error al guardar los datos de origen",
                icon: "error",
                confirmButtonText: "Cerrar",
              });
            },
          });
        }
      });


      
    });

    /******************************************************* */

    //cancelar envio Fedex
    $(".cancelOrder").click(function () {

      let orderId = $(this).data('order');

      Swal.fire({
        title: "¿Estas seguro de cancelar envío orden #" + orderId + "?",
        text: "No podras revertir esta acción",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, cancelar",
        cancelButtonText: "Cancelar",
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: "admin-ajax.php", // Url to which the request is send
            type: "POST",
            data: {
              orderId: $(this).data('order'),
              action: "cancel_orderShipper",
            },
            beforeSend: function () {
              

              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
              })
              
              Toast.fire({
                icon: 'info',
                title: 'Solicitando anulación',
                text: 'Espere un momento...',
              })



            },
              success: function (data) {
              var parseData = JSON.parse(data);
              console.log(data);

              if(parseData.status == "AUTHORIZED"){

              let timerInterval;
              Swal.fire({
                title: "Envío eliminado!",
                icon: "error",
                html: parseData.message,
                timer: 1200,
                timerProgressBar: true,
                didOpen: () => {
                  Swal.showLoading();
                  const b = Swal.getHtmlContainer().querySelector("b");
                  timerInterval = setInterval(() => {
                    b.textContent = Swal.getTimerLeft();
                  }, 100);
                },
                willClose: () => {
                  clearInterval(timerInterval);
                },
              }).then((result) => {

                if (result.dismiss === Swal.DismissReason.timer) {
                  location.reload();
                }
              }); 


               }else{

                Swal.fire({
                  title: "Error",
                  icon: "error",
                  html: parseData.message+': '+ parseData.status_message,
                });

                }

            },
            completed: function () { },
            error: function (data) {
              console.log(data);
              Swal.fire({
                title: "Error",
                text: "Error al guardar los datos de origen",
                icon: "error",
                confirmButtonText: "Cerrar",
              });
            },
          });
        }
      });
    });


    //Impresion de etiqueta Fedex
    $(".printLabel").click(function () {

      let orderId = $(this).data('order');

      $.ajax({
        url: "admin-ajax.php", // Url to which the request is send
        type: "POST",
        data: {
          orderId: $(this).data('order'),
          action: "print_labelShipper",
        },
        beforeSend: function () {


          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          })
          
          Toast.fire({
            icon: 'info',
            title: 'Imprimiendo etiqueta',
            text: 'Espere un momento...',
          })


        },
        success: function (data) {

        var parseData = JSON.parse(data)

        var pdfWindow = window.open("");
        pdfWindow.document.write('<title>FedEx Shipping Label</title>');

        parseData.forEach(element => {

          console.log(element.labelBase64);
      

          pdfWindow.document.write("<embed width='100%' height='100%' src='data:application/pdf;base64, " + encodeURI(element.labelBase64) + "#toolbar=1&navpanes=0&scrollbar=0'>");
            
          });

         

          

         // var parseData = JSON.parse(data);

         // console.log(parseData);

         var contenedorImg = document.getElementById('contenedorImg');

        /*   parseData.forEach(element => {

          //console.log(element.labelBase64IMG);
         // document.getElementsByName("img").src = "data:image/png;base64," + element.labelBase64IMG;
         // contentImg.src = "data:image/png;base64," + element.labelBase64IMG;

         contenedorImg.innerHTML = contenedorImg.innerHTML + '<img src="data:image/png;base64,' + element.labelBase64IMG + '" width="1000" height="1000" />';



            
          }); */

       

        },
        completed: function () { },
        error: function (data) {
          console.log(data);
        },
      });

    });

 

    // importar archivo csv
    jQuery("#uploadMasiveShipper").on("submit", function (e) {
      e.preventDefault();



      $('#file').parse({
        config: {
          
          quotes: false, //or array of booleans
          quoteChar: '"',
          escapeChar: '"',
          delimiter: ";",
          header: true,
          newline: "\r\n",
          skipEmptyLines: true, //other option is 'greedy', meaning skip delimiters, quotes, and whitespace.
          columns: null, //or array of strings
          complete: displayHTMLTable,
        },
        before: function(file, inputElem)
        {
          console.log("Parsing file...", file);
        },
        error: function(err, file)
        {
          console.log("ERROR:", err, file);
        },
        complete: function()
        {
          console.log("Done with all files");
        }
      });


      function displayHTMLTable(results) {


        if(results.data.length > 0){

          $.ajax({
            url: "admin-ajax.php", // Url to which the request is send
            type: "POST",
            data: {
              data: results.data,
              action: "upload_csvShipper",
            },
            beforeSend: function () {

              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
              })
              
              Toast.fire({
                icon: 'info',
                title: 'Importando listado',
                text: 'Espere un momento...',
              })


            },
            success: function (data) {
                
                var parseData = JSON.parse(data)
  
                console.log(parseData);
  
                if(parseData.status == "success"){
  
                let timerInterval;
                Swal.fire({
                  title: "Listado importado!",
                  icon: "success",
                  html: parseData.message,
                  timer: 1200,
                  timerProgressBar: true,
                  didOpen: () => {
                  },
                  willClose: () => {
                  }
                }).then((result) => {

                  if (result.dismiss === Swal.DismissReason.timer) {
                    location.reload();
                  }
                }
                );



                  }else{

                  Swal.fire({
                    title: "Error",
                    icon: "error",
                    html: parseData.message+': '+ parseData.status_message,
                  });

                  }

              },
              completed: function () { },
              error: function (data) {
                console.log(data);
                Swal.fire({
                  title: "Error",
                  text: "Error al guardar los datos de origen",
                  icon: "error",
                  confirmButtonText: "Cerrar",
                });
              }






          
        });

      }
      else {

        Swal.fire({
          title: "Error",
          icon: "error",
          html: "No se encontraron registros en el archivo",
        });

      }



       
    }



    });



// Localizador de datos Shipper Origin
let url = 'admin-ajax.php';
$('input.typeaheadShipperOrigin').typeahead({
    items: 80, //Cantidad de elementos mostrados en lista
    minChars: 0,
    source: function(query, process) {
        $.get(
          url,
          data = {
            action: 'searchShipperOrigin',
            query: query
          },
          function(data) {
            objects = [];
            labelpersonShippingOrigin = {};
            //Cliclo para llenar el autocomplete
            $.each(data, function(i, item) {
                console.log(item)
                
                var personNameShipper = item.personNameShipper;

                labelpersonShippingOrigin[personNameShipper] = item;
                objects.push(personNameShipper);
            });
            process(objects);
        }, 'json')
    },
    updater: function(personNameShipper) {

        var item = labelpersonShippingOrigin[personNameShipper];
        var input_label = personNameShipper;

        $('#phoneShipper').val(item.phoneShipper);
        $('#companyNameShipper').val(item.companyNameShipper);
        $('#emailShipper').val(item.emailShipper);
        $('#vatNumberShipper').val(item.vatNumberShipper);
        $('#cityShipper').val(item.cityShipper);
        $('#stateOrProvinceCodeShipper').val(item.stateOrProvinceCodeShipper);
        $('#postalCodeShipper').val(item.postalCodeShipper);
        $('#countryCodeShipper').val(item.countryCodeShipper);
        $('#addressLine1Shipper').val(item.addressLine1Shipper);
        $('#addressLine2Shipper').val(item.addressLine2Shipper);
        $('#taxIdShipper').val(item.taxIdShipper);
        $('#ieShipper').val(item.ieShipper);


        return input_label;
    }
});




  });
})(jQuery);
