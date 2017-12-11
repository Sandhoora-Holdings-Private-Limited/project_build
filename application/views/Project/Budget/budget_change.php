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
	      <h3 class="box-title">Upload Budget CVS File</h3>
	    </div>
	    <!-- /.box-header -->
	    <!-- form start -->
	    <form role="form" action="<?= base_url(); ?>/Project/budget_change/<?= $project_id;?>" method="post" enctype="multipart/form-data">
	      <div class="box-body">
	        <div class="form-group">
	          <label for="exampleInputFile">File input</label>
	          <input name="budget_file" id="budget_file" type="file">

	          <p class="help-block">Upload your cvs file here.</p>
	        </div>
	        </div>

	      <!-- /.box-body -->

	      <div class="box-footer">
	        <button name="upload" type="submit"  class="btn btn-primary">Submit</button>
	        <button name="download_template" type="submit" class="btn pull-right btn-success">Download CVS template</button>
	      </div>
	    </form>
	  </div>
	</div>
</div>
