
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ProjectBuild</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href= "http://localhost:8001//assets/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="http://localhost:8001//assets/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="http://localhost:8001//assets/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="http://localhost:8001//assets/css/AdminLTE.min.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="http://localhost:8001//assets/css/bootstrap-datepicker.min.css">
  <!-- Applying skin-black-->
  <link rel="stylesheet" href="http://localhost:8001//assets/css/skin-black.min.css">
    <!-- DataTables -->
  <link rel="stylesheet" href="http://localhost:8001//assets/css/dataTables.bootstrap.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="http://localhost:8001//assets/css/select2.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body>


<section class="invoice">
   <form action="<?= base_url(); ?>/Project/operation_inbox_create_purchase_order/<?= $project_id ?>" method="post">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            Sandhoora Holdings Private Limited
            <big class="pull-right">
            Purchase Order
          </big>
          </h2>

        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->

      <div class="row invoice-info">
        <div class="col-sm-6 invoice-col">
          <table class="table">
            <tr>
              <td> <strong class="pull-right"> Vendor :</strong> </td>
              <td>
                <?php
                  if(isset($vendor))
                  {
                    echo $vendor->name;
                    echo '<input name="vendor" value="'.$vendor->id.'" hidden>';
                  }
                  else
                  {
                    echo '<select class="select2" name="vendor">';
                    foreach ($vendors as $vendor) {
                      echo '<option value="'.$vendor->id.'">'.$vendor->name.'</option>';
                    }
                    //echo '<option value="'.$vendor->id.'">ads asd as da sd a sd asd as das</option>';
                    echo '</select>';
                  }

                ?>
              </td>
            </tr>
          </table>
        </div>
        <!-- /.col -->
        <div class="col-sm-6 invoice-col">
          <table class="table">
            <tr>
              <td> <strong class="pull-right">Purchase order ID :</strong> </td>
              <td>#PO-<?php if(isset($po_id))echo $po_id; else echo "__"; ?> </td>
            </tr>
            <tr>
              <td> <strong class="pull-right">Order date :</strong> </td>
              <td>
                <?php
                  if(isset($date))
                  {
                    echo $date;
                    echo '<input name="date" value="'.$date.'" hidden>';
                  }
                  else
                  {
                     echo '<input name="date" class="form-control pull-right" value="'.date('Y-m-d').'" id="po_datepicker" type="text">';
                  }

                ?>
              </td>
            </tr>
          </table>
        </div>
        <!-- /.col -->

        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Qty</th>
              <th>Product</th>
              <th>Serial #</th>
              <th>Description</th>
              <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $total = 0.00;
              for ($i=0; $i < sizeof($transactions); $i++)
              {
                echo "<tr>";
                echo '<input name="t_'.$i.'" value="'.$transactions[$i]->transaction_id.'" hidden>';
                echo '<td>'.$transactions[$i]->no_of_units.' '.$transactions[$i]->item_unit.'</td>';
                echo '<td>'.$transactions[$i]->item_name.'</td>';
                echo '<td> #ITM'.$transactions[$i]->item_id.'</td>';
                echo '<td>'.$transactions[$i]->stage_name.'</td>';
                echo '<td>'.number_format(((float)$transactions[$i]->no_of_units * (float)$transactions[$i]->price),2,'.',',' ).'</td>';
                echo "</tr>";
                $total += ((float)$transactions[$i]->no_of_units * (float)$transactions[$i]->price);
              }
            ?>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
        </div>
        <!-- /.col -->
        <div class="col-xs-6">


          <div class="table-responsive">
            <table class="table">
              <tbody><tr>
                <th style="width:50%">Subtotal:</th>
                <td>Rs<?= number_format(((float)$total),2,'.',',' ); ?></td>
              </tr>
              <tr>
                  <?php
                  if(isset($tax))
                  {
                    echo '<th>Tax('.number_format(((float)$tax),2,'.',',' ).'%)</th>';
                    echo '<td>Rs'.number_format((((float)$tax/100.00)*(float)$total),2,'.',',' ).' </td>';
                  }
                  else
                  {
                    echo '<th>Tax :</th>';
                     echo '<td><input type="number" min="1" max="100" step="0.01" name="tax"> %</td>';
                  }
                 ?>
              </tr>

              <tr>
                <th>Total:</th>
                <td>Rs
                  <?php
                  if(isset($tax))
                    {
                      echo number_format(((((float)$tax/100.00)+1.00)*(float)$total),2,'.',',' ).' </td>';
                      echo '<input name="tax" value="'.$tax.'" hidden>';
                    }
                  else
                  {
                     echo number_format(((float)$total),2,'.',',' ).' + Tax';
                  }
                 ?>
                </td>
              </tr>
            </tbody></table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
    <input hidden name="po_form" value="true">
    </form>
    </section>
    <script type="text/javascript">
      win = window.open("<?= base_url(); ?>/Project/operation_inbox/<?= $project_id; ?>/tab_purchases", '_blank');
      win.focus();
    </script>>
</body>
</html>
