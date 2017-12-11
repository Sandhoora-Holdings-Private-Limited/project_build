<div class="row">
  <div class="col-xs-12">
    <div class="box with-border">
      <div class="box-header with-border">
        <h3 class="box-title">Alanytics on whole project</h3>
      </div>
      <div class="box-body">
        <canvas id="project"></canvas>
      </div>
      <div class="box-footer with-border">
      </div>
    </div>
  </div>
</div>

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
              <th>Stage name</th>
              <th>Budgeted</th>
              <th>Spent</th>
              <th>Pending</th>
              <th>Remaining</th>
              <th>Details</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($stages as $stage)
              {
                echo '<tr>';
                  echo '<td> '.$stage['name'].' </td>';
                  echo '<td> '.number_format(((float)$stage['budgeted']),2,'.',',' ).' </td>';
                  echo '<td> '.number_format(((float)$stage['spent']),2,'.',',' ).'</td>';
                  echo '<td> '.number_format(((float)$stage['pending']),2,'.',',' ).'</td>';
                  echo '<td> '.number_format(((float)$stage['remaining']),2,'.',',' ).'</td>';
                  echo '<td>

                  <form action="'.base_url().'/Project/analytics/'.$project_id.'/'.$stage['id'].'" method="post">
                    <button type="submit" class="btn btn-block btn-info">Detail</button>
                  </form></td>';
                  echo '<td class="col-xs-1">
                  <canvas id="stage_'.$stage['id'].'"></canvas>
                  </td>';
                echo '</tr>';
              }
            ?>
          </tbody>
          <tfoot>
            <tr>
              <th>Stage name</th>
              <th>Budgeted</th>
              <th>Spent</th>
              <th>Pending</th>
              <th>Remaining</th>
              <th>Details</th>
              <th></th>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
</div>
