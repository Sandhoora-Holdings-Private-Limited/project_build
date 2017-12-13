<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Inventory stock</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="table_stock_log" class="table table-bordered table-striped" >
          <thead>
            <tr>
              <th>Item ID</th>
              <th>Item</th>
              <th>No of units</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($stocks as $stock)
              {
                echo '<tr>';

                  echo '<td> '.$stock->id.' </td>';
                  echo '<td> '.$stock->name.' </td>';
                  echo '<td> '.$stock->no_of_units.' '.$stock->unit.' </td>';
                echo '</tr>';
              }
            ?>
          </tbody>
          <tfoot>
            <tr>
              <th>Item ID</th>
              <th>Item</th>
              <th>No of units</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
</div>
