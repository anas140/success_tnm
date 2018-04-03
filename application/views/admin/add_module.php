<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Success Valley</title>
        <?php require_once('includes/common-css.php');?>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    </head>
    <style>
        .add {
            margin-top: 4px;
            border-radius: 50%;
        }
        .del {
            margin-top: 4px;
            border-radius: 50%;
        }
        .fa {
            border: 1px solid #ddd;
            padding: 3px;
            cursor: pointer;
        }
        .fa-pencil:hover {
            color: orange
        }
        .fa-trash:hover {
            color: red;
        }
    </style>
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
            <!----header start----- -->
            <?php require_once('includes/header.php');?>
            <!--header ending-->
            <!-- Sidebar inner chat end-->
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                <!--start left sidebar-->
                    <?php require_once('includes/left-sidebar.php');?>
                    <!---left side bar-->
                    <div class="pcoded-content">
                    <!-- Page-header start -->
                        <div class="page-header">
                            <div class="page-block">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <div class="page-header-title">
                                            <h5 class="m-b-10">Course Module</h5>
                                            <p class="m-b-0" style="opacity:0">
                                                Lorem Ipsum is simply dummy text of the printing
                                            </p>
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
                                                        <h4 class="box-title" style="color:#448aff";>
                                                            Add Course Module
                                                        </h4>
                                                    <span></span>
                                                </div>
                                                <div class="card-block">
                                                    <div class="j-wrapper ">
<form action="<?php echo base_url('admin/module/create'); ?>" method="post" class="j-pro" id="j-pro" enctype="multipart/form-data" novalidate>
<div class="j-content">
    <div class="j-row">
        <div class="j-span6 j-unit">
            <div class="j-input">
                <select name="course_name" class="form-control" id="course_name">
                    <option value="">Select Course</option>
                    <?php foreach ($courses as $course): ?>
                        <option value="<?= $course->course_id ?>">
                            <?= $course->course_name; ?>
                        </option>
                    <?php endforeach; ?>                                   
                </select>
                <span class="j-tooltip j-tooltip-right-top">Select Course</span>
            </div>
        </div>
    </div>
	<div class="j-row wrappers" id="add_module_form">
	    <!--<div class="j-span3 j-unit">
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
                <?php echo form_error('package_image','<p class="help-block error_msg">','</p>'); 
                ?>
                <span class="j-tooltip j-tooltip-right-top">Course Pdf</span>
            </div>
        </div>
		<div class="j-row">
		    <div class="j-span3 j-unit">
                <div class="j-input">
                    <input type="text" id="course_vdo_url" name="course_vdo_url" placeholder="Youtube Url" value="<?php echo @$profile[0]->profile_title ?>">
					<span class="j-tooltip j-tooltip-right-top">
                        Youtube Video Url
                    </span>
                </div>
            </div>
			<div class="col-md-2">
                <div class="form-group">
                    <a href="javascript:void(0);" class="add_button" title="Add field" style="margin-top: 26px;float: left;">
                        Add More Module
                    </a>
                </div>
            </div>
		</div>
        <div class="divider gap-bottom-25"></div>
            <!-- start country -->
            <!-- start files -->
            <!-- end files -->
            <!-- start response from server 
            <div class="j-response"></div>
        </div> -->
        <div class="j-footer">
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="reset" class="btn btn-default m-r-20">cancel</button>
        </div>
    </form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- Page-header end -->
<div class="pcoded-inner-content">
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
<div class="row">
    <div class="col-md-4 col-md-offset-2">
        <!-- <div class="j-span6 j-unit"> -->
            <!-- <div class="j-input"> -->
                <select name="course_name" class="form-control" id="course_module_select">
                    <option value="">Select Course</option>
                    <?php foreach ($courses as $course): ?>
                        <option value="<?= $course->course_id ?>">
                            <?= $course->course_name; ?>
                        </option>
                    <?php endforeach; ?>                                   
                </select>
                <span class="j-tooltip j-tooltip-right-top">Select Course</span>
            <!-- </div> -->
        <!-- </div> -->
    </div>
