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
        <h3 class="box-title">Authorization matrix</h3>
      </div>
      <div class="box-body">
        <table id="team_members" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>User</th>
              <th>Role</th>
              <th>Request</th>
              <th>Approve</th>
              <th>Purchase</th>
              <th>Receive</th>
              <th>Pay</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($team_members as $member) {
                echo "<tr>";
                echo '<td>'.$member->user_name.'</td>';
                echo '<td>'.$member->role_name.'</td>';

                echo '<form action="'.base_url().'/Project/team_authority/'.$project_id.'" method="post">';

                echo '<td> <input type="checkbox" value="true" name="request"> </td>';
                echo '<td> <input type="checkbox" value="true" name="approve"> </td>';
                echo '<td> <input type="checkbox" value="true" name="purchase"> </td>';
                echo '<td> <input type="checkbox" value="true" name="recive"> </td>';
                echo '<td> <input type="checkbox" value="true" name="pay"> </td>';
                echo '<td>
                      <input name="id" value="'.$member->id.'" hidden>
                      <button type="submit" class="btn btn-danger"> Update </button>';
                echo '</form>';

                echo "</tr>";
              }
            ?>
          </tbody>
          <tfoot>
            <tr>
              <th>User</th>
              <th>Role</th>
              <th>Request</th>
              <th>Approve</th>
              <th>Purchase</th>
              <th>Receive</th>
              <th>Pay</th>
              <th></th>
            </tr>
          </tfoot>

          </form>
        </table>
      </div>
      <div class="box-footer">
      </div>
    </div>
  </div>
</div>
