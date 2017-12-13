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
        <h3 class="box-title">Add new item</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form action="<?= base_url(); ?>/Inventory/item_list" method="post" role="form">
        <div class="box-body">
          <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" id="name" placeholder="" name="item_name" type="text" required>
            <label for="name">Unit</label>
            <input class="form-control" id="name" placeholder="" name="item_unit" type="text" required>
            <input hidden name="new_item_form" value="true">
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right">Add Item</button>
        </div>
      </form>
    </div>
  </div>
  <div class="col-xs-6">
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Upload Item List CVS File</h3>
        </div>
      <!-- /.box-header -->
      <!-- form start -->
        <form role="form" action="<?= base_url(); ?>/Inventory/item_list" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <label for="exampleInputFile">File input</label>
              <input name="item_list_file" id="item_list_file" type="file">

              <p class="help-block">Upload your cvs file here.</p>
            </div>
            </div>

          <!-- /.box-body -->

          <div class="box-footer">
            <button name="upload" type="submit"  class="btn btn-primary">Submit</button>
            <a href="<?= base_url(); ?>/assets/downloads/item_list_template.csv" download class="btn pull-right btn-success">Download CVS template
            </a>
          </div>
        </form>
    </div>
  </div>
</div>


<div class="row">
  <div class="col-xs-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Items</h3>
      </div>
      <div class="box-body">
        <table id="table_items" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Item ID</th>
              <th>Item name</th>
              <th>Item unite</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($items as $item) {
                echo "<tr>";
                echo '<td> #ITM-'.$item->id.'</td>';
                echo '<td> '.$item->name.'</td>';
                echo '<td> '.$item->unit.'</td>';
                echo "</tr>";
              }
            ?>
          </tbody>
          <tfoot>
            <tr>
              <th>Item ID</th>
              <th>Item name</th>
              <th>Item unite</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="box-footer">

      </div>
    </div>
  </div>
</div>
