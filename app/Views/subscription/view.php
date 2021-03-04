<?= $this->extend('templates/admin_template') ?>
<?= $this->section('content') ?>
<?php $BASE_URL = base_url()."/index.php/"; ?>
    <div class="card-header pl-0 pr-0">
   <div class="content-header pt-0">
  <div class="container-fluid">
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
								<div class="table-data__tool margin_bottom_table">
                                    <div class="table-data__tool-left">
                                    </div>
                                    <div class="table-data__tool-right">										
                                    <a href="<?= $BASE_URL.'subscription/list';?>">
											<i class="fa fa-arrow-left"></i> Back
										</a>
                                    </div>
                                </div>
							</div>
                         </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong class="card-title"><center>Subscription Details</center></strong>
                                    </div>
                                    <div class="card-body">
									<div class="row">
										<div class="col-lg-6 col-sm-6 col-xs-12">
											<p class="card-text card_text_align"> Package <span class="float_right">:</span></p>
										</div>
										<div class="col-lg-6 col-sm-6 col-xs-12">
											<p><?php echo $arr_subDetails['package_month'];?></p>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6 col-sm-6 col-xs-12">
											<p class="card-text card_text_align">Start Date <span class="float_right">:</span></p>
										</div>
										<div class="col-lg-6 col-sm-6 col-xs-12">
											<p><?php echo $arr_subDetails['start_date'];?></p>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6 col-sm-6 col-xs-12">
											<p class="card-text card_text_align">End Date <span class="float_right">:</span></p>
										</div>
										<div class="col-lg-6 col-sm-6 col-xs-12">
											<p><?php echo $arr_subDetails['end_date'];?></p>
										</div>
                                    </div>
                                  
									<div class="row">
										<div class="col-lg-6 col-sm-6 col-xs-12">
											<p class="card-text card_text_align">Description <span class="float_right">:</span></p>
										</div>
										<div class="col-lg-6 col-sm-6 col-xs-12">
											<p><?php echo $arr_subDetails['description'];?></p>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6 col-sm-6 col-xs-12">
											<p class="card-text card_text_align">Customer <span class="float_right">:</span></p>
										</div>
										<div class="col-lg-6 col-sm-6 col-xs-12">
											<p><?php echo $arr_subDetails['email'];?></p>
										</div>
                                    </div>					
                                    </div>
                                </div>
                            </div>
					
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	</div>
    <!-- /.card-body -->
<?= $this->include('templates/footer') ?>
<script type="text/javascript">

    var Dtable;
    $(document).ready(function () {
        Dtable = $("#role_datatable").DataTable();
    });
    $('#role_datatable').on('click', '.role_edit', function () {

        var RowIndex = $(this).closest('tr');
         data = Dtable.row(RowIndex).data();
         window.location.href = BASE_URL+"/role/editrole/"+data[0]+"";

    });
    $('#role_datatable').on('click', '.role_delete', function () {
         // alert('test');
          var RowIndex = $(this).closest('tr');
          data_id = Dtable.row(RowIndex).data();
         alert(data_id[0]);
          jQuery.ajax({
          type: "POST",
          url: BASE_URL+"/role/delete/"+data_id[0],
          data : {id:data_id[0]},
          success: function(response) {
            if(response.status == true){
          alert("Deleted successfuly");
          window.location.reload(true);
          }
        }
       });
      });
</script>
<script type="text/javascript">
    var el = document.querySelector('.more');
    var btn = el.querySelector('.more-btn');
    var menu = el.querySelector('.more-menu');
    var visible = false;

    function showMenu(e) {
        e.preventDefault();
        if (!visible) {
            visible = true;
            el.classList.add('show-more-menu');
            menu.setAttribute('aria-hidden', false);
            document.addEventListener('mousedown', hideMenu, false);
        }
    }

    function hideMenu(e) {
        if (btn.contains(e.target)) {
            return;
        }
        if (visible) {
            visible = false;
            el.classList.remove('show-more-menu');
            menu.setAttribute('aria-hidden', true);
            document.removeEventListener('mousedown', hideMenu);
        }
    }

    btn.addEventListener('click', showMenu, false);
</script>
<?= $this->endSection() ?>
