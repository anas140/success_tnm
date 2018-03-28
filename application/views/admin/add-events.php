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
	<style type="text/css">
          #map{     width: 570px;height: 400px; }
        </style>
        <!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script> -->
        <!--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC8svOfLUwCNBV-kNMhZKF66srk0XJbdYI&callback=initMap"
        type="text/javascript"></script>-->
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
                                            <h5 class="m-b-10">Events</h5>
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
            if(!empty($single_event[0]))
                             {
                             
                echo '<h4 class="box-title" style="color:#448aff";>Edit Event</h4>';
                
                }
                else
                {
                     echo '<h4 class="box-title" style="color:#448aff";>Add Event</h4>';
                }
            ?>
                                                        <span></span>
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="j-wrapper ">
                                                                                                <?php
                             if(!empty($single_event[0]))
                             {
                              ?>
                                                            <form action="<?php echo base_url('admin/home/event_edit/'.$single_event[0]->event_id); ?>" method="post" class="j-pro" id="j-pro" enctype="multipart/form-data" >
															   <?php  
                           }
                     else{
                           ?>
						      <form action="<?php echo base_url('admin/home/add_events'); ?>" method="post" class="j-pro" id="j-pro" enctype="multipart/form-data" novalidate>
															
						        <?php
                            }
                               ?>
                                                                <!-- end /.header-->
                                                                <div class="j-content">
                                                                    <!-- start name -->
                                                                    <div class="j-row">
																	   <div class="j-span6 j-unit">
                                                                            <div class="j-input">
                                                            <select name="event_category" class="form-control">
                            <option value="">Event Category</option>
						
                            <?php
                            foreach ($category as $key=>$value) {
						    
                            echo '<option value="'.$value->category_id.'">'.$value->category_name.'</option>';
                            }
                            ?>
                            </select>
                                                                     
																				   <span class="j-tooltip j-tooltip-right-top">Event Category</span>
                                                                            </div>
                                                                        </div>
                <div class="j-span6 j-unit">
                    <div class="j-input">
                      
                        <input type="text" id="first_name" name="event_name" placeholder="Event Name" value="<?php echo @$single_event[0]->event_name ?>">
						   <span class="j-tooltip j-tooltip-right-top">Event Name</span>
                    </div>
                </div>
				</div>
				 <div class="j-row">
                <div class="j-span6 j-unit">
                    <div class="j-input">
                      
                      <input id="dropper-default" class="form-control" type="text" placeholder="Event Start Date" value="<?php echo @$single_event[0]->event_end_date ?>" />
						 <span class="j-tooltip j-tooltip-right-top">Event Start Date</span>
                    </div>
                </div>
				    <div class="j-span6 j-unit bootstrap-timepicker">
                    <div class="j-input">
                        
                        <input type="text"  name="event_start_time" class="timepicker" placeholder="Event Start Time" id="pick1" value="<?php echo @$single_event[0]->event_start_time ?>">
						   <span class="j-tooltip j-tooltip-right-top">Event Start Time</span>
                    </div>
                </div>
            </div>
            <!-- end name -->
                                                            
                                                              
                                                                    <div class="divider gap-bottom-25"></div>
                                                                    <!-- start country -->
																	
