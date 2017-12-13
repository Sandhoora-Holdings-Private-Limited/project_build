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
        <h3 class="box-title">Add price</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form action="<?= base_url(); ?>/Inventory/price_list/<?= $list_id; ?>" method="post" role="form">
        <div class="box-body">
          <div class="form-group">
            <table class="table">
              <tbody>
                <tr>
                  <td><label for="name">Unit Price</label></td>
                  <td><input class="form-control" id="name" placeholder="" name="new_price" type="number" min=0 required></td>
                </tr>
                <tr>
                  <td><label for="name">Item</label></td>
                  <td><select style="width:100%" class="select2" name="new_item_id">';
                        <?php
                          foreach ($items as $item)
                          {
                            echo '<option value="'.$item->id.'">'.$item->name.'</option>';
                          }
                        ?>
                      </select></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <input hidden name="new_price_form" value="true">
          <button type="submit" class="btn btn-primary pull-right">Add/Update Price</button>
        </div>
      </form>
    </div>
  </div>
</div>


<div class="row">
  <div class="col-xs-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Price List</h3>
      </div>
      <div class="box-body">
        <table id="table_price_lists" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Item ID</th>
              <th>Item name</th>
              <th>Item unit</th>
              <th>Unit price</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($prices as $price) {
                echo "<tr>";
                echo '<td> #ITM-'.$price->item_id.'</td>';
                echo '<td> '.$price->name.'</td>';
                echo '<td> '.$price->unit.'</td>';
                echo '<td> '.$price->price.'</td>';
                echo "</tr>";
              }
            ?>
          </tbody>
          <tfoot>
            <tr>
              <th>Item ID</th>
              <th>Item name</th>
              <th>Item unit</th>
              <th>Unit price</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="box-footer">

      </div>
    </div>
  </div>
</div>
