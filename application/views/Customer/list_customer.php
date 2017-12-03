<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Responsive Hover Table</h3>

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
                  <th>Email</th>
                  <th>Phone Number</th>
<th></th>
<th></th>
<th></th>
                </tr>
                <?php 
                foreach ($customers as $customer) {
                 
                
                echo '<tr>';
                  echo '<td>'.$customer->id.'</td>';
                  echo '<td>'.$customer->name.'</td>';
                  echo '<td>'.$customer->address.'</td>';
                  echo '<td>'. $customer->email.'</td>';
                 echo  '<td>'.$customer->phone_number.'</td>';

                  
                  
  echo '<td> <button type="button" class="btn btn-block btn-info">Info</button>  </td>';
  echo '<td> <button type="button" class="btn btn-block btn-success">Edit</button> </td>';
   echo '<td><button type="button" class="btn btn-block btn-danger">Danger</button></td>';
                
              echo '</tr>';
              }
              ?>
                <!--<tr>
                  <td>219</td>
                  <td>Alexander Pierce</td>
                  <td>11-7-2014</td>
                  <td><span class="label label-warning">Pending</span></td>
                  <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                </tr>
                <tr>
                  <td>657</td>
                  <td>Bob Doe</td>
                  <td>11-7-2014</td>
                  <td><span class="label label-primary">Approved</span></td>
                  <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                </tr>
                <tr>
                  <td>175</td>
                  <td>Mike Doe</td>
                  <td>11-7-2014</td>
                  <td><span class="label label-danger">Denied</span></td>
                  <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                </tr>-->
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
