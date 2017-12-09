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

<div class="row">
	<div class="col-xs-12">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="<?php if($active_tab == 'tab_approvals') echo 'active';?>"><a href="#tab_approvals" data-toggle="tab" aria-expanded="true">To be approved</a></li>
        <li class="<?php if($active_tab == 'tab_purchases') echo 'active';?>"><a href="#tab_purchases" data-toggle="tab" aria-expanded="false">To be purchased</a></li>
        <li class="<?php if($active_tab == 'tab_pay') echo 'active';?>"><a href="#tab_pay" data-toggle="tab" aria-expanded="false">To be paid</a></li>
        <li class="<?php if($active_tab == 'tab_recive') echo 'active';?>"><a href="#tab_recive" data-toggle="tab" aria-expanded="false">To be recived</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="tab_approvals">
          <table id="table_approvals" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>type</th>
                <th>Transaction ID</th>
                <th>Item/Name</th>
                <th>Stage</th>
                <th>No of units/ammount</th>
                <th>Budgeted no of units/ammount</th>
                <th>Budgeted unit price</th>
                <th>Value (Rs)</th>
                <th>Created time</th>
                <th></th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($transactions['to_be_approved'] as $transaction)
              {
                echo '<tr>';
                  echo '<td><small class="label bg-blue">material</small></td>';
                  echo '<td> #MT'.$transaction->transaction_id.'</td>';
                  echo '<td>'.$transaction->item_name.'</td>';
                  echo '<td>'.$transaction->stage_name.'</td>';
                  echo '<td>'.number_format(((float)$transaction->no_of_units),2,'.',',' ).'</td>';
                  echo '<td>'.number_format(((float)$transaction->budgeted_no_of_units),2,'.',',' ).'</td>';
                  echo '<td>'.number_format(((float)$transaction->price),2,'.',',' ).'</td>';
                  echo '<td>'.number_format(((float)$transaction->no_of_units * (float)$transaction->price),2,'.',',' ).'</td>';
                  echo '<td>'.$transaction->time.'</td>';
                  echo '<td>
                          <form action="'.base_url().'/Project/operation_inbox/'.$project_id.'" method="post">
                            <input hidden name="transaction_id" value="'.$transaction->transaction_id.'">
                            <input hidden name="transaction_type" value="material">
                            <input hidden name="type" value="approve">
                            <button type="submit" class="btn btn-block btn-success">Approve</button></td>
                          </form>
                        </td>';
                  echo '<td>
                          <form action="'.base_url().'/Project/operation_inbox/'.$project_id.'" method="post">
                            <input hidden name="transaction_id" value="'.$transaction->transaction_id.'">
                            <input hidden name="transaction_type" value="material">
                            <input hidden name="type" value="denie">
                            <button type="submit" class="btn btn-block btn-danger">Denie</button></td>
                          </form>
                        </td>';
                  echo '<td>
                          <form action="'.base_url().'/Project/operation_inbox/'.$project_id.'" method="post">
                            <input hidden name="transaction_type" value="material">
                            <input hidden name="transaction_id" value="'.$transaction->transaction_id.'">
                            <input hidden name="type" value="view">
                            <button type="submit" class="btn btn-block btn-info">View details</button></td>
                          </form>
                        </td>';
                echo '</tr>';
              }
              foreach ($transactions['to_be_approved_other'] as $transaction)
              {
                echo '<tr>';
                  echo '<td><small class="label bg-red">payment</small></td>';
                  echo '<td> #OP'.$transaction->transaction_id.'</td>';
                  echo '<td>'.$transaction->name.'</td>';
                  echo '<td>'.$transaction->stage_name.'</td>';
                  echo '<td>'.number_format(((float)$transaction->ammount),2,'.',',' ).'</td>';
                  echo '<td>'.number_format(((float)$transaction->budgeted_ammount),2,'.',',' ).'</td>';
                  echo '<td> - </td>';
                  echo '<td>'.number_format(((float)$transaction->budgeted_ammount),2,'.',',' ).'</td>';
                  echo '<td>'.$transaction->time.'</td>';
                  echo '<td>
                      <form action="'.base_url().'/Project/operation_inbox/'.$project_id.'" method="post">
                        <input hidden name="transaction_id" value="'.$transaction->transaction_id.'">
                        <input hidden name="transaction_type" value="other_payment">
                        <input hidden name="type" value="approve">
                        <button type="submit" class="btn btn-block btn-success">Approve</button></td>
                      </form>
                    </td>';
                  echo '<td>
                          <form action="'.base_url().'/Project/operation_inbox/'.$project_id.'" method="post">
                            <input hidden name="transaction_id" value="'.$transaction->transaction_id.'">
                            <input hidden name="transaction_type" value="other_payment">
                            <input hidden name="type" value="denie">
                            <button type="submit" class="btn btn-block btn-danger">Denie</button></td>
                          </form>
                        </td>';
                  echo '<td>
                          <form action="'.base_url().'/Project/operation_inbox/'.$project_id.'" method="post">
                            <input hidden name="transaction_type" value="other_payment">
                            <input hidden name="transaction_id" value="'.$transaction->transaction_id.'">
                            <input hidden name="type" value="view">
                            <button type="submit" class="btn btn-block btn-info">View details</button></td>
                          </form>
                        </td>';
                echo '</tr>';
              }
              ?>
            </tbody>
            <tfoot>
              <tr>
                <th>Type</th>
                <th>Transaction ID</th>
                <th>Item</th>
                <th>Name</th>
                <th>No of units</th>
                <th>Budgeted no of units</th>
                <th>Budgeted unit price</th>
                <th>Budgeted value (Rs)</th>
                <th>Created time</th>
                <th></th>
                <th></th>
                <th></th>
              </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_purchases">
          <form action="<?= base_url(); ?>/Project/operation_inbox_create_purchase_order/<?= $project_id; ?>" method="post">
            <table id="table_purchases" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Transaction ID</th>
                  <th>Item ID</th>
                  <th>Item</th>
                  <th>Stage</th>
                  <th>No of units</th>
                  <th>Budgeted no of units</th>
                  <th>Budgeted unit price</th>
                  <th>Budgeted value (Rs)</th>
                  <th>Created time</th>
                  <th>Purchase</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($transactions['to_be_purchased'] as $transaction)
                {
                  echo '<tr>';
                    echo '<td> #MT'.$transaction->transaction_id.'</td>';
                    echo '<td> #IT'.$transaction->item_id.'</td>';
                    echo '<td>'.$transaction->item_name.'</td>';
                    echo '<td>'.$transaction->stage_name.'</td>';
                    echo '<td>'.number_format(((float)$transaction->no_of_units),2,'.',',' ).'</td>';
                    echo '<td>'.number_format(((float)$transaction->budgeted_no_of_units),2,'.',',' ).'</td>';
                    echo '<td>'.number_format(((float)$transaction->price),2,'.',',' ).'</td>';
                    echo '<td>'.number_format(((float)$transaction->no_of_units * (float)$transaction->price),2,'.',',' ).'</td>';
                    echo '<td>'.$transaction->time.'</td>';
                    echo '<td><input name="transaction_for_item'.$transaction->transaction_id.'" value="'.$transaction->transaction_id.'" type="checkbox"></td>';
                  echo '</tr>';
                }
                ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>Transaction ID</th>
                  <th>Item ID</th>
                  <th>Item</th>
                  <th>Stage</th>
                  <th>No of units</th>
                  <th>Budgeted no of units</th>
                  <th>Budgeted unit price</th>
                  <th>Budgeted value (Rs)</th>
                  <th>Created time</th>
                  <th>Purchase</th>
                </tr>
              </tfoot>
            </table>
            <button type="submit" class="btn btn-block btn-success btn-lg">Create Purchase Order</button>
          </form>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_pay">
          <table id="table_pay" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Type</th>
                <th>Transaction ID</th>
                <th>Name</th>
                <th>Stage</th>
                <th>Ammount (Rs)</th>
                <th>Vendor</th>
                <th>Created time</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($transactions['to_be_paid_other'] as $transaction)
              {
                echo '<tr>';
                  echo '<td><small class="label bg-red">payment</small></td>';
                  echo '<td> #OP'.$transaction->transaction_id.'</td>';
                  echo '<td>'.$transaction->name.'</td>';
                  echo '<td>'.$transaction->stage_name.'</td>';
                  echo '<td>'.number_format(((float)$transaction->ammount),2,'.',',' ).'</td>';
                  echo '<td> - </td>';
                  echo '<td>'.$transaction->time.'</td>';
                  echo '<td>
                          <form action="'.base_url().'/Project/operation_inbox/'.$project_id.'" method="post">
                            <input hidden name="transaction_id" value="'.$transaction->transaction_id.'">
                            <input hidden name="transaction_type" value="other_payment">
                            <input hidden name="type" value="pay">
                            <button type="submit" class="btn btn-block btn-danger"> Pay </button></td>
                          </form>
                        </td>';
                echo '</tr>';
              }
              foreach ($POs as $po)
              {
                echo '<tr>';
                  echo '<td><small class="label bg-yellow">purchase order</small></td>';
                  echo '<td> #OP'.$po->po_id.'</td>';
                  echo '<td> - </td>';
                  echo '<td> - </td>';
                  echo '<td> - </td>';
                  echo '<td>'.$po->vendor.'</td>';
                  echo '<td>'.$po->time.'</td>';
                  echo '<td>
                          <form action="'.base_url().'/Project/operation_inbox_pay_purchase_order/'.$project_id.'" method="post">
                            <input hidden name="po_id" value="'.$po->po_id.'">
                            <button type="submit" class="btn btn-block btn-warning"> Reconcile </button></td>
                          </form>
                        </td>';
                echo '</tr>';
              }
              ?>
            </tbody>
            <tfoot>
              <tr>
                <th>Type</th>
                <th>Transaction ID</th>
                <th>Name</th>
                <th>Stage</th>
                <th>Ammount (Rs)</th>
                <th>Vendor</th>
                <th>Created time</th>
                <th></th>
              </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_recive">
          <form action="<?= base_url(); ?>/Project/operation_inbox_confirm_goods_recived/<?= $project_id; ?>" method="post">
            <table id="table_recivables" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Purchase Order ID</th>
                  <th>Vendor</th>
                  <th>Item ID</th>
                  <th>Item</th>
                  <th>No of units</th>
                  <th>Created time</th>
                  <th>Ricived</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($transactions['to_be_recived'] as $transaction)
                {
                  echo '<tr>';
                    echo '<td> #PO'.$transaction->po_id.'</td>';
                    echo '<td>'.$transaction->vendor.'</td>';
                    echo '<td> #IT'.$transaction->item_id.'</td>';
                    echo '<td>'.$transaction->item_name.'</td>';
                    echo '<td>'.number_format(((float)$transaction->no_of_units),2,'.',',' ).'</td>';
                    echo '<td>'.$transaction->time.'</td>';
                    echo '<td><input name="transaction_for_item'.$transaction->transaction_id.'" value="'.$transaction->transaction_id.'" type="checkbox"></td>';
                  echo '</tr>';
                }
                foreach ($transactions['to_be_transfered'] as $transaction)
                {
                  echo '<tr>';
                    echo '<td> - </td>';
                    echo '<td> - </td>';
                    echo '<td> #IT'.$transaction->item_id.'</td>';
                    echo '<td>'.$transaction->item_name.'</td>';
                    echo '<td>'.number_format(((float)$transaction->no_of_units),2,'.',',' ).'</td>';
                    echo '<td>'.$transaction->time.'</td>';
                    echo '<td><input name="transaction_for_item'.$transaction->transaction_id.'" value="'.$transaction->transaction_id.'" type="checkbox"></td>';
                  echo '</tr>';
                }
                ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>Purchase Order ID</th>
                  <th>Vendor</th>
                  <th>Item ID</th>
                  <th>Item</th>
                  <th>No of units</th>
                  <th>Created time</th>
                  <th>Ricived</th>
                </tr>
              </tfoot>
            </table>
            <button type="submit" class="btn btn-block btn-success btn-lg">Create goods recived note</button>
          </form>
        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
	</div>
</div>

<div class="modal fade in" id="modal-default" style="display:<?php if(isset($view_transaction_details)) echo "block" ; else "none"; ?>;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
       <a href="<?= base_url(); ?>/Project/operation_inbox/<?= $project_id ?>"> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button></a>
        <h4 class="modal-title">Request Details</h4>
      </div>
      <div class="modal-body">
            <canvas id="myChart" width="400" height="400"></canvas>
      </div>
      <div class="modal-footer">
        <a href="<?= base_url(); ?>/Project/operation_inbox/<?= $project_id ?>"><button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button></a>
        <button type="button" class="btn btn-danger">Denie</button>
        <button type="button" class="btn btn-warning">Split</button>
        <button type="button" class="btn btn-success">Approve</button>

      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
