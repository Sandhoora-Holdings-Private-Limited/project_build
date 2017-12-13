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
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Pick a stage</h3>
      </div>
      <div class="box-body">
        <table id="table_stages_material_request" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Stage ID</th>
              <th>Stage name</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($stages as $stage) {
                echo "<tr>";
                echo '<td> #STG'.$stage->id.'</td>';
                echo '<td> '.$stage->name.'</td>';
                echo '<td>
                        <form action="'.base_url().'/Project/operation_request/'.$project_id.'/'.$stage->id.'" method="post">
                            <button type="submit" class="btn btn-block btn-info"> Pick </button>
                          </form>
                        </td>';
                echo "</tr>";
              }
            ?>
          </tbody>
          <tfoot>
            <tr>
              <th>Stage ID</th>
              <th>Stage name</th>
              <th></th>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="box-footer">

      </div>
    </div>
  </div>
</div>
