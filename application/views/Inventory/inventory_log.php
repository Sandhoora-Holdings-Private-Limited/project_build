<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Inventory Log</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="table_stock_log" class="table table-bordered table-striped" >
          <thead>
            <tr>
              <th>Item ID</th>
              <th>Item</th>
              <th>Type</th>
              <th>To Project(ID)</th>
              <th>From Project(ID)</th>
              <th>No of units</th>
              <th>Time</th>
              <th>User</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($logs as $log)
              {
                echo '<tr>';

                  echo '<td> '.$log->id.' </td>';
                  echo '<td> '.$log->name.' </td>';
                  if($log->to_project_id == NULL)
                  {
                    echo '<td> <small class="label pull-right bg-red"> OUT </small> </td>';
                    echo '<td> - </td>';
                    echo '<td> #PR-'.$project_id.' </td>';
                  }
                  elseif($log->from_project_id == NULL)
                  {
                    echo '<td> <small class="label pull-right bg-green"> IN </small> </td>';
                    echo '<td> #PR-'.$project_id.' </td>';
                    echo '<td> - </td>';
                  }
                  elseif($log->to_project_id == 1)
                  {
                    echo '<td> <small class="label pull-right bg-navy"> TRANSFER OUT </small> </td>';
                    echo '<td> MAIN </td>';
                    echo '<td> #PR-'.$project_id.' </td>';
                  }
                  elseif($log->from_project_id == 1)
                  {
                    echo '<td> <small class="label pull-right bg-yellow"> TRANSFER IN </small> </td>';
                    echo '<td> #PR-'.$project_id.' </td>';
                    echo '<td> MAIN </td>';
                  }
                  else
                  {
                    echo '<td> <small class="label pull-right bg-purple"> ERROR </small> </td>';
                    echo '<td> - </td>';
                    echo '<td> - </td>';
                  }
                  echo '<td> '.$log->no_of_units.' '.$log->unit.' </td>';
                  echo '<td> '.$log->time.' </td>';
                  echo '<td> '.$log->user_id.' </td>';
                echo '</tr>';
              }
            ?>
          </tbody>
          <tfoot>
            <tr>
              <th>Item ID</th>
              <th>Item</th>
              <th>Type</th>
              <th>To Project(ID)</th>
              <th>From Project(ID)</th>
              <th>No of units</th>
              <th>Time</th>
              <th>User</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
</div>
