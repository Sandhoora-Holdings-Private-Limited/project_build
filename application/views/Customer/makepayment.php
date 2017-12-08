
<div class="row">
  <div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Make Payment</h3>
        </div>
      
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="<?= base_url(); ?>/Customer/payment" method="post">
          
          <div class="box-body">
            
            <div class="form-group">
              <label for="exampleInputEmail1">Customer Id</label>
              <input type="text" class="form-control" id="customer_id" name="customer_id">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Project Id</label>
              <input type="text" class="form-control" id="project_id"  name="project_id">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Amount</label>
              <input type="text" class="form-control" id="ammount"  name="ammount">
            </div>
             
            
          </div>
          
          

          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
          

        </form>
      </div>
  </div>
</div>
