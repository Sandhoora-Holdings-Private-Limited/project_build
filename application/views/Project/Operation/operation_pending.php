<div class="row">
	<div class="col-xs-12">
		<div class="box">
      <div class="box-header">
        <h3 class="box-title">Pending Requests</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="table_pending_requesst" class="table table-bordered table-striped" >
          <thead>
            <tr>
              <th>Type</th>
              <th>Status</th>
              <th>Stage</th>
              <th>Item ID</th>
              <th>Item/Name</th>
              <th>No of units/ ammount(Rs)</th>
              <th>Created on</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($transactions['to_be_approved'] as $t)
              {
                echo '<tr>';
                echo '<td> <small class="label pull-right bg-yellow"> material </small> </td>';
                echo '<td> <small class="label pull-right bg-navy"> to be approved </small> </td>';
                echo '<td> '.$t->stage_name.' </td>';
                echo '<td> '.$t->item_id.' </td>';
                echo '<td> '.$t->item_name.' </td>';
                echo '<td> '.$t->no_of_units.' '.$t->item_unit.' </td>';
                echo '<td> '.$t->time.' </td>';
                echo '</tr>';
              }

              foreach ($transactions['to_be_purchased'] as $t)
              {
                echo '<tr>';
                echo '<td> <small class="label pull-right bg-yellow"> material </small> </td>';
                echo '<td> <small class="label pull-right bg-aqua"> to be purchased </small> </td>';
                echo '<td> '.$t->stage_name.' </td>';
                echo '<td> '.$t->item_id.' </td>';
                echo '<td> '.$t->item_name.' </td>';
                echo '<td> '.$t->no_of_units.' '.$t->item_unit.' </td>';
                echo '<td> '.$t->time.' </td>';
                echo '</tr>';
              }

              foreach ($transactions['to_be_recived'] as $t)
              {
                echo '<tr>';
                echo '<td> <small class="label pull-right bg-yellow"> material </small> </td>';
                echo '<td> <small class="label pull-right bg-green"> to be recived </small> </td>';
                echo '<td> '.$t->stage_name.' </td>';
                echo '<td> '.$t->item_id.' </td>';
                echo '<td> '.$t->item_name.' </td>';
                echo '<td> '.$t->no_of_units.' '.$t->item_unit.' </td>';
                echo '<td> '.$t->time.' </td>';
                echo '</tr>';
              }

              foreach ($transactions['to_be_transfered'] as $t)
              {
                echo '<tr>';
                echo '<td> <small class="label pull-right bg-yellow"> material </small> </td>';
                echo '<td> <small class="label pull-right bg-blue"> to be transfered </small> </td>';
                echo '<td> '.$t->stage_name.' </td>';
                echo '<td> '.$t->item_id.' </td>';
                echo '<td> '.$t->item_name.' </td>';
                echo '<td> '.$t->no_of_units.' '.$t->item_unit.' </td>';
                echo '<td> '.$t->time.' </td>';
                echo '</tr>';
              }

              foreach ($transactions['to_be_paid'] as $t)
              {
                echo '<tr>';
                echo '<td> <small class="label pull-right bg-yellow"> material </small> </td>';
                echo '<td> <small class="label pull-right bg-purple"> to be paid </small> </td>';
                echo '<td> '.$t->stage_name.' </td>';
                echo '<td> '.$t->item_id.' </td>';
                echo '<td> '.$t->item_name.' </td>';
                echo '<td> '.$t->no_of_units.' '.$t->item_unit.' </td>';
                echo '<td> '.$t->time.' </td>';
                echo '</tr>';
              }

              foreach ($transactions['to_be_approved_other'] as $t)
              {
                echo '<tr>';
                echo '<td> <small class="label pull-right bg-red"> payment </small> </td>';
                echo '<td> <small class="label pull-right bg-navy"> to be approved </small> </td>';
                echo '<td> '.$t->stage_name.' </td>';
                echo '<td> - </td>';
                echo '<td> '.$t->name.' </td>';
                echo '<td> Rs '.$t->ammount.'</td>';
                echo '<td> '.$t->time.' </td>';
                echo '</tr>';
              }

              foreach ($transactions['to_be_paid_other'] as $t)
              {
                echo '<tr>';
                echo '<td> <small class="label pull-right bg-red"> payment </small> </td>';
                echo '<td> <small class="label pull-right bg-purple"> to be paid </small> </td>';
                echo '<td> '.$t->stage_name.' </td>';
                echo '<td> - </td>';
                echo '<td> '.$t->name.' </td>';
                echo '<td> Rs '.$t->ammount.'</td>';
                echo '<td> '.$t->time.' </td>';
                echo '</tr>';
              }
            ?>
          </tbody>
          <tfoot>
            <tr>
              <th>Type</th>
              <th>Status</th>
              <th>Stage</th>
              <th>Item ID</th>
              <th>Item/Name</th>
              <th>No of units/ ammount(Rs)</th>
              <th>Created on</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
	</div>
</div>
