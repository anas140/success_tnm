<!DOCTYPE html>
<html lang="en">

<head>
    <title>Success Valley</title>
    <?php require_once('includes/common-css.php');?>
    <script src="https://cdn.ckeditor.com/4.9.2/basic/ckeditor.js"></script>
</head>

<body>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="loader-track">
            <div class="preloader-wrapper">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                
                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                
                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
              <!----header start------->
           <?php require_once('includes/header.php');?>
			<!--header ending-->

            <!-- Sidebar inner chat end-->
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
				  <!--start left sidebar-->
                 <?php require_once('includes/left-sidebar.php');?>
					<!---left side bar---->
                    <div class="pcoded-content">
                        <!-- Page-header start -->
                        <div class="page-header">
                            <div class="page-block">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <div class="page-header-title">
                                            <h5 class="m-b-10">Course</h5>
                                            <p class="m-b-0" style="opacity:0">Lorem Ipsum is simply dummy text of the printing</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <!--<ul class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="index.html"> <i class="fa fa-home"></i> </a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#!">Ready To Use</a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#!">Job Application Form</a>
                                            </li>
                                        </ul>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Page-header end -->
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page body start -->
                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <!-- Job application card start -->
                                                <div class="card">
                                                    <div class="card-header">
													<?php
                                                      if($this->session->flashdata('message')){ ?>
        <div class="alert alert-info alert-dismissible no-border fade in mb-2 alert-success" role="alert" style="background-color:#448aff !important;opacity:1;color:#fff;height:">
													 <h4><?php
                                                       echo $this->session->flashdata('message');?></h4>
                                                      
                                                       </div>

                                                    <?php
													  }
            if(!empty($single_course[0]))
                             {
                             
                echo '<h4 class="box-title" style="color:#448aff";>Edit Course</h4>';
                
                }
                else
                {
                     echo '<h4 class="box-title" style="color:#448aff";>Add Course</h4>';
                }
            ?>
                                                        <span></span>
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="j-wrapper ">
<?php if(!empty($single_course[0])): ?>
    <form action="<?php echo base_url('admin/home/course_edit/'.$single_course[0]->course_id); ?>" method="post" class="j-pro" id="j-pro" enctype="multipart/form-data" >
<?php else: ?>
	<form action="<?php echo base_url('admin/home/add_course'); ?>" method="post" class="j-pro" id="j-pro" enctype="multipart/form-data" novalidate>