</div>    
<br>
<!-- Module Table -->    
<table id="module_table" class="table table-striped table-bordered nowrap">
    <thead>
        <tr>
            <th>#</th>
			<th>Title</th> 
            <th>Course</th>
			<th>Language</th>                      
			<th>Date</th>
			<!-- <th>Status</th> -->
			<th>Action</th>
        </tr>
    </thead>
    <tbody id="module_table_body">
	  <!-- <?php /* if (!empty($all_faq)) {
        $i=0;
        //foreach($all_faq as $post){
           // $i++;
            if($post->faq_status=='0') {
                $status_type="success";
                $status_state="checked";
            } elseif($post->faq_status=='1') {
                $status_type="info";
                $status_state="";
            }
       ?>
	    <tr>
			<td><?php echo $i;?></td>
            <td><?php echo $post->faq_title;?></td> 
            <td><?php echo $post->faq_description;?></td>
			<td><?php echo $post->faq_addedon;?></td>
            <td>  
                <input name="status-change" 
                       id="status_change" 
                       data-status="<?php echo $post->faq_status;?>" 
                       data-id=<?php echo $post->faq_id;?> 
                       type="checkbox" 
                       data-size="small" 
                       data-on-color="success" data-off-color="warning" data-on-text="ON" 
                       data-off-text="OFF" 
                       <?php echo $status_state?> /> 
            </td>
			<td>
                <?php 
                    echo anchor('admin/home/faq_edit/' .$post->faq_id, 'edit'); 
                ?>
				<a data-toggle="modal" 
                   href="#Delete_Log" 
                   class="delete_option" 
                   data-id="<?php echo $post->faq_id;?>">
                    delete
                </a>
			</td>
		</tr>
    }
} */
?> */ -->
										   
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




<!-- Models -->

<!-- Edit Module Model -->
<div class="modal fade" tabindex="-1" role="dialog" id="module_edit_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Module</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        
        <form accept="" method="post"> 
            <div class="form-group">
                <label for="Title">Module Title</label>
                <input type="hidden" name="module_id" id="modal_module_id" value="">
                <input type="text" class="form-control" name="title" id="modal_module_title">
            </div>
            <!-- <input type="submit" class="btn btn-primary" value="Update"> -->
        </form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="edit_module_modal_btn" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- ./ Edit Module End  -->

<!-- ./Models -->


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

$("body").on('click','.addMore', function() {
div = $(this).parents('.module-form');
let html = "";
language = $(this).data('language');
temp     = $(this).data('olaka');
// alert(language);
temp++;
$(this).data('olaka',temp);
html += `

<div class="ansu">
<div class="j-span10 j-unit">
    <div class="j-input">
        <input type="text" class="module_name_value" name="course_module[${language}][${temp}][module_title]" placeholder="Module Title">
        <span class="j-tooltip j-tooltip-right-top">Module1</span>
    </div>
</div>

<div class="j-span2 j-unit">
    <button type="button" class="btn-link delete style="margin-top: 26px;float: left;" data-olaka="0">delete </button>
    </div>


<div id="sub-module-form" class="delete-module" style=''>
<div class="j-span4 j-unit">
<div class="j-input j-append-small-btn">
<div class="j-file-button">
    Browse
    <input type="file" name="course_module[${language}][${temp}][module_file][]">
</div>
<input type="text" id=" name="" readonly="" placeholder="Add Course Pdf">
</div>
</div>
<div class="j-row">
<div class="j-span4 j-unit">
<div class="j-input">
    <input type="text" name="course_module[${language}][${temp}][module_url][]" placeholder="Youtube Url" value="">
    <span class="j-tooltip j-tooltip-right-top">Youtube Video Url</span>
</div>
</div>

<div class="j-span3 j-unit">
        <button type="button" class="btn btn-primary add" data-language=${language} data-olaka=${temp}>+</button>
    </div>


</div>
</div><!-- ansu -->

<!-- end name -->
<div class="divider gap-bottom-25"></div>
<div class="j-response"></div>
<!-- end response from server -->
</div>
`;
$(div).append(html);
});
</script>


