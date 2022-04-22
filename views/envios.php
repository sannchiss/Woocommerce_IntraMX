<?php

if (!defined('ABSPATH')) {
    die();
}


$args = array(
    'status' => array('wc-processing', 'wc-on-hold', 'wc-completed', 'wc-fedex'),
);
$orders = wc_get_orders( $args );



include PLUGIN_DIR_PATH . 'views/modal/content/envios.php';
include PLUGIN_DIR_PATH . 'views/modal/content/itemsOrder.php';

?>


<div class="container">



    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading mb-3">
                    <h3 class="panel-title">Ordenes de compra</h3>



                </div>
               
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover shippingList">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Fecha</th>
                                            <th>Cliente</th>
                                            <th>Ciudad</th>
                                            <th>Cod.Estado</th>
                                            <th>Orden</th>
                                            <th>Items</th>
                                            <th>Estatus</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($orders as $order) {
                                            ?>
                                        <tr>
                                            <td><?php echo '<span class="badge bg-light text-dark">'. $i .'</span>' ?></td>
                                            <td><?php echo '<span class="badge bg-light text-dark">'. $order->date_created .'</span>' ?></td>
                                            <td><?php echo '<span class="badge bg-light text-dark">'. $order->get_billing_first_name(). " " .$order->get_billing_last_name() .'</span>'  ?>
                                            </td>
                                            <td><?php echo '<span class="badge bg-light text-dark">'. $order->get_billing_city() .'</span>' ?></td>
                                            <td><?php echo '<span class="badge bg-light text-dark">'. $order->get_billing_state() .'</span>' ?></td>
                                            <td><?php echo '<span class="badge bg-light text-dark">'. $order->get_order_number() .'</span>' ?></td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                <button type="button"
                                                    class="btn btn-primary position-relative btn-xs itemsOrder"
                                                    data-bs-toggle="modal" data-bs-target="#modal-itemsOrder"
                                                    data-order="<?php echo $order->get_order_number(); ?>">
                                                    Orden
                                                    <span
                                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                        <?php echo $order->get_item_count(); ?>
                                                        <span class="visually-hidden">unread messages</span>
                                                    </span>
                                                </button>
                                                </div>
                                            </td>
                                            <td><?php
                                            
                                            if($order->post_status == 'wc-pending'){
                                                echo '<span class="badge badge-warning">Pendiente</span>';
                                            }elseif($order->post_status == 'wc-processing'){
                                                echo '<span class="badge bg-success">Procesado</span>';
                                            }elseif($order->post_status == 'wc-on-hold'){
                                                echo '<span class="badge bg-primary">En espera</span>';
                                            }elseif($order->post_status == 'wc-completed'){
                                                echo '<span class="badge bg-success">Completado</span>';
                                            }elseif($order->post_status == 'wc-cancelled'){
                                                echo '<span class="badge bg-danger">Cancelado</span>';
                                            }elseif($order->post_status == 'wc-refunded'){
                                                echo '<span class="badge bg-danger">Reembolsado</span>';
                                            }elseif($order->post_status == 'wc-failed'){
                                                echo '<span class="badge bg-danger">Fallido</span>';
                                            }elseif($order->post_status == 'wc-fedex'){
                                                echo '<span class="badge bg-success">Enviado con FedEx</span>
                                                <i class="fas fa-shipping-fast"></i>
                                                ';
                                            }
                                            
                                             ?>

                                            </td>
                                            <td>
                                                <?php
                                                  if($order->post_status!= 'wc-fedex' && $order->post_status!= 'wc-cancelled' && $order->post_status!= 'wc-failed'){              
                                                ?>
                                                <a href="javascript:void(0);" data-bs-toggle="modal"
                                                    data-bs-target="#modal-order"
                                                    data-order="<?php echo $order->get_order_number(); ?>"
                                                    class="btn rounded-pill btn-outline-primary bg-primary text-white btn-sm order">
                                                    <i class="fas fa-paper-plane"></i></a>


                                                <?php }elseif($order->post_status!= 'wc-cancelled' && $order->post_status!= 'wc-failed'){

                                                    ?>

                                                <a href="javascript:void(0);"
                                                    data-order="<?php echo $order->get_order_number(); ?>"
                                                    class="btn rounded-pill btn-outline-primary bg-primary text-white btn-sm printLabel">
                                                    <i class="fas fa-print"></i></a>


                                                <a href="javascript:void(0);"
                                                    data-order="<?php echo $order->get_order_number(); ?>"
                                                    class="btn rounded-pill btn-outline-danger bg-danger text-white btn-sm cancelOrder">
                                                    <i class="fas fa-trash"></i></a>



                                                <?php

                                                } ?>



                                            </td>
                                        </tr>
                                        <?php
                                            $i++;
                                        }
                                        ?>
                                    </tbody>
                                </table>

                            </div>

                        </div>

                    </div>

                </div>


            </div>

        </div>

    </div>


</div>