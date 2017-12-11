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
  <div class="col-xs-6">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Add price list</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form action="<?= base_url(); ?>/Inventory/price_list" method="post" role="form">
        <div class="box-body">
          <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" id="name" placeholder="" name="list_name" type="text" required>
            <input hidden name="new_list_form" value="true">
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right">Add Price List</button>
        </div>
      </form>
    </div>
  </div>
</div>


<div class="row">
  <div class="col-xs-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Price Lists</h3>
      </div>
      <div class="box-body">
        <table id="table_price_lists" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Price list ID</th>
              <th>Price list name</th>
              <th>Details</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($lists as $list) {
                echo "<tr>";
                echo '<td> #PL-'.$list->id.'</td>';
                echo '<td> '.$list->name.'</td>';
                echo '<td>
                        <form action="'.base_url().'/Inventory/price_list/'.$list->id.'">
                          <button type="submit" class="btn btn-block btn-info"> Pick </button>
                        </form>
                        </td>';
                echo "</tr>";
              }
            ?>
          </tbody>
          <tfoot>
            <tr>
              <th>Price list ID</th>
              <th>Price list name</th>
              <th>Details</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="box-footer">

      </div>
    </div>
  </div>
</div>
