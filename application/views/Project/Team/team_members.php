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
        <h3 class="box-title">Team members</h3>
      </div>
      <div class="box-body">
        <table id="team_members" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Name</th>
              <th>Role name</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($team_members as $member) {
                echo "<tr>";
                echo '<td>'.$member->user_name.'</td>';
                echo '<td>'.$member->role_name.'</td>';
                echo '<td>
                        <form action="'.base_url().'/Project/team_members/'.$project_id.'" method="post">
                            <input name="user_id" value="'.$member->id.'" hidden>
                            <input name="type" value="remove" hidden>
                            <button type="submit" class="btn btn-block btn-danger"> Remove </button>
                          </form>
                        </td>';
                echo "</tr>";
              }
            ?>
          </tbody>
          <tfoot>
            <tr>
              <th>Name</th>
              <th>Role name</th>
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

<div class="row">
  <div class="col-xs-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Other Users</h3>
      </div>
      <div class="box-body">
        <table id="non_team_users" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Name</th>
              <th>Role name</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($non_team_users as $member) {
                echo "<tr>";
                echo '<td>'.$member->user_name.'</td>';
                echo '<td>'.$member->role_name.'</td>';
                echo '<td>
                        <form action="'.base_url().'/Project/team_members/'.$project_id.'" method="post">
                            <input name="user_id" value="'.$member->id.'" hidden>
                            <input name="type" value="add" hidden>
                            <button type="submit" class="btn btn-block btn-success"> Add </button>
                          </form>
                        </td>';
                echo "</tr>";
              }
            ?>
          </tbody>
          <tfoot>
            <tr>
              <th>Name</th>
              <th>Role name</th>
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