<?php endif; ?>
    <!-- end /.header-->
        <div class="j-content">
            <!-- start name -->
            <div class="j-row">
                <div class="j-span6 j-unit">
                    <div class="j-input">
                        <input type="text" id="course_name" name="course_name" placeholder="Course Name" value="<?php echo @$single_course[0]->course_name ?>">
						<span class="j-tooltip j-tooltip-right-top">Course Name</span>
                    </div>
                </div>
				<div class="j-span6 j-unit">
                    <div class="j-input j-append-small-btn">
                        <div class="j-file-button">
                            Browse
                            <input type="file" name="course_image" onchange="document.getElementById('file1_input').value = this.value;">
                        </div>
                        <input type="text" id="file1_input" readonly="" placeholder="Add Course Image">
						<?php if(!empty($single_course[0])): ?>
                            <img  src="<?php echo base_url();?>uploads/course/<?php echo  $single_course[0]->course_image; ?>" width="100" height="100">
                        <?php endif; ?>
                        <input type="hidden" name="temp_img" value="<?php echo @$single_course[0]->course_image; ?>">
                        <?php echo form_error('course_image','<p class="help-block error_msg">','</p>'); ?>
                        <span class="j-tooltip j-tooltip-right-top">Course Image</span>
                    </div>
                </div>
			</div>
			<div class="j-row">
			    <div class="j-span6 j-unit">
                    <div class="j-input">
                        <input type="text" id="course_duration" name="course_duration" placeholder="Course Duration" value="<?php echo @$single_course[0]->course_duration ?>">
						<span class="j-tooltip j-tooltip-right-top">Course Duration</span>
                    </div>
                </div>
				<div class="j-span6 j-unit">
				    <div class="j-input">
					    <select  name="course_language[]" class="category select2" id="category" multiple style="width:100px !important;height:100px;" data-placeholder="Select Language" >
						    <option val="" disabled>Select Language</option>
                            <?php foreach ($language as $key=>$value): ?>
                                <option value="<?= $value->language_id ?>"><?= $value->language_name ?></option>
                            <?php endforeach; ?>
						</select>
                    </div>
                </div>
            </div>
			<div class="j-row">
			    <div class="j-span6 j-unit">
                    <div class="j-input">
                        <input type="text" id="course_rate" name="course_rate" placeholder="Course Rate" value="<?php echo @$single_course[0]->course_rate ?>">
						<span class="j-tooltip j-tooltip-right-top">Course Rate</span>
                    </div>
                </div>
				<div class="j-span6 j-unit">
                    <div class="j-input">
                        <input type="text" id="renewal_rate" name="renewal_rate" placeholder="Renewal Rate" value="<?php echo @$single_course[0]->course_renewal_rate ?>">
                        <span class="j-tooltip j-tooltip-right-top">Renewal Rate</span>
                    </div>
                </div>
				<div class="j-span6 j-unit">
                    <div class="j-input">
                        <h4 class="sub-title">Course Description</h4>
                        <textarea type="text" id="editor1" name="course_description" placeholder="Course Description"><?php echo @$single_course[0]->course_description ?></textarea>
                        <span class="j-tooltip j-tooltip-right-top">Course Description</span>
                    </div>
                </div>
			    <div class="j-span6 j-unit">
                    <div class="form-radio">
                        <div class="radio radiofill radio-primary radio-inline">
						    <label>Top Course</label>
                            <label>
                                <input type="radio" name="top_course" value="1" data-bv-field="member" <?php if(@$single_course[0]->course_top_status=="1"){ echo "checked";}?>>
                                <i class="helper"></i>Yes
                            </label>
                        </div>
                        <div class="radio radiofill radio-primary radio-inline">
                            <label>
                                <input type="radio" name="top_course" value="0" data-bv-field="member" <?php if(@$single_course[0]->course_top_status=="0"){ echo "checked";}?>>
                                <i class="helper"></i>No
                            </label>
                        </div>
                    </div>
                </div>
			</div>
            <div class="divider gap-bottom-25"></div>
            <!-- start country -->
            <!-- start response from server -->
            <div class="j-response"></div>
            <!-- end response from server -->
        </div>
        <!-- end /.content -->
        
        <div class="j-footer">
            <?php if(!empty($single_course[0])): ?>
                <button type="submit" class="btn btn-primary">Update</button>
            <?php else: ?>
                <button type="submit" class="btn btn-primary">Next</button>
            <?php endif; ?>
            <button type="reset" class="btn btn-default m-r-20">cancel</button>
        </div>
        <!-- end /.footer -->

    </form>
    <br/>
    <hr>
    <!--<?php if(empty($single_course[0])): ?>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#why-this-program">Why This Program</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">What You will  learn</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Course Information</a>
                </li>       
            </ul>                
    <?php endif; ?> 

    <div class="tab-content">
        <div class="tab-pan active container" id="why-this-program">
            <form action="<?= base_url('admin/home/addCourse') ?>" method="post" enctype="multipart/form-data">
                <h3>Sections</h3>
                <div class="row">
                    <div class="col-md-10">
                        <textarea name="why_this[]" id="" cols="30" rows="10" id="editorSection"></textarea>
                        <input type="file" name="image[]" id="">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-10">
                        <button class="btn btn-primary btn-block ">Add More Section</button>
                    </div>
                </div>
            </form>
        </div>
    </div> -->
	
</div>
</div>
</div>
<!-- Job application card end -->
</div>
</div>
</div>
<!-- Page body end -->
</div>
</div>
</div>
<!-- Page-header end -->

