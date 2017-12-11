<div class="row">
  <div class="col-xs-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Pick a stage</h3>
      </div>
      <div class="box-body">
        <table id="customer_details" class="table table-bordered table-striped">
          <thead>
            <tr>
                  <th>Project ID</th>
                  <th>Reason</th>
                  <th>Amount</th>
                  <th>Time</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($projects as $project) {
                echo "<tr>";
                echo '<td> #STG'.$project->project_id.'</td>';
                echo '<td> '.$project->memo.'</td>';
                echo '<td> '. $project->ammount.'</td>';
                echo '<td> '.$project->time.'</td>';

              }
            ?>
          </tbody>
          <tfoot>
            <tr>
              <tr>
              <th>Project ID</th>
              <th>Reason</th>
              <th>Amount</th>
              <th>Time</th>
            </tr>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="box-footer">

      </div>
    </div>
  </div>
</div>



      