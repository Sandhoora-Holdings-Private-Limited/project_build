<div class="row">

  <div class="col-lg-3 col-xs-6">
  <a href="#" class="small-box-footer">
  <div class="small-box bg-aqua">
    <div class="inner">
      <h3>Create</h3>

      <p>New Project</p>
    </div>
    <div class="icon">
      <i class="glyphicon glyphicon-plus"></i>
    </div>
    <div class="small-box-footer">
      create <i class="fa fa-arrow-circle-right"></i>
    </div>
  </div>
  </a>
</div>
<div class="col-lg-3 col-xs-6">
  </div>
  <div class="col-lg-3 col-xs-6">
  </div>
</div>
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Project List</h3>

        <div class="box-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input name="table_search" class="form-control pull-right" placeholder="Search" type="text">

            <div class="input-group-btn">
              <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
          <tbody><tr>
            <th>ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Start date</th>
            <th>End data</th>
          </tr>
          <?php
            foreach ($projects as $project) {
              echo '<tr>';
              echo '<td>'.$project->id.'</td>';
              echo '<td>'.$project->name.'</td>';
              echo '<td>'.$project->address.'</td>';
              echo '<td>'.$project->start_date.'</td>';
              echo '<td>'.$project->end_date.'</td>';
              echo '<td><a href="'.base_url().'/Project/view/'.$project->id.'"><button type="button" class="btn btn-block btn-info">Pick</button></td></a>';
              echo '</tr>';
            }

          ?>
        </tbody></table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
</div>