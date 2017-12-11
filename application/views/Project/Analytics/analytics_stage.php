
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Analytics by budget entries on stages</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="table_stage_anayltics" class="table table-bordered table-striped" >
          <thead>
            <tr>
              <th>Type</th>
              <th>Item ID</th>
              <th>Item name</th>
              <th>Budgeted</th>
              <th>Spent</th>
              <th>Pending</th>
              <th>Remaining</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($items as $item)
              {
                echo '<tr>';
                  echo '<td><small class="label bg-blue">material</small></td>';
                  echo '<td> #ITM-'.$item['id'].' </td>';
                  echo '<td> '.$item['name'].' </td>';
                  echo '<td> '.number_format(((float)$item['budgeted']),2,'.',',' ).' </td>';
                  echo '<td> '.number_format(((float)$item['spent']),2,'.',',' ).'</td>';
                  echo '<td> '.number_format(((float)$item['pending']),2,'.',',' ).'</td>';
                  echo '<td> '.number_format(((float)$item['remaining']),2,'.',',' ).'</td>';
                  echo '<td class="col-xs-1">
                   <canvas id="item_'.$item['id'].'"></canvas>
                  </td>';
                echo '</tr>';
              }
              foreach ($payments as $payment)
              {
                echo '<tr>';
                  echo '<td><small class="label bg-red">payment</small></td>';
                  echo '<td> - </td>';
                  echo '<td> '.$payment['name'].' </td>';
                  echo '<td> '.number_format(((float)$payment['budgeted']),2,'.',',' ).' </td>';
                  echo '<td> '.number_format(((float)$payment['spent']),2,'.',',' ).'</td>';
                  echo '<td> '.number_format(((float)$payment['pending']),2,'.',',' ).'</td>';
                  echo '<td> '.number_format(((float)$payment['remaining']),2,'.',',' ).'</td>';
                  echo '<td class="col-xs-1">
                        <canvas id="payment_'.$payment['id'].'"></canvas>
                  </td>';
                echo '</tr>';
              }
            ?>
          </tbody>
          <tfoot>
            <tr>
              <th>Type</th>
              <th>Item ID</th>
              <th>Item name</th>
              <th>Budgeted</th>
              <th>Spent</th>
              <th>Pending</th>
              <th>Remaining</th>
              <th></th>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
</div>