<div class="pcoded-inner-content">
    <!-- Main-body start -->
    <div class="main-body">
        <div class="page-wrapper">
            <!-- Page-body start -->
            <div class="page-body">
                <div class="row" style="margin-top: -74px;">
                    <div class="col-sm-12">
                        <!-- Multi-column table start -->
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="box-title" style="color:#448aff";>View Courses</h4>
                                    <span></span>
                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="multi-colum-dt" class="table table-striped table-bordered nowrap">
                                        <thead>
                                            <tr>
                                                <th>#</th>
												<th>Name</th> 
												<th>Image</th>                      
												<th>Rate</th>
												<th>Renewal Rate</th>
												<!--<th>Description</th>-->
												<th>Language</th>
												<th>Status</th>
												<th>Action</th>					  
                                            </tr>
                                        </thead>
                                    <tbody>
								        <?php 
                                            if (!empty($all_course)) {
                                                $i=0;
                                                foreach($all_course as $post){
                                                    $i++;
                                                    if($post->course_status=='0')
                                                    {
                                                        $status_type="success";
                                                        $status_state="checked";
                                                    }
                                                    elseif($post->course_status=='1')
                                                    {
                                                        $status_type="info";
                                                        $status_state="";
                                                    }
                                        ?>
										<tr>
											<td><?php echo $i;?></td>
                                            <td><?php echo $post->course_name;?></td>
											<td><img style="width:100px;height:100px;" src="<?php echo base_url();?>uploads/course/<?php echo $post->course_image;?>"></td>
											<td><?php echo $post->course_rate;?></td>
											<td><?php echo $post->course_renewal_rate;?></td>
											<td><?php echo $post->language_name;?></td>
											<td>  <input name="status-change" id="status_change" data-status="<?php echo $post->course_status;?>" data-id=<?php echo $post->course_id;?> type="checkbox" data-size="small" data-on-color="success" data-off-color="warning" data-on-text="ON" data-off-text="OFF" <?php echo $status_state?> /> </td>
											<td>
                                                <a  href="<?php echo base_url();?>admin/course/course_edit/<?php echo $post->course_id;?>"><img src="<?php echo base_url();?>assets/images/pencil.png"></a>
												<a data-toggle="modal" href="#Delete_Log" class="delete_option " data-id="<?php echo $post->course_id;?>">
                                                    <img src="<?php echo base_url(); ?>assets/images/delete.png">
                                                </a>
											</td>
										</tr>
																   
										<?php
                                     }
                                }
                            ?>
                                    </tbody>
                                </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Multi-column table end -->
                                             
                                     
                                 
                                      
                                       
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Page-body end -->
                                </div>
                            </div>
                            <!-- Main-body end -->
                           
                        </div>
                    </div>
                    <!-- Main-body end -->
                    
                    <!--<div id="styleSelector">
                        
                    </div>-->
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- course delete confirmation modal -->
      <div class="modal fade" id="Delete_Log" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="z-index: 10000 !important;">
    <div class="modal-content">
      <div class="modal-header">
     
        <h4 class="modal-title" id="myModalLabel">Delete Course</span> ?</h4>
      </div>
      <div class="modal-body">
        Do you want to delete selected Course ?<br/>
        This Process cannot be Rolled Back
      </div>
        <form name="frm_delete_sale" id="frm_delete_sale" action="<?php echo base_url(); ?>admin/home/course_delete/" method="POST">
          <input type="hidden" name="course_id" id="course_id" value=""/>
          <div class="modal-footer">
            <button type="submit" name="btn_delete_course" id="btn_delete_course" value="Delete" class="btn btn-danger btn-flat">Delete</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </form>
    </div>
  </div>
</div>

<!-- ////////////////////////////////////////////////////////////////////////////-->


<?php require_once('includes/common-js.php');?>
<!-- status change-->
<script type="text/javascript">
$(document).ready(function()
{
  $("[name='status-change']").bootstrapSwitch();
  $('input[name="status-change"]').on('switchChange.bootstrapSwitch', function(event, state) {
  var this_=$(this);
  var id=$(this).data('id');
  var status=$(this).data('status');

  $.ajax({
    type: 'POST',
    url: '<?php echo base_url('index.php/admin/home/course_status/'); ?>',
    beforeSend: function(){$('input[name="status-change"]').bootstrapSwitch('toggleDisabled', true, true);},
    //complete: function(){},
    data: {id: id,status: status},
    success: function(html)
    {
        $('input[name="status-change"]').bootstrapSwitch('toggleDisabled', false, false);
    }
    });
  });

});

</script>
<script src="<?php echo base_url();?>assets/js/select2.full.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/select2/select2.min.css">
<script>
$('.delete_option').click(function()
{
$('#course_id').val($(this).data('id'));
});
</script>
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
    CKEDITOR.replace('editor1');
  });
</script>
<script>
$(function() {
setTimeout(function() {
    $(".alert-success").hide('blind', {}, 1000)
}, 1000);
});

    CKEDITOR.replace('why_this[]');
</script>
</body>

</html>
