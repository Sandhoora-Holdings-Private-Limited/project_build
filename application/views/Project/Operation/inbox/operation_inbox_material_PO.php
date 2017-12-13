<div class="row">
  <div class="col-xs-12">
    <div style="display:<?php if(isset($fail)) echo"block"; else echo "none"; ?>;" class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-ban"></i> Failed!</h4>
      <?php if(isset($message)) echo $message; ?>
    </div>
    <div style="display:<?php if(isset($sucess)) echo"block"; else echo "none"; ?>;"  class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Sucess!</h4>
      <?php if(isset($message)) echo $message; ?>
    </div>
  </div>
</div>
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
                    echo '<br>';
                    echo $vendor->email;
                    echo '<br>';
                    echo $vendor->phone_number;
                    echo '<br>';
                    echo $vendor->address;
                    echo '<input name="vendor" value="'.$vendor->id.'" hidden>';
                  }
                  else
                  {
                    echo '<select style="width:100%" class="select2" name="vendor">';
                    foreach ($vendors as $vendor) {
                      echo '<option value="'.$vendor->id.'">'.$vendor->name.'</option>';
                    }
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
              <input hidden name="po_id" value="<?php if(isset($po_id))echo $po_id; else echo "__"; ?>">
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
                echo '<td>'.number_format(($transactions[$i]->no_of_units),2,'.',',' ).' '.$transactions[$i]->item_unit.'</td>';
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
      <div class="row no-print">
        <div class="col-xs-12">

            <?php
              if(isset($sucess))
              {
                echo '<input name="print" hidden value="true"/>';
                echo '<button type="submit" class="btn btn-success pull-right">';
                echo 'Print !';
                echo '</button>';
              }
              else
              {
                echo '<input name="do_not_print" hidden value="true"/>';
                echo '<button type="submit" class="btn btn-success pull-right">';
                echo 'Confirm purchase order';
                echo '</button>';
              }
            ?>
          <a style="margin-right: 5px;" href="<?= base_url(); ?>/Project/operation_inbox/<?= $project_id ?>/tab_purchases" class="btn btn-danger pull-left" >
            Go back
          </a>
        </div>
      </div>
    <input hidden name="po_form" value="true">
    </form>
    </section>