<div class="j-row">
	<div class="j-span6 j-unit">
                                <div class="j-input">
                                
                                  <input id="dropper-format" class="form-control" type="text" placeholder="Event End Date" value="<?php echo @$single_event[0]->event_end_date ?>"/>
									 <span class="j-tooltip j-tooltip-right-top">Event End Date</span>
                                </div>
                            </div>
							   <div class="j-span6 j-unit bootstrap-timepicker">
                                <div class="j-input ">
                                   
                                    <input type="text"  id="pick2" name="event_end_time" class="timepicker" placeholder="Event End Time" value="<?php echo @$single_event[0]->event_end_time ?>">
									   <span class="j-tooltip j-tooltip-right-top">Event End Time</span>
                                </div>
                            </div>
			            </div>
                                                         
                                                                    <div class="divider gap-bottom-25"></div>
                                                           
                                                                    <!-- start files -->
                                                                    <div class="j-row">
                                                                        <div class="j-span6 j-unit">
                                                                            <div class="j-input">
                                                                           
                                                                                <input type="text" id="first_name" name="event_contact_person" placeholder="Contact Name" value="<?php echo @$single_event[0]->event_contact_person ?>">
																				   <span class="j-tooltip j-tooltip-right-top">Contact Name</span>
                                                                            </div>
                                                                        </div>
																		    <div class="j-span6 j-unit">
                                                                            <div class="j-input">
                                                                                
                                                                                <input type="text" id="first_name" name="event_phone" placeholder="Contact Phone" value="<?php echo @$single_event[0]->event_contact_phone ?>">
																				   <span class="j-tooltip j-tooltip-right-top">Contact Phone</span>
                                                                            </div>
                                                                        </div>
                                                                           <!--<div class="j-span6 j-unit">
                                                                            <div class="j-input">
																				 <h4 class="sub-title">Blog Description</h4>
                                                                                <input type="text" id="editor1" name="blog_description" placeholder="Blog Description">
																				   <span class="j-tooltip j-tooltip-right-top">Blog Description</span>
																				   
                                                                            </div>
                                                                        </div>-->
                                                                    </div>
																	
																	        <div class="j-row">
                                                                        <div class="j-span6 j-unit">
                                                                            <div class="j-input">
                                                                                <input type="text" id="first_name" name="event_email" placeholder="Contact Email" value="<?php echo @$single_event[0]->event_contact_email ?>">
																				   <span class="j-tooltip j-tooltip-right-top">Contact Email</span>
                                                                            </div>
                                                                        </div>
																	   <div class="j-span6 j-unit">
                                                                            <div class="j-input j-append-small-btn">
                                                                                <div class="j-file-button">
                                                                                    Browse
                                                                                    <input type="file" name="event_image" onchange="document.getElementById('file1_input').value = this.value;">
                                                                                </div>
                                                                                <input type="text" id="file1_input" readonly="" placeholder="Add Event Image">
																				<?php if(!empty($single_event[0])){?>
                                                <img  src="<?php echo base_url();?>uploads/events/<?php echo  $single_event[0]->event_image; ?>" width="100" height="100">
                                                <?php } ?>
                                                 <input type="hidden" name="temp_img" value="<?php echo @$single_event[0]->event_image; ?>">
                            <?php echo form_error('event_image','<p class="help-block error_msg">','</p>'); ?>
                                                                               <span class="j-tooltip j-tooltip-right-top">Event Image</span>
                                                                            </div>
                                                                        </div>
																		</div>
																		  <div class="j-row">
                                                                                <div class="j-span6 j-unit">
                                                                            <div class="j-input">
                                                                                   
                                                                                </label>
                                                                                <input type="text" id="event_location" name="event_location" placeholder="Event Location" value="<?php echo @$single_event[0]->event_location; ?>">
                                                                                   <span class="j-tooltip j-tooltip-right-top">Event Location</span>
                                                                            </div>
																			<input type="button" value="Geocode" onclick="codeAddress()">
                                                                        </div>
                                                                           <div class="j-span6 j-unit">
                                                                            <div class="j-input">
																				 <h4 class="sub-title">Event Description</h4>
                                                                                <textarea type="text" id="editor1" name="event_description" placeholder="Event Description"><?php echo @$single_event[0]->event_description ?></textarea>
																				   <span class="j-tooltip j-tooltip-right-top">Event Description</span>
																				   
                                                                            </div>
                                                                        </div>
                                                                    </div>
								
										
                                                                    <!-- end files -->
                                                                    <!-- start response from server -->
                                                                    <div class="j-response"></div>
                                                                    <!-- end response from server -->
                                                               
                                                                <!-- end /.content -->
                                                                <div class="j-footer">
                                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                                    <button type="reset" class="btn btn-default m-r-20">Cancel</button>
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
                                                       <h4 class="box-title" style="color:#448aff";>View Events</h4>
                                                        <span></span>
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="dt-responsive table-responsive">
                                                            <table id="multi-colum-dt" class="table table-striped table-bordered nowrap">
                                                                <thead>
                                                                    <tr>
                                                                <th>#</th>
                                                                <th>Event Name</th>
                                                                <th>Start Date</th>
                                                                <th>End Date</th>
                                                                <th>Location</th>
                                                                <th>Image</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
																<th>More</th>
                                                                                                             
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                 <?php 
                    if (!empty($events)) {
                    $i=0;
                    foreach($events as $post){
                    $i++;
                    if($post->event_status=='0')
                    {
                        $status_type="success";
                        $status_state="checked";
                    }
                    elseif($post->event_status=='1')
                    {
                        $status_type="info";
                        $status_state="";
                    }
                    ?>
                                                                <tr>
                                                                <td><?php echo $i;?></td>
                                                                   <td><?php echo $post->event_name;?></td> 
                                                                    <td><?php echo $post->event_start_date;?></td>
                                                                    <td><?php echo $post->event_end_date;?></td>
                                                                    <td><?php echo $post->event_location;?></td>
                                                                    <td><img style="width:100px;height:100px;" src="<?php echo base_url();?>uploads/events/<?php echo $post->event_image;?>"></td>
                                                                   <td> <input name="status-change" id="status_change" data-status="<?php echo $post->event_status;?>" data-id=<?php echo $post->event_id;?> type="checkbox" data-size="small" data-on-color="success" data-off-color="warning" data-on-text="ON" data-off-text="OFF" <?php echo $status_state?> /> </td>
                                                                   <td><?php echo anchor('admin/home/event_edit/' .$post->event_id, 'edit'); ?>
                                                                    <a data-toggle="modal" href="#Delete_Log" class="delete_option " data-id="<?php echo $post->event_id;?>">delete</a>
                                                                   </td>
																    <td><a data-toggle="modal" title=" View More" data-target="#myModal<?php echo $post->event_id;?>" href="javascript:void(0);"  >More</a></td>
                                                                </tr>
             <!-- view popupModal -->
   <div class="modal fade" id="myModal<?php echo $post->event_id;?>" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="height: 250px;">
        <div class="modal-header">
          
          <h4 class="modal-title">View Details</h4>
        </div>
        <div class="modal-body">
		<div class="col-md-12">
            <div class="col-md-3">
                <center> <p>Event Start Time</p>
                <h4></h4><?php echo $post->event_start_time;?> </center>.
            </div>
			  <div class="col-md-3">
                <center> <p>Event End Time</p>
                <h4></h4><?php echo $post->event_end_time;?> </center>.
            </div>
			  <div class="col-md-3">
                <center> <p>Contact Person</p>
                <h4></h4><?php echo $post->event_contact_person;?> </center>.
            </div>
			  <div class="col-md-3">
                <center> <p>Contact Phone</p>
                <h4></h4><?php echo $post->event_contact_phone;?> </center>.
            </div>
			</div>
			<div class="col-md-12">
			  <div class="col-md-3">
                <center> <p>Contact Email</p>
                <h4></h4><?php echo $post->event_contact_email;?> </center>.
            </div>
			<!--<div class="col-md-3">
                <center> <p>Event Description</p>
                <h4></h4><?php echo $post->event_description;?> </center>.
            </div>-->
			
       
        

        </div>
       
      </div>
	  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>                                                      
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
<!-- Event delete confirmation modal -->
      <div class="modal fade" id="Delete_Log" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="z-index: 10000 !important;">
    <div class="modal-content">
      <div class="modal-header">
     
        <h4 class="modal-title" id="myModalLabel">Delete Event</span> ?</h4>
      </div>
      <div class="modal-body">
        Do you want to delete selected Event ?<br/>
        This Process cannot be Rolled Back
      </div>
        <form name="frm_delete_sale" id="frm_delete_sale" action="<?php echo base_url(); ?>admin/home/event_delete/" method="POST">
          <input type="hidden" name="event_id" id="event_id" value=""/>
          <div class="modal-footer">
            <button type="submit" name="btn_delete_event" id="btn_delete_event" value="Delete" class="btn btn-danger btn-flat">Delete</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </form>
    </div>
  </div>
</div>

<!-- ////////////////////////////////////////////////////////////////////////////-->
<?php require_once('includes/common-js.php');?>
<!--<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/map.js"></script>-->
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
    url: '<?php echo base_url('index.php/admin/home/event_status/'); ?>',
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
<script>
$('.delete_option').click(function()
{
$('#event_id').val($(this).data('id'));
});
</script>
<script src="<?php echo base_url();?>assets/js/select2.full.min.js"></script>
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<script>
$('#pick1').timepicker({
    defaultTime: 'current',
    minuteStep: 1,
    disableFocus: true,
    template: 'dropdown'
});
</script>
<script>
$('#pick2').timepicker({
    defaultTime: 'current',
    minuteStep: 1,
    disableFocus: true,
    template: 'dropdown'
});
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
    CKEDITOR.replace('editor1');
  });
</script>

</body>

</html>