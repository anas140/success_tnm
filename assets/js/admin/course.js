$(document).ready(function() {
    $("#course_name").on('change', function() {
        // alert(this.value)
        $.ajax({
            url: '/success/admin/module/language_count_and_get',
            type: 'POST',
            data: {id: this.value},
            success: function(response) {
                // console.log(response);
                $("#add_module_form").html(response);
               // $("#add_module_form").append(response);
            //    getModules(id)
            },
            error: function(xhr,status,error) {
                console.log(error);
            }
        });
    });
  });

    function addMoreModule(id) {
        // length += 1;
        $.ajax({
            url: 'language_count_and_get',
            type: 'POST',
            data: {id: id},
            success: function(response) {
                $("#add_module_form").append(response)
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        })
    }
