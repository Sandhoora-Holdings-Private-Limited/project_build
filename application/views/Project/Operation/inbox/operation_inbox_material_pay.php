<div class="row">
  <div class="col-xs-12">
    <div style="display:<?php if(isset($fail)) echo"block"; else echo "none"; ?>;" class="alert alert-danger alert-dismissible" >
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

<div class="row">
  <div class="col-xs-12">
    <form action="<?= base_url(); ?>/Project/operation_inbox_pay_purchase_order/<?= $project_id; ?>" method="post">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Purchase Order #PO-<?= $po_id; ?></h3>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <table class="table">
                <tr>
                  <td> <strong class="pull-right"> Vendor :</strong> </td>
                  <td> <?= $po->vendor_name ?> </td>
                </tr>
                <tr>
                  <td></td>
                  <td> <?= $po->vendor_phone_number ?> </td>
                </tr>
                <tr>
                  <td></td>
                  <td> <?= $po->vendor_email ?> </td>
                </tr>
                <tr>
                  <td></td>
                  <td> <?= $po->vendor_address ?> </td>
                </tr>
              </table>
            </div>
            <div class="col-md-6">
              <table class="table">
                <tr>
                  <td> <strong class="pull-right">Purchase order ID :</strong> </td>
                  <td>#PO-<?= $po_id; ?> </td>
                </tr>
                <tr>
                  <td> <strong class="pull-right">Order date :</strong> </td>
                  <td><?= $po->date ?></td>
                </tr>
              </table>
            </div>
          </div>
          <table id="table_PO_reconsiliation" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Recived</th>
                <th>Item ID</th>
                <th>Item</th>
                <th>No of units</th>
                <th>Stage name</th>
                <th>Created time</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $all_recived = true;
                for ($i=0; $i < sizeof($transactions); $i++)
                {
                  echo "<tr>";
                  if($transactions[$i]->state == 'to_be_paid')
                  {
                    echo '<td><span style="color : green;" class="glyphicon glyphicon-ok"></span></td>';
                  }
                  else
                  {
                    $all_recived = false;
                    echo '<td><span style="color : red;" class="glyphicon glyphicon-remove"></span></td>';
                  }
                  echo '<td> #ITM'.$transactions[$i]->item_id.'</td>';
                  echo '<td>'.$transactions[$i]->item_name.'</td>';
                  echo '<td>'.number_format(($transactions[$i]->no_of_units),2,'.',',' ).' '.$transactions[$i]->item_unit.'</td>';
                  echo '<td>'.$transactions[$i]->stage_name.'</td>';
                  echo '<td>'.$transactions[$i]->time.'</td>';
                  echo "</tr>";
                }
              ?>
            </tbody>
            <tfoot>
              <tr>
                <th>Recived</th>
                <th>Item ID</th>
                <th>Item</th>
                <th>No of units</th>
                <th>Stage name</th>
                <th>Created time</th>
              </tr>
            </tfoot>
          </table>
        </div>
      <div class="box-footer">
        <?php
          if(isset($sucess))
          {
             echo '<input name="print" hidden value="true"/>';
              echo '<a class="disabled btn btn-success pull-right">';
              echo 'Done !';
              echo '</a>';
          }
          else
          {
            if($all_recived)
            {
              echo '<button type="submit" class="btn btn-success pull-right">';
              echo 'Record Payment';
              echo '</button>';
            }
            else
            {
              echo '<a class="disabled btn btn-success pull-right">';
              echo 'Cannot record payment';
              echo '</a>';
            }
          }
        ?>
        <a style="margin-right: 5px;" href="<?= base_url(); ?>/Project/operation_inbox/<?= $project_id ?>/tab_pay" class="btn btn-danger pull-left" >
          Go back
        </a>
      </div>
    </div>
      <input name="po_pay_form" value="" hidden>
      <input name="po_id" value="<?= $po_id ?>" hidden>
    </form>
  </div>
</div>