<script>
    $(function () {
//Initialize Select2 Elements
    $(".select2").select2();
        CKEDITOR.replace('editor1');
    });

    $("body").on('click','.add', function() {
        div = $(this).closest('.j-row');
        let html = "";
        language = $(this).data('language');
        temp     = $(this).data('olaka');
        //temp++;
        //$(this).data('olaka',temp);
        //alert(language);
        html += `
        
            <div id="sub-module-form" class="chapter-row">
                <div class="j-span4 j-unit">
                    <div class="j-input j-append-small-btn">
                        <div class="j-file-button">
                            Browse
                            <input type="file" name="course_module[${language}][${temp}][module_file][]">
                        </div>
                        <input type="text" id=" name="" readonly="" placeholder="Add Course Pdf">
                    </div>
                </div>
                <div class="j-row">
                    <div class="j-span4 j-unit">
                        <div class="j-input">
                            <input type="text" name="course_module[${language}][${temp}][module_url][]" placeholder="Youtube Url">
                            <span class="j-tooltip j-tooltip-right-top">
                                Youtube Video Url
                            </span>
                        </div>
                    </div>

                    <div class="j-span3 j-unit">
                        <button type="button" class="btn del style="margin-top: 4px;float: left;">
                            -
                        </button>
                    </div>
                </div>
                <div class="divider gap-bottom-25"></div>
                <div class="j-response"></div>
            </div>`;
        $(div).append(html);
    });

$('body').on('click', '.del', function() {
// $('.remove')
$(this).closest('.chapter-row').remove();
});

$('body').on('click', '.delete', function() {

$(this).closest('.ansu').remove();
})


// $(document).ready(function() { 
//     $('#module_table').DataTable();
// })
// $(document).on('change', '#course_module_select', function() {
$("#course_module_select").on('change', function() {
    // id = this.value;
    getModulesByCourse(this.value);
    
});
function getModulesByCourse(id) {
    $.ajax({
         url: '/success/admin/module/get_modules_by_course',
         type: 'POST',
         data: {id: id},
         success: function(response) {
            // console.log(response);
            html = "ggg";
            response = JSON.parse(response);
            var i =0;
            response.forEach(function(item) {
                i +=  1;
                html += `
                    <tr>
                        <td>${item.module_id}</td>
                        <td>${item.module_name}</td>
                        <td>${item.course_name}</td>
                        <td>${item.language_name}</td>
                        <td>${item.updated_at}</td>
                        <td>
                            <i class="fa fa-pencil" id="edit_module" style="font-size:25px;" data-module="${item.module_id}" data-course="${item.course_id}" data-moduletitle="${item.module_name}"></i>&nbsp;
                            <i class="fa fa-trash" id="delete_module" style="font-size:25px;" data-module="${item.module_id}" data-course="${item.course_id}"></i>
                        </td>
                    </tr>
                `;
            });
            // console.log(html);
            // $("#module_table").html(response);
            $('#module_table').DataTable();
            $("#module_table_body").html(html);

        },
        error: function(xhr,status,error) {
                console.log(error);
        }
    })   
}

// Edit Module
$('body').on("click", "#edit_module", function() {
    $("#modal_module_title").val($(this).data('moduletitle'));
    $("#modal_module_id").val($(this).data('module'))
    $("#module_edit_modal").modal("show");

})

$("#edit_module_modal_btn").on('click', function() {
    alert($(this).data('module'));
   // alert($("#modal_module_title").val());
   $.ajax({
    url: '/success/admin/module/update_module',
    type: 'POST',
    data: {id: $(this).data('module'), title: $("#modal_module_title").val()},
    success: function(response) {
        console.log(response);
    },
    error: function(response) {
        console.log(response);
    }
   });
})
// \. Edit Module



// Delete Module
$('body').on("click", "#delete_module", function() {
    // alert(this.data(module));
    // alert($(this).data('module'));
    var course_id = $(this).data('course');
    alert(course_id);
    if(confirm('Are You Sure want to delete this Module')) {
        $.ajax({
         url: '/success/admin/module/delete_module',
         type: 'POST',
         data: {id: $(this).data('module')},
         success: function(response) {
           if(response) {
            console.log('data deleted');
            // Display an error toast, with a title
            toastr.error('Module Deleted');

            getModulesByCourse(course_id);
           } else {
            
           }
         },
         error: function(xhr,status,error) {
                console.log(error);
         }
        })
    } else {
         toastr.success('Deletion Cancelled');
    }
    
})


// $("body").on('click', "#edit_module", function() {

// });
</script>

</html>