<!DOCTYPE html>
<html lang="en">
<head>
    <title>Success Valley</title>
    <?php require_once('includes/common-css.php');?>
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
                                            <h5 class="m-b-10">Course Module</h5>
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
              <h4 class="box-title" style="color:#448aff";>Add Course Module</h4>
              <span></span>
            </div>
                <div class="card-block">
                    <div class="j-wrapper ">
						<form action="<?php echo base_url('admin/home/add_module'); ?>" method="post" class="j-pro" id="j-pro" enctype="multipart/form-data" novalidate>
                            <div class="j-content">
                                <div class="j-row">
                                    <div class="j-span6 j-unit">
                                        <div class="j-input">
                                            <select name="course_name" class="form-control" id="course_name">
                                                <option value="">Select Course</option>
                                                <?php foreach ($courses as $course): ?>
                                                    <option value="<?= $course['course_id'] ?>"><?= $course['course_name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
											<span class="j-tooltip j-tooltip-right-top">Select Course</span>
                                        </div>
                                    </div>
								</div>
								<div class="j-row wrappers" id="add_module_form">
									<div class="j-span3 j-unit">
                                        <div class="j-input">
                                            <input type="text" id="course_module" name="course_module" placeholder="Module 1" value="<?php echo @$profile[0]->profile_title ?>">
											<span class="j-tooltip j-tooltip-right-top">Module1</span>
                                        </div>
                                    </div>
									<div class="j-span3 j-unit">
                                        <div class="j-input j-append-small-btn">
                                            <div class="j-file-button">
                                                Browse
                                                <input type="file" name="course_pdf" onchange="document.getElementById('file1_input').value = this.value;">
                                            </div>
                                            <input type="text" id="file1_input" readonly="" placeholder="Add Course Pdf">
											<?php if(!empty($package[0])){?>
                                                <img  src="<?php echo base_url();?>uploads/package/<?php echo  $package[0]->package_image; ?>" width="100" height="100">
                                            <?php } ?>
                                                <input type="hidden" name="temp_img" value="<?php echo @$package[0]->package_image; ?>">
                                            <?php echo form_error('package_image','<p class="help-block error_msg">','</p>'); ?>
                                            <span class="j-tooltip j-tooltip-right-top">Course Pdf</span>
                                        </div>
                                    </div>
									<div class="j-row">
										<div class="j-span3 j-unit">
                                            <div class="j-input">
                                                <input type="text" id="course_vdo_url" name="course_vdo_url" placeholder="Youtube Url" value="<?php echo @$profile[0]->profile_title ?>">
												<span class="j-tooltip j-tooltip-right-top">Youtube Video Url</span>
                                            </div>
                                        </div>
										<div class="col-md-2">
                                            <div class="form-group">
                                            <a href="javascript:void(0);" class="add_button" title="Add field" style="margin-top: 26px;float: left;">Add More Module</a>
                                        </div>
                                    </div>
								</div>
                                <!-- end name -->
                                <div class="divider gap-bottom-25"></div>
                                                                    <!-- start country -->
                                                                    <!-- start files -->
                                                                   
                                                                    <!-- end files -->
                                                                    <!-- start response from server -->
                                                                    <div class="j-response"></div>
                                                                    <!-- end response from server -->
                                                                </div>
                                                                <!-- end /.content -->
                                                                <div class="j-footer">
                                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                                    <button type="reset" class="btn btn-default m-r-20">cancel</button>
                                                                </div>
                                                                <!-- end /.footer -->
                                                            </form>
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
                                                       <h4 class="box-title" style="color:#448aff";>View Course Modules</h4>
                                                        <span></span>
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="dt-responsive table-responsive">
                                                            <table id="multi-colum-dt" class="table table-striped table-bordered nowrap">
                                                                <thead>
                                                                    <tr>
                                                                    <th>#</th>
																	<th>Title</th> 
                                                                    <th>Course</th>
																	<th>Language</th>                      
																	<th>Date</th>
																	<th>Status</th>
																	<th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
																 <?php 
                    if (!empty($all_faq)) {
                        $i=0;
                        foreach($all_faq as $post){
                            $i++;
                            if($post->faq_status=='0')
                            {
                                $status_type="success";
                                $status_state="checked";
                            }
                            elseif($post->faq_status=='1')
                            {
                                $status_type="info";
                                $status_state="";
                            }
                    ?>
																<tr>
																<td><?php echo $i;?></td>
                                                                   <td><?php echo $post->faq_title;?></td> 
                                                                   <td><?php echo $post->faq_description;?></td>
																   <td><?php echo $post->faq_addedon;?></td>
																   <td>  <input name="status-change" id="status_change" data-status="<?php echo $post->faq_status;?>" data-id=<?php echo $post->faq_id;?> type="checkbox" data-size="small" data-on-color="success" data-off-color="warning" data-on-text="ON" data-off-text="OFF" <?php echo $status_state?> /> </td>
																   <td><?php echo anchor('admin/home/faq_edit/' .$post->faq_id, 'edit'); ?>
																    <a data-toggle="modal" href="#Delete_Log" class="delete_option " data-id="<?php echo $post->faq_id;?>">delete</a>
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
<!-- faq delete confirmation modal -->
<div class="modal fade" id="Delete_Log" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="z-index: 10000 !important;">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Delete Faq</span> ?</h4>
      </div>
      <div class="modal-body">
        Do you want to delete selected Faq ?<br/>
        This Process cannot be Rolled Back
      </div>
        <form name="frm_delete_sale" id="frm_delete_sale" action="<?php echo base_url(); ?>admin/home/faq_delete/" method="POST">
          <input type="hidden" name="faq_id" id="faq_id" value=""/>
          <div class="modal-footer">
            <button type="submit" name="btn_delete_faq" id="btn_delete_faq" value="Delete" class="btn btn-danger btn-flat">Delete</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </form>
    </div>
  </div>
</div>

<!-- ////////////////////////////////////////////////////////////////////////////-->


<?php require_once('includes/common-js.php');?>
<!---add more branch------>
<script src="<?= base_url().'assets/js/admin/course.js' ?>"></script>
<script type="text/javascript">

    $(document).ready(function(){
        $('.add_button').click(function() {
            //alert("hai");
            var maxField = 10;
            var x = 1;

            $.ajax({
               type: "POST",
               url: "add_branch",
               success: function(html) 
               {
                   var response=JSON.parse(html);  
                   $('.wrappers').append(response['fieldHTML']);
               }
            });
            
        }); 

    });
</script>
<!---close add more branch-->
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
    url: '<?php echo base_url('index.php/admin/home/faq_status/'); ?>',
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
</script>
<script src="<?php echo base_url();?>assets/js/select2.full.min.js"></script>
<script>
$('.delete_option').click(function()
{
$('#faq_id').val($(this).data('id'));
});
</script>
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
    CKEDITOR.replace('editor1');
  });

    $("body").on('click','.addSubModule', function() {
        div = $(this).parents('.module-form');
           let html = "";
           html += `
                <div id="sub-module-form" style='margin-left: 10px'>
                    <div class="j-span3 j-unit">
                    <div class="j-input">
                        <input type="hidden" name="course" value="'.$result['course_id'].'">
                        <input type="hidden" name="module_language[]" value="' .$languages[$i].'">
                        <input type="text" class="module_name_value" id="" name="course_module[0][sub_module_title][]" value="" placeholder="Module Name">
                        <span class="j-tooltip j-tooltip-right-top">Module1</span>
                    </div>
                </div>
                <div class="j-span3 j-unit">
                    <div class="j-input j-append-small-btn">
                        <div class="j-file-button">
                            Browse
                            <input type="file" name="course_module[0][sub_module_pdf][]">
                        </div>
                        <input type="text" id=" name="course_module[0][sub_module_pdf][]" readonly="" placeholder="Add Course Pdf">
                    </div>
                </div>
                <div class="j-row">
                    <div class="j-span3 j-unit">
                        <div class="j-input">
                            <input type="text" id="module_video_url[]" name="course_module[0][sub_module_url][]" placeholder="Youtube Url" value="">
                            <span class="j-tooltip j-tooltip-right-top">Youtube Video Url</span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <a href="javascript:void(0);" class="add_button" title="Add field" style="margin-top: 26px;float: left;"></a>
                        </div>
                    </div>
                </div>

                <!-- end name -->
                <div class="divider gap-bottom-25"></div>
                    <div class="j-response"></div>
                    <!-- end response from server -->
                </div>
                `;
            $(div).append(html);
         });
</script>

</html>
