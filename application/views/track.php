<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>RMTS</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">   
    <script src="https://use.fontawesome.com/77fb63d6cc.js"></script>
    <link rel="icon" href="<?php echo base_url('assets/mas_icon.png') ?>">
	
</head>
<body style="padding-top: 4.5rem;">	
		<nav class="navbar navbar-dark fixed-top navbar-expand-lg" style="background-color: #636e72;">
      		<a class="navbar-brand" href="<?php echo base_url() ?>"><img src="<?php echo base_url('assets/mas_icon.png') ?>" height="25" style="margin-bottom: 5px; padding-right: 10px;">Raw Material Tracking System</a>
      		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        	<span class="navbar-toggler-icon"></span>
      		</button>
      		<div class="collapse navbar-collapse" id="navbarCollapse">
        		<ul class="navbar-nav mr-auto">
        			
        		</ul>        		
        		<form class="form-inline mt-2 mt-md-0">
        			<button type="button" class="btn btn-info btn-sm" onclick="view_so()"><i class="fa fa-dropbox"></i> #SO</button>&nbsp;
        			<button type="button" class="btn btn-success btn-sm" onclick="view_bin()"><i class="fa fa-th-large"></i> BIN</button>&nbsp;
        			<button type="button" class="btn btn-primary btn-sm" onclick="view_log()"><i class="fa fa-database"></i> Log</button>&nbsp;
        			<?php if ($this->session->userdata('level')=="ADMIN") { ?>        				
        			<button type="button" class="btn btn-warning btn-sm text-white" onclick="view_user()"><i class="fa fa-user"></i> User</button>&nbsp;
        			<?php } ?>
        			<a href="<?php echo base_url('login/logout') ?>" class="btn btn-danger btn-sm"><i class="fa fa-power-off"></i></a>
        		</form>
      		</div>
    	</nav>
    	<main role="main" class="container">
      	<div class="row">
      		<div class="col-md-6 col-lg-6">
      			<h4>Tracking #SO</h4>
      			<div class="input-group mb-3">
					<input type="text" class="form-control form-control-lg" name="so" id="input_so" placeholder="Type #SO Number here">				  
				</div>       			
      		</div>
      		<div class="col-md-6 col-lg-6">
      			<!-- <form id="frm_so"> -->
				<h4>Tracking #Material Code</h4>
      			<div class="input-group mb-3">
					<input type="text" class="form-control form-control-lg" name="mcode" id="input_mcode" placeholder="Type #Material Code Number here">				  
				</div>      			
      		</div>      		
      	</div>

      	<hr>
      	<div class="row">
      		<div class="col-md-12 col-lg-12">
	  			<h4>BIN</h4>      	     
      		</div>
      	</div>
      	<div class="row">
      		<?php foreach ($bin as $data) { ?>      		
      		<div class="col-md-1" style="padding-bottom: 3px; padding-left: 3px; padding-right: 3px;">      			
			  	<button type="button" class="btn btn-primary btn-block" onclick="check_bin('<?php echo $data->id_bin ?>','<?php echo $data->bin_name ?>')"><h6><?php echo $data->bin_name ?></h6></button>				  
      		</div>
      		<?php } ?>
      	</div>
    	</main>
    <!-- Large modal -->	

	<div class="modal fade" tabindex="-1" role="dialog" id="bin-modal" aria-hidden="true">
	 	<div class="modal-dialog">
	    	<div class="modal-content">
	    		<div class="modal-header">
	    			<div class="modal-title"><h5>Add BIN</h5></div>
	    		</div> 
	    		<div class="modal-body">
	    			<div class="row">	    				
	    				<div class="col-md-12 col-lg-12">
			    			<?php echo form_open('track/add_bin', array('class' => 'form-inline form-bin')); ?>
			    				<label class="col-sm-3 col-form-label label-bin">Add New</label>								
							  	<div class="form-group mx-sm-3 mb-2">							    	
							    	<input type="text" name="bin" required="" class="form-control">
							  	</div>
							  	<button type="submit" class="btn btn-primary btn-sm mb-2 btn-add-bin">Add</button>
							<?php echo form_close(); ?>
			    			<hr>
			    			<table class="table table-sm table-bordered" id="example" style="font-size: 14px;">
			    				<thead>
			    					<tr>
			    						<!-- <th width="1%">No</th> -->
			    						<th>BIN</th>
			    						<th width="1%">#</th>			    						
			    					</tr>
			    				</thead>
			    				<tbody>
			    					<?php $no=1; foreach ($bin as $data) { ?>
			    					<tr>
			    						<!-- <td><?php echo $no++ ?></td> -->
			    						<td><?php echo $data->bin_name ?></td>
			    						<td><button type="button" class="btn btn-success btn-sm <?php echo 'editbin-'.$data->id_bin; ?>" onclick="edit('<?php echo $data->id_bin ?>')">Edit</button></td>
			    					</tr>
			    					<?php } ?>
			    				</tbody>
			    			</table>
	    					
	    				</div>
	    			</div>
	    		</div>
	    	</div>
	 	</div>
	</div>

	<div class="modal fade bd-example-modal-lg" id="so-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
	    <div class="modal-content">
    			<div class="modal-header">
	    			<div class="modal-title"><h5 class="label-so">Add #SO</h5></div>
	    		</div>
	    		<div class="modal-body">
	    			<div class="row">
	    				<div class="col-md-4 col-lg-4">
			    			<?php echo form_open('track/add_so', array('class' => 'form_so')); ?>
							  	<div class="form-group">
							    	<label for="exampleInputEmail1">#SO Number</label>
							    	<input type="text" class="form-control" name="so_number" required="" placeholder="#SO Number">					
							  	</div>
							  	<div class="form-group">
							    	<label for="exampleInputPassword1">BIN</label>					    	
							    	<select name="bin_so" class="form-control" required="">
							    	<option value="">Select Bin</option>				    		
							    	<?php foreach ($bin as $data) { ?> 
							    		<option value="<?php echo $data->id_bin ?>"><?php echo $data->bin_name ?></option>
							    	<?php } ?>
							    	</select>
							  	</div>	
							  	<div class="form-group">
							    	<label for="exampleInputEmail1">Material Code</label>
							    	<table class="table table-sm table-condensed">
							    		<tbody id="tablecode">
						    				
						    			</tbody>					    						    			
						    			<tr>
						    				<form id="frm_addcode">
						    				<td>
							    				<input type="text" class="form-control form-control-sm" name="code" placeholder="Material Code">
						    				</td>
						    				<td>
						    					<button type="button" class="btn btn-sm btn-success btn-add-code"><i class="fa fa-plus"></i></button>
						    				</td>
						    				</form>
						    			</tr>					    		
							    	</table>
							  	</div>				  	
								<button type="submit" class="btn btn-primary btn-sm btn-add-so">Add #SO</button>
							</form>	    					
	    				</div>
	    				<div class="col-md-8 col-lg-8">
			    		 	<table class="table table-sm table-bordered" id="example2" style="font-size: 14px;">
			    				<thead>
			    					<tr>
			    						<!-- <th width="1%">No</th> -->
			    						<th>SO#</th>
			    						<th>Bin</th>
			    						<th width="1%">#</th>			    						
			    					</tr>
			    				</thead>
			    				<tbody>
			    					<?php $no=1; foreach ($so as $data) { ?>
			    					<tr>
			    						<!-- <td><?php echo $no++ ?></td> -->
			    						<td><?php echo $data->so_number ?></td>
			    						<td><?php echo $data->bin_name ?></td>
			    						<td>
			    							<button type="button" class="btn btn-info btn-sm <?php echo 'editso-'.$data->id_so; ?>" onclick="edit_so('<?php echo $data->id_so ?>')">Edit</button>
			    							<a href="<?php echo base_url('track/delete_so/'.$data->id_so) ?>" onclick="return confirm('Are you sure ?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
			    						</td>
			    					</tr>
			    					<?php } ?>
			    				</tbody>
			    			</table>
	    				</div>
	    			</div>
	    		 </div> 
	    	</div>
	  </div>
	</div>

	<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="find_modal" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg">
	    <div class="modal-content">
	    	<div class="modal-body">
		      	<div class="row">		      		
		      		<div class="col-md-12 col-lg-12">
		      			<div class="alert alert-info">
		      				<strong class="title-find"></strong>
		      			</div>
		      			<div class="row">
		      				<div class="col-md-4 col-lg-4">
		      					<div class="card">
								  <div class="card-body bg-warning text-center text-white">
								    <h5 class="card-title">BIN Location</h5>
								    <h3 class="bin-loc"></h3>
								  </div>
								</div><br>
								<h6 class="text-center">Material Code</h6>
								<ul class="list-group mcode-list">
								  
								</ul>
		      				</div>
		      				<div class="col-md-8 col-lg-8">
		      					<button type="button" class="btn btn-secondary btn-move"><i class="fa fa-arrows"></i> Move</button>
		      					<a href='#' class="btn btn-secondary link-bpu"><i class="fa fa-sign-out"></i>Send to BPU</a><hr>
		      					<form class="form-inline form-move-bin"></form>
		      					<h6>History</h6>
		      					<ul class="list-group add-list">
								  
								</ul>
		      				</div>
		      			</div>
		      		</div>		      		
	      		</div>
	    		
	    	</div>
	    </div>
	  </div>
	</div>

	<div class="modal fade bd-example-modal-lg" id="check_binmodal" tabindex="-1" role="dialog" aria-labelledby="mylgallModalLabel" aria-hidden="true">
	  	<div class="modal-dialog modal-lg">
	    	<div class="modal-content text-center">
	      		<div class="modal-header"><h4 class="titlecheck"></h4></div>
	      		<div class="modal-body">
	      			<div class="row kolom-so"></div>
	      			<!-- <h5>#SO List</h5>
	      			<ul class="list-group list-check">
					</ul> -->
	      		</div>
	    	</div>
	  	</div>
	</div>

	<div class="modal fade bd-example-modal-lg" id="log-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
	    	<div class="modal-content">
	    		<div class="modal-header">
	    			<div class="modal-title"><h5><i class="fa fa-database"></i> Log Data</h5></div>
	    		</div> 
	    		<div class="modal-body">
	    			<table class="table table-sm table-bordered" id="example4" style="font-size: 12px;">
	    				<thead>
	    					<tr>
	    						<th>No</th>			    						
	    						<th>#SO</th>			    						
	    						<th>Last BIN</th>			    						
	    						<th>Date</th>			    						
	    						<th>Note</th>			    						
	    					</tr>
	    				</thead>
	    				<tbody>
	    					<?php $no=1; foreach ($log as $data) { ?>
	    					<tr>
	    						<td width="1%"><?php echo $no++ ?></td>
	    						<td><?php echo $data->so_number ?></td>
	    						<td><?php echo $data->bin_name ?></td>
	    						<td><?php echo $data->date ?></td>
	    						<td><?php echo $data->note ?></td>
	    					</tr>
	    					<?php } ?>
	    				</tbody>
	    			</table>
	    		</div>
	    	</div>
	 	</div>
	</div>

	<div class="modal fade" tabindex="-1" role="dialog" id="user-modal" aria-hidden="true">
	 	<div class="modal-dialog">
	    	<div class="modal-content">
	    		<div class="modal-header">
	    			<div class="modal-title"><h5><i class="fa fa-user"></i> Data User</h5></div>
	    		</div> 
	    		<div class="modal-body">
	    			<?php echo form_open('track/add_user'); ?>
	    				<div class="form-group row">
						    <label class="col-sm-3 col-form-label">EPF Number</label>
						    <div class="col-sm-9">
					    		<input type="text" class="form-control" name="epf" required="" placeholder="EPF Number">						
						    </div>
						 </div>
						 <div class="form-group row">
						    <label class="col-sm-3 col-form-label">Name</label>
						    <div class="col-sm-9">
						    	<input type="text" class="form-control" name="name" required="" placeholder="Employee Name">						
						    </div>
						 </div>
						 <div class="form-group row">
						    <label class="col-sm-3 col-form-label">Level</label>
						    <div class="col-sm-9">						    
						    	<select name="level" class="form-control" required="">
						    		<option value="STAFF">STAFF</option>
						    		<option value="ADMIN">ADMIN</option>					    		
						    	</select>					    		
						    </div>
						 </div>
						 <div class="form-group row">
						    <label class="col-sm-3 col-form-label"></label>
						    <div class="col-sm-2">						    
								<button type="submit" class="btn btn-primary btn-sm btn-add-so">Add User</button>						    	
						    </div>
						    <div class="col-sm-7">
						    	<i class="text-danger" style="font-size: 12px;">EPF Number has been default password.</i>
						    </div>					    
						 </div>					  	
					</form><hr>
					<table class="table table-sm table-bordered" id="example3">
	    				<thead>
	    					<tr>
	    						<th>EPF</th>			    						
	    						<th>Name</th>			    						
	    						<th>Level</th>			    						
	    						<th>#</th>			    						
	    					</tr>
	    				</thead>
	    				<tbody>
	    					<?php $no=1; foreach ($user as $data) { ?>
	    					<tr>
	    						<td><?php echo $data->epf ?></td>
	    						<td><?php echo $data->name ?></td>
	    						<td><?php echo $data->level ?></td>
	    						<td>
	    							<a href="<?php echo base_url('track/delete_user/'.$data->epf) ?>" onclick="return confirm('Are you sure ?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
	    						</td>
	    					</tr>
	    					<?php } ?>
	    				</tbody>
	    			</table>
	    		</div>
	    	</div>
	 	</div>
	</div>

	<div class="modal fade" tabindex="-1" role="dialog" id="find_mcode" aria-hidden="true">
	 	<div class="modal-dialog">
	    	<div class="modal-content">
	    		<div class="modal-header">
	    			<div class="modal-title"><h5 class="title-mcode"></h5></div>
	    		</div> 
	    		<div class="modal-body text-center">
	    			<div class="row html-mcode">
	    				
	    			</div>
	    		</div>
	    	</div>
	 	</div>
	</div>

	<div id="wait" style="display:none;width:auto;height:89px;position:absolute;top:50%;left:43%;padding:2px;"><img src='<?php echo base_url() ?>assets/ring.gif'/></div>	

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>    	
	<script>		
			view_code();
	    	function view_code() {
		        $.ajax({
		            url : "<?php echo site_url('index.php/track/view_code')?>/",
		            type: "GET",
		            dataType: "JSON",
		            success: function(data){
		                var html = '';
		                var i;
		                var no = 1;
		                for(i=0; i<data.length; i++){   
		                	html += '<tr>' +
									'<td>'+data[i].code+'</td>' +
									'<td><button type="button" class="btn btn-sm btn-danger" onclick="del_code(\''+data[i].id_code+'\')"><i class="fa fa-trash"></i></button></td>' +									
									'</tr>';	                 	                    
		                }
		                $('#tablecode').html(html);              
		            },
		            error: function (jqXHR, textStatus, errorThrown){
		                alert('Error get data from ajax');
		              }
		        });
	    	}

	    	function view_code_edit(id) {
	    		$.ajax({
		            url : "<?php echo site_url('index.php/track/view_code_edit')?>/"+id,
		            type: "GET",
		            dataType: "JSON",
		            success: function(data){
		                $('#tablecode').html('');              
		                var html = '';
		                var i;
		                var no = 1;
		                for(i=0; i<data.length; i++){   
		                	html += '<tr>' +
									'<td>'+data[i].code+'</td>' +
									'<td><button type="button" class="btn btn-sm btn-danger" onclick="del_code_edit(\''+data[i].id_code+'\',\''+data[i].id_so+'\')"><i class="fa fa-trash"></i></button></td>' +									
									'</tr>';	                 	                    
		                }
		                $('#tablecode').html(html);              
		            },
		            error: function (jqXHR, textStatus, errorThrown){
		                alert('Error get data from ajax');
		              }
		        });
	    	}

	    	function add_code(){  
				var code = $('[name="code"]').val();
				if (code == "") {
					alert('Please fill material code !')
				}else{
					$.ajax({
			            url : '<?php echo base_url('track/add_code/') ?>',
			            type: "POST",
			            data: {code:code},
			            dataType: "JSON",
			            success: function(data)
			            {	
			            	$('[name="code"]').val('');
			            	view_code();
			            },
			            error: function (jqXHR, textStatus, errorThrown)
			            {
			                alert('Error adding / update data');
			            }
			        });

				}
		    }	

		    function edit_code(id){  
				var code = $('[name="code"]').val();
				if (code == "") {
					alert('Please fill material code !')
				}else{
					$.ajax({
			            url : '<?php echo base_url('track/add_code_edit/') ?>'+id,
			            type: "POST",
			            data: {code:code},
			            dataType: "JSON",
			            success: function(data)
			            {	
			            	$('[name="code"]').val('');
			            	view_code_edit(id);
			            },
			            error: function (jqXHR, textStatus, errorThrown)
			            {
			                alert('Error adding / update data');
			            }
			        });

				}
		    }	

		    function del_code(id) {
		    	$.ajax({
	            url : "<?php echo site_url('index.php/track/del_code')?>/"+id,
	            type: "GET",
	            dataType: "JSON",
	            success: function(data){
	            	view_code();
	            },
	            	error: function (jqXHR, textStatus, errorThrown){
	                	alert('Error get data from ajax');
	             	}
	        	});		
		    }	

		    function del_code_edit(id,id_so) {
		    	$.ajax({
	            url : "<?php echo site_url('index.php/track/del_code')?>/"+id,
	            type: "GET",
	            dataType: "JSON",
	            success: function(data){
	            	view_code_edit(id_so);
	            },
	            	error: function (jqXHR, textStatus, errorThrown){
	                	alert('Error get data from ajax');
	             	}
	        	});		
		    }	

		$(document).ajaxStart(function(){
        $("#wait").css("display", "block");
	    });
	    $(document).ajaxComplete(function(){
	        $("#wait").css("display", "none");
	    });
      	$('#example').DataTable();
      	$('#example2').DataTable({
  			"pageLength": 25
		});
      	$('#example3').DataTable();
      	$('#example4').DataTable({
  			"pageLength": 25
		});

		function view_so() {
			$('.btn-add-code').attr('onclick','add_code()');
			$('#so-modal').modal('show');
		}

		function view_bin() {
			$('#bin-modal').modal('show');			
		}
		
		function reset(id) {
			$('.label-bin').text('Add New');
			$('.form-bin').attr("action","<?php echo base_url('track/add_bin') ?>");
			$('.editbin-'+id).removeClass('btn-danger');
			$('.editbin-'+id).addClass('btn-success');
			$('.editbin-'+id).attr("onclick","edit('"+id+"')");			
			$('.editbin-'+id).text('Edit');
			$('.btn-add-bin').text('Add');            	
			$('.form-bin')[0].reset();
		}

		function edit(id) {
			$.ajax({
            url : "<?php echo site_url('index.php/track/get_bin')?>/"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
            	$('[name="bin"]').val(data.bin_name);
				$('.label-bin').text('Edit BIN');
				$('.form-bin').attr("action","<?php echo base_url('track/edit_bin/') ?>"+id);
				$('.editbin-'+id).removeClass('btn-success');
				$('.editbin-'+id).addClass('btn-danger');
				$('.editbin-'+id).attr("onclick","reset('"+id+"')");			
				$('.editbin-'+id).text('Cancel');            	
				$('.btn-add-bin').text('Edit');            	
            },
            	error: function (jqXHR, textStatus, errorThrown){
                	alert('Error get data from ajax');
             	}
        	});

		}

		function edit_so(id) {
			$.ajax({
            url : "<?php echo site_url('index.php/track/get_so')?>/"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
            	$('[name="so_number"]').val(data.so_number);
            	$('[name="bin_so"]').val(data.id_bin);
            	$('[name="bin_so"]').trigger('change');
            	$('[name="bin_so"]').removeAttr('required');
            	$('[name="bin_so"]').attr('disabled','disabled');
				$('.label-so').text('Edit #SO Number '+data.so_number);
				$('.form_so').attr("action","<?php echo base_url('track/edit_so/') ?>"+id);
				$('.editso-'+id).removeClass('btn-success');
				$('.editso-'+id).addClass('btn-danger');
				$('.editso-'+id).attr("onclick","reset_so('"+id+"')");			
				$('.editso-'+id).text('Cancel');            	
				$('.btn-add-so').text('Edit #SO');     
				$('.btn-add-code').attr('onclick','edit_code(\''+id+'\')');
				view_code_edit(id);
            },
            	error: function (jqXHR, textStatus, errorThrown){
                	alert('Error get data from ajax');
             	}
        	});        	 

		}

		function reset_so(id) {
			$('.label-so').text('Add #SO');
			$('[name="bin_so"]').attr('required','required');
        	$('[name="bin_so"]').removeAttr('disabled');
			$('.form_so').attr("action","<?php echo base_url('track/add_so') ?>");
			$('.editso-'+id).removeClass('btn-danger');
			$('.editso-'+id).addClass('btn-success');
			$('.editso-'+id).attr("onclick","edit_so('"+id+"')");			
			$('.editso-'+id).text('Edit');
			$('.btn-add-so').text('Add #SO');            	
			$('.form_so')[0].reset();
            $('#tablecode').html('');              
			view_code();			
		}

		var input_so = document.getElementById("input_so");
		input_so.addEventListener("keydown", function (e) {
		    if (e.keyCode === 13) {  //checks whether the pressed key is "Enter"
		        cari(e);
		    }
		});	

		var input_mcode = document.getElementById("input_mcode");
		input_mcode.addEventListener("keydown", function (e) {
		    if (e.keyCode === 13) {  //checks whether the pressed key is "Enter"
		        cari_mcode(e);
		    }
		});	


		function cari(e) {
    		var id_so = e.target.value;			
			$.ajax({
	            url : '<?php echo base_url('track/find_so/') ?>'+id_so,
	            type: "GET",
	            // data: $('#frm_so').serialize(),
	            dataType: "JSON",
	            success: function(data)
	            {
	            	if (data == false) {
	            		alert('#SO Number not found');
	            	}else{
		            	$('#input_so').val('');
		            	$('.title-find').text('Tracking SO# '+data.so_number);
		            	if (data.status == 1) {
		            		$('.bin-loc').text(data.bin_name);
		            		$('.btn-move').attr("onclick","move('"+data.id_so+"')");		            	
		            		$(".link-bpu").attr("href","<?php echo base_url('track/sent_bpu/') ?>"+data.id_so);           			            	
		            		$(".link-bpu").attr("onclick","return confirm('Are you sure ?')");           			            	
		            	}else{
		            		$('.bin-loc').html('<i class="fa fa-sign-in"></i> BPU');		            		
		            	}
				  		$('.form-move-bin').html('');		        			            	
		            	$('#find_modal').modal('show');	 
									            
	            	}	                           
	            },
	            error: function (jqXHR, textStatus, errorThrown)
	            {
	                alert('Error adding / update data');
	            }
	        });

			$.ajax({
	            url : '<?php echo base_url('track/get_history/') ?>'+id_so,
	            type: "GET",
	            // data: $('#frm_so').serialize(),
	            dataType: "JSON",
	            success: function(data)
	            {
	            	// console.log(data);
	            	var html = '';
	                var i;	                
	                for(i=0; i<data.length; i++){   
	                    html += '<li class="list-group-item d-flex justify-content-between align-items-center list-group-item-success">'+data[i].note+
	                    	'<span class="badge badge-info badge-pill text-right">'+data[i].date+'</span>'+	                    	
	                    	'</li>';	                        
	                }
	                $('.add-list').html(html);
	            },
	            error: function (jqXHR, textStatus, errorThrown)
	            {
	                // alert('Error adding / update data');
	            }
	        });

	        $.ajax({
	            url : '<?php echo base_url('track/mcode_list/') ?>'+id_so,
	            type: "GET",
	            // data: $('#frm_so').serialize(),
	            dataType: "JSON",
	            success: function(data)
	            {
	            	// console.log(data);
	            	var html = '';
	                var i;	                
	                for(i=0; i<data.length; i++){   
	                    html += '<li class="list-group-item d-flex justify-content-between align-items-center list-group-item-info">'+data[i].code+
	                    	'</li>';	                        
	                }
	                $('.mcode-list').html(html);
	            },
	            error: function (jqXHR, textStatus, errorThrown)
	            {
	                // alert('Error adding / update data');
	            }
	        });

		}

		function cari_mcode(e) {
    		var mcode = e.target.value;			
			$.ajax({
	            url : '<?php echo base_url('track/find_mcode/') ?>'+mcode,
	            type: "GET",
	            // data: $('#frm_so').serialize(),
	            dataType: "JSON",
	            success: function(data)
	            {
	            	if (data == false) {
	            		alert('#SO Number not found');
	            	}else{
	            		console.log(data);
	            		var html = '';
	            		for(var get of data){   
	                		html += '<div class="col-md-6 col-lg-6" style="padding-bottom: 8px;">'+
	      								'<div class="card">'+
							  				'<div class="card-body bg-info text-center text-white">'+
										    '<h5 class="card-title">BIN Location</h5>';
							  	if(get.status == "1"){
										html += '<h2 class="bin-loc-mcode">'+get.bin_name+'</h2><hr style="background-color: white;">';							  	
							  	}else{
										html += '<h2 class="bin-loc-mcode">BPU</h2><hr style="background-color: white;">';
							  	}
									html += '#SO Number'+
										    '<h3 class="so-mcode">'+get.so_number+'</h3>'+
										  '</div>'+
										'</div>'+							
				      				'</div>';
						}
						$('.html-mcode').html(html);
	            		// if (data.status == 1) {
	            		// 	$('.bin-loc-mcode').text(data.bin_name);	            				            				            		
		            	// }else{
	            		// 	$('.bin-loc-mcode').html('<i class="fa fa-sign-in"></i> BPU');	            				            		
		            	// }
	            		// $('.so-mcode').text(data.so_number);	            		
	            		$('.title-mcode').text('Material Code '+mcode);
	            		$('#input_mcode').val('');
	            		$('#find_mcode').modal('show');
	            	}
	            },
	            error: function (jqXHR, textStatus, errorThrown)
	            {
	                alert('Error adding / update data');
	            }
	        });
		}

		function move(id) {
			$.ajax({
		        url : "<?php echo site_url('index.php/track/get_binfree')?>/" + id,
		        type: "GET",
		        dataType: "JSON",
		        success: function(data)
		        {
				  	$('.form-move-bin').html('');		        	
	            	var html = '';
	            	var i;	
				 	html += '<label class="control-label mb-2 mr-sm-2" for="inlineFormInputName2">Move to BIN</label>'+
				  			'<select name="bin_move" class="form-control mb-2 mr-sm-2">';
	                for(i=0; i<data.length; i++){   
				  		html += '<option value="'+data[i].id_bin+'">'+data[i].bin_name+'</option>'
				  	}				  	
				  	html += '</select><button type="button" onclick="submit_move(\''+id+'\')" class="btn btn-primary mb-2">Submit</button>';				  			
				  	$('.form-move-bin').html(html);
		        },
		        error: function (jqXHR, textStatus, errorThrown)
		        {
		            alert('Error get data from ajax');
		        }
		    });	            
		}

		function submit_move(id) {
			$.ajax({
	            url : '<?php echo base_url('track/move_bin/') ?>'+id,
	            type: "POST",
	            data: $('.form-move-bin').serialize(),
	            dataType: "JSON",
	            success: function(data)
	            {	
	            	location.reload();
	            },
	            error: function (jqXHR, textStatus, errorThrown)
	            {
	                alert('Error adding / update data');
	            }
	        });
		}

		function check_bin(id,bin_name) {
			$.ajax({
	            url : '<?php echo base_url('track/get_insidebin/') ?>'+id,
	            type: "GET",
	            // data: $('#frm_so').serialize(),
	            dataType: "JSON",
	            success: function(data)
	            {
	            	// console.log(data);
	            	$('.titlecheck').text('BIN '+bin_name);
	            	var html = '';
	                var i;	
	                var x;	
	                for(i=0; i<data.length; i++){   
			  
	                    // html += '<li class="list-group-item list-group-item-primary">'+data[i].so_number+'</li>';
	                    html += '<div class="col-md-4 col-lg-4">'+
	      					'<div class="card">'+
							  '<div class="card-header">#SO '+data[i].so_number+							  	
							  '</div>'+
							  '<div class="card-body">'+
							  	'<ul class="list-group list-check">';
	                	for(var material of data[i].material){   
	                		html += '<li class="list-group-item list-group-item-primary">'+material.code+'</li>' 
						}
						html+=	  '</ul>'+
								'</div>'+
							'</div>'+
	      				'</div>';
	                }
	                $('.kolom-so').html(html);
	            },
	            error: function (jqXHR, textStatus, errorThrown)
	            {
	                alert('Error adding / update data');
	            }
	        });
			$('#check_binmodal').modal('show');
		}		

		function view_log() {
			$('#log-modal').modal('show');
		}

		function view_user() {
			$('#user-modal').modal('show');
		}



	</script>
</body>
</html>