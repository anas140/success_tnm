<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('course_model');
        $this->load->model('event_model');
        $this->load->model('admin');
        $this->load->library('session'); // Start Session

    }

    function index()
    {
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        else
        {
            redirect('admin/home/events');
        }
    }
    
    function login()
    {
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
            $this->load->view('admin/admin-login');

        }
        else
        {
            redirect('admin/home/category');
        }
    }
       
    function home_page()
    {       
        $username=$this->input->post('username');
        $password=$this->input->post('password');
        $this->admin->start_session();
        if($this->admin->admin_check($username,$password))
        {
            $admin_id=$this->admin->admin_id;
            if($admin_id>0)
            {
                $this->session->set_userdata('admin_id',$admin_id);
                $this->admin->start_session();
                redirect('admin/home/category');
            }
        }
        else
        {
            $data['login_status']=1;
            $this->load->view('admin/admin-login',$data);
        }
    }
    
    function logout()
    {
        $this->admin->start_session();
        $this->session->unset_userdata('admin_id');
        $this->load->view('admin/admin-login');
    }

    function add_category()
    {
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $this->data["posts"] = $this->event_model->display_category();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('category_name','Category','required');
        if($this->form_validation->run()==FALSE)
        {
            $this->load->view('admin/add-category',$this->data);
        }
        else
        {             
            $data = array(
            'category_name' => $this->input->post('category_name'),
            );          
            $this->event_model->insert_category($data);
            $this->session->set_flashdata('success', 'Category inserted Successfully');
            redirect('admin/home/category');
        }
    }

    function category(){
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $data["posts"] = $this->event_model->display_category();
        //print_r($this->data["posts"]);exit;
        $this->load->view('admin/add-category', $data);
    }
	    ///////course module///////
    function course_module()
    {
       $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
         $data["course"] = $this->event_model->get_courses();
         $this->load->view('admin/add-course-module',$data);
    }
    ///////close instructor profile/////
    ///////instructor profile///////
    function instructor_profile()
    {
       $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $data["instructor_profile"] = $this->event_model->display_instructor_profile();
         $this->load->view('admin/add-instructor-profile',$data);
    }
    ///////close instructor profile/////
    ////////add instructor profile//////
       function add_instructor_profile(){ 
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $data["instructor_profile"] = $this->event_model->display_instructor_profile();
        //$data["all_course"] = $this->course_model->get_course();     
        $this->load->library('form_validation');
        //$this->form_validation->set_rules('testimonial_course','Course','required');
        $this->form_validation->set_rules('profile_title','Name','required');
        $this->form_validation->set_rules('profile_description','Post','required');

        if($this->form_validation->run()==FALSE){
            $this->load->view('admin/add-instructor-profile',$data);
        }
        else{
            $config['upload_path']   = './uploads/instructor_profile/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);  
               
            if($this->upload->do_upload('profile_image'))
            {
                $file_data=$this->upload->data();
                $files=$file_data['file_name'];
                $data=array(
                
                'profile_title' => $this->input->post('profile_title'),
                'profile_description' => $this->input->post('profile_description'),
                'profile_image'  => $files
                
            );
               $this->event_model->insert_instructor_profile($data);
            $this->session->set_flashdata('success', 'Profile inserted Successfully');
            redirect('admin/home/instructor_profile');     
            }
            // $data=array(
                
            //     'testimonial_name' => $this->input->post('testimonial_name'),
            //     'testimonial_review' => $this->input->post('testimonial_review')
            // );
            
                  
        }
    }
    //////close add instructor profile/////
    //////edit instructor profile//////
        function instructor_profile_edit($profile_id)
    {
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('profile_title', 'Name', 'required');
        if($this->form_validation->run() == FALSE)
      {
        $data["profile"]= $this->event_model->single_profile_id($profile_id);
        $data["instructor_profile"] = $this->event_model->display_instructor_profile();
        $this->load->view('admin/add-instructor-profile',$data);
      }
     else
      {
        $postedby='admin';
              
            //$this->event_model->about_dr_moinu = $this->input->post('about_moinu');
            $this->event_model->profile_title = $this->input->post('profile_title');
            $this->event_model->profile_description = $this->input->post('profile_description');
            //s$this->event_model->about_postedby = $postedby;
            if($_FILES['profile_image']['name'] != "")
         {
            $config['allowed_types'] = 'jpg|png|jpeg|JPG|JPEG|PNG';
            $config['upload_path'] = './uploads/instructor_profile';
            $config['file_name'] = 'direc'.time();
            $config['overwrite'] = false;
            $this->load->library('upload', $config);
            $this->upload->do_upload('profile_image');
            $logo = $this->upload->data();
            $this->event_model->profile_image =$logo['file_name'];
         }
            $this->event_model->update_instructor_profile($profile_id);
            $this->session->set_flashdata('success', 'Profile Updated successfully');
            redirect('admin/home/instructor_profile');
      }
    }
    //////close edit instructor profile/////
    /////add about///////
          function about(){
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        //$this->data["posts"] = $this->course_model->display_category();
        $data['about']=$this->event_model->display_about();
        //print_r($data['about']);exit;
        $this->load->view('admin/add-about',$data);
    }
    /////close about add//////
	///////////package/////////
       function package(){
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $this->data["all_package"] = $this->event_model->display_package();
        //$this->data["all_course"] = $this->course_model->get_course();
        $this->load->view('admin/add-package', $this->data);
    }
    ///////close package//////
	 ////add package/////
     function add_package(){ 
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $data["all_package"] = $this->event_model->display_package();
        //$data["all_course"] = $this->course_model->get_course();     
        $this->load->library('form_validation');
        //$this->form_validation->set_rules('testimonial_course','Course','required');
        $this->form_validation->set_rules('package_name','Name','required');
        //$this->form_validation->set_rules('testimonial_review','Post','required');

        if($this->form_validation->run()==FALSE){
            $this->load->view('admin/add-package',$data);
        }
        else{
            $config['upload_path']   = './uploads/package/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);  
               
            if($this->upload->do_upload('package_image'))
            {
                $file_data=$this->upload->data();
                $files=$file_data['file_name'];
                
                $data=array(
                
                'package_name' => $this->input->post('package_name'),
                'package_description' => $this->input->post('package_description'),
                'package_image'  => $files,
                'package_price' => $this->input->post('package_price')
            );
               $this->event_model->insert_package($data);
            $this->session->set_flashdata('success', 'Package inserted Successfully');
            redirect('admin/home/package');     
            }
           
        }
    }
    ////close package/////
      function package_edit($package_id)
    {
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('package_name', 'Name', 'required');
        if($this->form_validation->run() == FALSE)
      {
        $data["package"]= $this->event_model->single_package_id($package_id);
        $data["all_package"] = $this->event_model->display_package();
        $this->load->view('admin/add-package',$data);
    }
     else
      {
        $postedby='admin';
              
              $this->event_model->package_name= $this->input->post('package_name');
               $this->event_model->package_description= $this->input->post('package_description');
                $this->event_model->package_price= $this->input->post('package_price');
              
               
            if($_FILES['package_image']['name'] != "")
         {
            $config['allowed_types'] = 'jpg|png|jpeg|JPG|JPEG|PNG';
            $config['upload_path'] = './uploads/package';
            $config['file_name'] = 'direc'.time();
            $config['overwrite'] = false;
            $this->load->library('upload', $config);
            $this->upload->do_upload('package_image');
            $logo = $this->upload->data();
            $this->event_model->package_image =$logo['file_name'];
         }
            $this->event_model->update_package($package_id);
            $this->session->set_flashdata('success', 'Package Updated successfully');
            redirect('admin/home/package');
      }
    }
    ////delete package////
     function package_delete()
    {
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $this->event_model->package_delete_status = 1;
        $package_id=$this->input->post('package_id');
        $this->event_model->delete_package($package_id);
        $this->session->set_flashdata('success', 'Package deleted successfully');
        redirect('admin/home/package');
    }
	//////close package delete////
	
    /////insert about//////
    function add_about()
    {
       $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        } 
        //$this->event_model->about_dr_moinu = strip_tags($this->input->post('about_moinu'));
        $this->event_model->about_success_valley = strip_tags($this->input->post('about_success_valley'));
        $this->event_model->insert_about();
                $this->session->set_flashdata('success', 'About inserted Successfully');
				 redirect('admin/home/about');
    }
     
    /////close insert about////
    //////delete about/////
       function about_delete()
   {
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
         $this->event_model->about_delete_status = 1;
         $about_id=$this->input->post('about_id');
         $this->event_model->delete_about($about_id);
         $this->session->set_flashdata('success', 'About deleted successfully');
      redirect('admin/home/about');
   }
       //////delete course/////
       function course_delete()
   {
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
         $this->event_model->course_delete_status = 1;
         $course_id=$this->input->post('course_id');
         $this->event_model->delete_course($course_id);
         $this->session->set_flashdata('success', 'Course deleted successfully');
         redirect('admin/home/course');
   }
    //////close delete status////
    //     function category()
    // {
    //     $this->tbl_admin->start_session();
    //     if(!$this->tbl_admin->is_loggedin())
    //     {
    //       redirect('admin/Super_admin/login');
    //     }
        
    //     $this->load->view('admin/course_category');
    // }
    //////close course category//////
    ///////add events page///////////
      function events(){
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        //$this->data["posts"] = $this->course_model->display_category();
        $data["category"] = $this->event_model->display_category();
        $data['events']=$this->event_model->display_events();
        $this->load->view('admin/add-events',$data);
    }
    //////close add events//////
    //////////add data to events//////
     function add_events(){ 
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        //$data["all_course"] = $this->course_model->get_all_course();
        //$data["category"] = $this->course_model->get_category(); 
        //$data["get_course"] = $this->course_model->get_course();       
        $this->load->library('form_validation');
        $this->form_validation->set_rules('event_name','Event Name','required');
        //$this->form_validation->set_rules('course_slug','Slug','required');
        //$this->form_validation->set_rules('course_seo_title','Seo Title','required');
        //$this->form_validation->set_rules('course_category', 'Category', 'required');
        //$this->form_validation->set_rules('event_image', '', 'callback_file_check');
        $data['events']=$this->event_model->display_events(); 
        //if($this->form_validation->run()==FALSE){
            //$this->load->view('admin/add-events',$data);
        //}
       // else{

            // $config['upload_path']          = './uploads/course/';
            // $config['allowed_types'] = 'jpg|jpeg|png|gif';
            // $config['max_size']   = '2048000';
            // $config['max_width'] = '1400';
            // $config['max_height'] = '400';
            // $this->load->library('upload', $config);
            // $this->upload->initialize($config);

            /*$home_visible=$this->input->post('course_home_visible');
            $enquiry_form=$this->input->post('course_enquiry_form');

            if ($home_visible == '1' )
            {
                $home_visible = '1';
            }
            else
            {
                $home_visible = '0';
            }
            if ($enquiry_form == '1' )
            {
                $enquiry_form = '1';
            }
            else
            {
                $enquiry_form = '0';
            }*/


                $postedby='admin';
                $this->event_model->event_category = $this->input->post('event_category');
                $this->event_model->event_name = $this->input->post('event_name');
                $this->event_model->event_start_date =  date("Y-m-d",strtotime($this->input->post('event_start_date')));
                $this->event_model->event_start_time = $this->input->post('event_start_time');
                $this->event_model->event_end_date =  date("Y-m-d",strtotime($this->input->post('event_end_date')));
                $this->event_model->event_end_time = $this->input->post('event_end_time');
                $this->event_model->event_location = $this->input->post('event_location');
                $this->event_model->event_location_lat = $this->input->post('location_latitude');
                $this->event_model->event_location_lng = $this->input->post('location_longitude');
                $this->event_model->event_contact_person = $this->input->post('event_contact_person');
                $this->event_model->event_contact_phone = $this->input->post('event_phone');
                $this->event_model->event_contact_email = $this->input->post('event_email');
                $this->event_model->event_description = $this->input->post('event_description');
                $this->event_model->event_postedby = $postedby;
               if($_FILES['event_image']['name'] != "")
               {
            $config['allowed_types'] = 'jpg|png|jpeg|JPG|JPEG|PNG';
            $config['upload_path'] = './uploads/events';
            $config['file_name'] = 'direc'.time();
            $config['overwrite'] = false;
            $this->load->library('upload', $config);
            $this->upload->do_upload('event_image');
            $logo = $this->upload->data();
            $this->event_model->event_image = $logo['file_name'];
            }
                /*$data=array(
                'event_name' => $this->input->post('event_name'),
                'event_start_date' => $this->input->post('event_start_date'),
                'event_start_time' => $this->input->post('event_start_time'),
                'event_end_date' =>$this->input->post('event_end_date'),
                'event_end_time' => $this->input->post('event_end_time'),
                'event_venue' => $this->input->post('event_venue'),
                'event_contact_person' => $this->input->post('event_contact_person'),
                'event_contact_phone' =>$this->input->post('event_phone'),
                'event_contact_email' =>$this->input->post('event_email'),
                'event_description' => $this->input->post('course_duration'),
                'event_postedby'=>$postedby,
                'event_image'      => $files
                );*/
                
                $this->event_model->insert_event();
                $this->session->set_flashdata('success', 'Event inserted Successfully');
                redirect('admin/home/events');
           // }
            // else
            // {
            //     $error = array('error' => $this->upload->display_errors());
            //     $this->load->view('admin/add-events', $error);
            // }           
        //}
    }
    /////close add data to events//////
      ///////update events////////
      function about_edit($about_id)
      {
        //echo "hai";exit;
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $this->load->library('form_validation');
      $this->form_validation->set_rules('about_success_valley', 'Name', 'required');
          if($this->form_validation->run() == FALSE)
      {
         $data['single_about']= $this->event_model->single_about_id($about_id);
        //print_r($data['single_about']);exit;
        //$data["get_course"] = $this->course_model->get_course();
        //$data["category"] = $this->course_model->get_category();
        $this->load->view('admin/add-about',$data);
      }
      else
      {
        $postedby='admin';
              
            //$this->event_model->about_dr_moinu = $this->input->post('about_moinu');
            $this->event_model->about_success_valley = $this->input->post('about_success_valley');
            $this->event_model->about_postedby = $postedby;
            $this->event_model->update_about($about_id);
            $this->session->set_flashdata('success', 'About Updated successfully');
            redirect('admin/home/about');
      }
        
    }
    ///////close event edit//////////////
    /////event delete/////
    function event_delete()
    {
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $this->event_model->event_delete_status = 1;
        $event_id=$this->input->post('event_id');
        $this->event_model->delete_event($event_id);
        $this->session->set_flashdata('success', 'Event deleted successfully');
        redirect('admin/home/events');
    }
    /////close event delete
       /////event delete/////
    function enquiry_delete()
    {
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $this->event_model->enquiry_delete_status = 1;
        $enquiry_id=$this->input->post('enquiry_id');
        $this->event_model->delete_enquiry($enquiry_id);
        $this->session->set_flashdata('success', 'Enquiry deleted successfully');
        redirect('admin/home/enquiry');
    }

    ///////close update events//////
    /////event submit/////////
   //     function event_edit_submit($event_id)
   // {
   //    echo "hai";
   //              $postedby='admin';
   //              $this->event_model->event_name = $this->input->post('event_name');
   //              $this->event_model->event_start_date =  date("Y-m-d",strtotime($this->input->post('event_start_date')));
   //              $this->event_model->event_start_time = $this->input->post('event_start_time');
   //              $this->event_model->event_end_date =  date("Y-m-d",strtotime($this->input->post('event_end_date')));
   //              $this->event_model->event_end_time = $this->input->post('event_end_time');
   //              $this->event_model->event_venue = $this->input->post('event_venue');
   //              $this->event_model->event_contact_person = $this->input->post('event_contact_person');
   //              $this->event_model->event_contact_phone = $this->input->post('event_phone');
   //              $this->event_model->event_contact_email = $this->input->post('event_email');
   //              $this->event_model->event_description = $this->input->post('event_description');
   //              $this->event_model->event_postedby = $postedby;
   //             if($_FILES['event_image']['name'] != "")
   //             {
   //          $config['allowed_types'] = 'jpg|png|jpeg|JPG|JPEG|PNG';
   //          $config['upload_path'] = './uploads/events';
   //          $config['file_name'] = 'direc'.time();
   //          $config['overwrite'] = false;
   //          $this->load->library('upload', $config);
   //          $this->upload->do_upload('event_image');
   //          $logo = $this->upload->data();
   //          $this->event_model->event_image = $logo['file_name'];
   //          }
   //          $this->event_model->update_event($event_id);
   //          redirect('admin/add_events');
   //    }
   
    ////close event submit/////
     /////event edit/////////
    function event_edit($event_id)
    {
          $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('event_name', 'Name', 'required');
        if($this->form_validation->run() == FALSE)
      {
        $data["category"] = $this->event_model->display_category();
        $data["single_event"]= $this->event_model->single_event_id($event_id);
        $data["events"] = $this->event_model->display_events();
        $this->load->view('admin/add-events',$data);
      }
      else
      {
        $postedby='admin';
            $this->event_model->event_category = $this->input->post('event_category');   
          $this->event_model->event_name = $this->input->post('event_name');
            $this->event_model->event_start_date =  date("Y-m-d",strtotime($this->input->post('event_start_date')));
               $this->event_model->event_start_time = $this->input->post('event_start_time');
                $this->event_model->event_end_date =  date("Y-m-d",strtotime($this->input->post('event_end_date')));
               $this->event_model->event_end_time = $this->input->post('event_end_time');
               $this->event_model->event_location = $this->input->post('event_location');
               $this->event_model->event_location_lat = $this->input->post('location_latitude');
               $this->event_model->event_location_lng = $this->input->post('location_longitude');
               $this->event_model->event_contact_person = $this->input->post('event_contact_person');
               $this->event_model->event_contact_phone = $this->input->post('event_phone');
               $this->event_model->event_contact_email = $this->input->post('event_email');
               $this->event_model->event_description = $this->input->post('event_description');
              $this->event_model->event_postedby = $postedby;
            if($_FILES['event_image']['name'] != "")
         {
            $config['allowed_types'] = 'jpg|png|jpeg|JPG|JPEG|PNG';
            $config['upload_path'] = './uploads/events';
            $config['file_name'] = 'direc'.time();
            $config['overwrite'] = false;
            $this->load->library('upload', $config);
            $this->upload->do_upload('event_image');
            $logo = $this->upload->data();
            $this->event_model->event_image =$logo['file_name'];
         }
            $this->event_model->update_event($event_id);
            $this->session->set_flashdata('success', 'Event Updated successfully');
            redirect('admin/home/events');
      }
    }
    //////close ecent edit///////
    function category_delete()
    {
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $this->event_model->category_delete_status = 1;
        $category_id=$this->input->post('category_id');
        $this->event_model->delete_category($category_id);
        $this->session->set_flashdata('success', 'Category deleted successfully');
        redirect('admin/home/category');
    }

    function category_edit($category_id)
    {
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('category_name', 'Name', 'required');
        if($this->form_validation->run() == FALSE)
      {
        $data['category']= $this->event_model->single_category_id($category_id);
        $data["posts"] = $this->event_model->display_category();
        $this->load->view('admin/add-category',$data);
      }
      else
      {
      //$this->event_model->about_dr_moinu = $this->input->post('about_moinu');
        $this->event_model->category_name = $this->input->post('category_name');
        $this->event_model->update_category($category_id);
        $this->session->set_flashdata('success', 'category Updated successfully');
        redirect('admin/home/category');
      }
        //print_r($category_id);
    }

    function category_update($category_id)
    {
        $slug = preg_replace('/\s+/', '', $this->input->post('slug'));
        $data = array(
            'category_name' => $this->input->post('category_name'),
            'category_seo_title' => $this->input->post('seo_title'),
            'category_slug' => $slug,
            'category_meta_description' => $this->input->post('meta_description'),
            'category_meta_keywords' => $this->input->post('meta_keywords'),
            'category_description' => $this->input->post('category_description')
        );  
        $this->course_model->update_category($category_id, $data);
        $this->session->set_flashdata('success', 'Category updated successfully');
        redirect('admin/home/category');
    }

    function category_status()
    {
		  $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $category_status = $this->input->post('status');
        $category_id = $this->input->post('id');
        $this->event_model->update_category_status($category_id,$category_status);
    }
	/////faq status//////
	    function faq_status()
    {
		  $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $faq_status = $this->input->post('status');
        $faq_id = $this->input->post('id');
        $this->event_model->update_faq_status($faq_id,$faq_status);
    }
	/////close faq status////
		    function vdo_testimonial_status()
    {
		  $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $vdo_testimonial_status = $this->input->post('status');
        $vdo_testimonial_id = $this->input->post('id');
        $this->event_model->update_vdotestimonial_status($vdo_testimonial_id,$vdo_testimonial_status);
    }
	/////close testimonial status////
		    function testimonial_status()
    {
		  $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $testimonial_status = $this->input->post('status');
        $testimonial_id = $this->input->post('id');
        $this->event_model->update_testimonial_status($testimonial_id,$testimonial_status);
    }
	/////close testimonial status////
	    function blog_status()
    {
		  $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $blog_status = $this->input->post('status');
        $blog_id = $this->input->post('id');
        $this->event_model->update_blog_status($blog_id,$blog_status);
    }
	/////close blog status////
	    function about_status()
    {
		  $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $about_status = $this->input->post('status');
        $about_id = $this->input->post('id');
        $this->event_model->update_about_status($about_id,$about_status);
    }
	//////close about status/////
		    function slider_status()
    {
		  $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $slider_status = $this->input->post('status');
        $slider_id = $this->input->post('id');
        $this->event_model->update_slider_status($slider_id,$slider_status);
    }
	//////close about status/////
	    function event_status()
    {
		  $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $event_status = $this->input->post('status');
        $event_id = $this->input->post('id');
        $this->event_model->update_event_status($event_id,$event_status);
    }
	/////close event status////////
	//////course status/////
	    function course_status()
    {
		  $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $course_status = $this->input->post('status');
        $course_id = $this->input->post('id');
        $this->event_model->update_course_status($course_id,$course_status);
    }
	/////close course status////////
	//////start notification/////
	function notification()
	{
		  $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
		$data['notification']=$this->event_model->get_notification();
		$this->load->view('admin/header',$data);
	}
	///close notification//////
    function add_course(){ 
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $data["all_course"] = $this->event_model->display_course();
		
        //$data["category"] = $this->course_model->get_category(); 
        //$data["get_course"] = $this->course_model->get_course();       
        $this->load->library('form_validation');
        $this->form_validation->set_rules('course_name','course Name','required');
        //$this->form_validation->set_rules('course_slug','Slug','required');
        //$this->form_validation->set_rules('course_seo_title','Seo Title','required');
        //$this->form_validation->set_rules('course_category', 'Category', 'required');
        //$this->form_validation->set_rules('course_image', '', 'callback_file_check');

        if($this->form_validation->run()==FALSE){
            $this->load->view('admin/add-course',$data);
        }
        else{
            	
            $config['upload_path']          = './uploads/course/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);  
               
            if($this->upload->do_upload('course_image'))
            {
                $file_data=$this->upload->data();
                $files=$file_data['file_name'];
                $data=array(
                'course_name' => $this->input->post('course_name'),
                'course_description' =>$this->input->post('course_description'),
                'course_duration' =>$this->input->post('course_duration'), 
                'course_rate' =>$this->input->post('course_rate'), 
                'course_renewal_rate' =>$this->input->post('renewal_rate'), 
				'course_language' => $this->input->post('course_language'),
                'course_top_status' =>$this->input->post('top_course'),     				
                'course_image'  => $files
                );
                
                $this->event_model->insert_course($data);
                $this->session->set_flashdata('success', 'Course inserted Successfully');
                redirect('admin/home/course');
            }
            else
            {
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('admin/add-blog', $error);
            }          				
        }
    }

	
	     /////course edit/////////
    function course_edit($course_id)
    {
          $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('course_name', 'Name', 'required');
        if($this->form_validation->run() == FALSE)
      {
        $data["all_course"] = $this->event_model->display_course();
        $data["single_course"]= $this->event_model->single_course_id($course_id);
        $this->load->view('admin/add-course',$data);
      }
      else
      {
            //$postedby='admin';
            $this->event_model->course_name = $this->input->post('course_name');
			$this->event_model->course_description = $this->input->post('course_description');
			$this->event_model->course_duration = $this->input->post('course_duration');
			$this->event_model->course_rate = $this->input->post('course_rate');
			$this->event_model->course_renewal_rate = $this->input->post('renewal_rate');
			$this->event_model->course_top_status = $this->input->post('top_course');
			$this->event_model->course_language = $this->input->post('course_language');
            if($_FILES['course_image']['name'] != "")
         {
            $config['allowed_types'] = 'jpg|png|jpeg|JPG|JPEG|PNG';
            $config['upload_path'] = './uploads/course';
            $config['file_name'] = 'direc'.time();
            $config['overwrite'] = false;
            $this->load->library('upload', $config);
            $this->upload->do_upload('course_image');
            $logo = $this->upload->data();
            $this->event_model->course_image =$logo['file_name'];
         }
            $this->event_model->update_course($course_id);
            $this->session->set_flashdata('success', 'Course Updated successfully');
            redirect('admin/home/course');
      }
    }
    //////close ecent edit///////
	
	
	
    function file_check($str){
        $allowed_mime_type_arr = array('image/jpeg','image/pjpeg','image/png');
        $mime = get_mime_by_extension($_FILES['course_image']['name']);
        if(isset($_FILES['course_image']['name']) && $_FILES['course_image']['name']!=""){
            if(in_array($mime, $allowed_mime_type_arr)){
                return true;
            }else{
                $this->form_validation->set_message('file_check', 'Please select only jpg/png file.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            return false;
        }
    }

    function course(){
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
		$this->data["all_course"] = $this->event_model->display_course();
        //$this->data["all_course"] = $this->event_model->get_all_course();
        //$this->data["get_course"] = $this->event_model->get_course();
        //this->data["language"] = $this->event_model->get_all_language();
        //print_r($this->data["language"]);exit;
        $this->load->view('admin/add-course', $this->data);
    }
////////add more course module///////
        function add_branch()
    {
        //echo "hai";
        //exit;
        //$country = $this->tbl_location->get_country();
        //$city = $this->tbl_location->get_cities();
        $language = $this->event_model->get_all_language();
        $response = '';
        $fieldHTML = '';
         
        $fieldHTML.= '<div class="j-row"><div class="j-span3 j-unit"> <div class="j-input">
                               <input type="text" id="course_module" name="course_module" placeholder="Enter Module" value="">
																				   <span class="j-tooltip j-tooltip-right-top">Enter Module</span>
                                                                            </div>
                                                                        </div>';
                        
            
                $fieldHTML.= '
                  									    <div class="j-span3 j-unit">
                                                                            <div class="j-input j-append-small-btn">
                                                                                <div class="j-file-button">
                                                                                    Browse
                                                                                    <input type="file" name="course_pdf" onchange="document.getElementById("file1_input").value = this.value;">
																					
                                                                                </div>
                                                                                <input type="text" id="file1_input" readonly="" placeholder="Add Course Pdf">
																				
                                                <input type="hidden" name="temp_img" value="">
                           
                                                                               <span class="j-tooltip j-tooltip-right-top">Course Pdf</span>
                                                                            </div>
                                                                        </div>';
																		 $fieldHTML.= '<div class="j-span3 j-unit">
                                                                            <div class="j-input">
                                                                              
                                                                                <input type="text" id="course_vdo_url" name="course_vdo_url" placeholder="Youtube Url" value="">
																				   <span class="j-tooltip j-tooltip-right-top">Youtube Video Url</span>
                                                                            </div>
                                                                        </div>
																														<div class="col-md-2">
                            <div class="form-group">
                                <a href="javascript:void(0);" class="remove_button" title="Add field" style="">Cancel</a>
                            </div>
                        </div></div>';
        $response['fieldHTML'] = $fieldHTML;
        echo json_encode($response);
    }
   
    //////close add more course module/////
    // function course_delete($course_id)
    // {
    //     $this->admin->start_session();
    //     if(!$this->admin->is_loggedin())
    //     {
    //       redirect('admin/home/login');
    //     }
    //     $this->course_model->delete_course($course_id);
    //     $this->session->set_flashdata('success', 'Course deleted successfully');
    //     redirect('admin/home/course');
    // }

    // function course_edit($course_id)
    // {
    //     $this->admin->start_session();
    //     if(!$this->admin->is_loggedin())
    //     {
    //       redirect('admin/home/login');
    //     }
    //     $data["course"]= $this->course_model->single_course_id($course_id);
    //     $data["get_course"] = $this->course_model->get_course();
    //     $data["category"] = $this->course_model->get_category();
    //     $this->load->view('admin/update-course',$data);
    // }

    // function course_update($course_id)
    // {
    //     $this->admin->start_session();
    //     if(!$this->admin->is_loggedin())
    //     {
    //       redirect('admin/home/login');
    //     }
    //     $config['upload_path']          = './uploads/course/';
    //     $config['allowed_types'] = 'jpg|jpeg|png|gif';
    //     //$config['max_size']   = '100';
    //     //$config['max_width'] = '1024';
    //     //$config['max_height'] = '768';
    //     $this->load->library('upload', $config);
    //     $this->upload->initialize($config);

    //     if($this->upload->do_upload('course_image'))
    //     {
    //         $course_image=$this->upload->data();
    //         $courseimage=$course_image['file_name'];
    //     }
    //     else
    //     {
    //       $courseimage=$this->input->post('image');
    //     }

    //      $course_slug = preg_replace('/\s+/', '', $this->input->post('course_slug'));
    //     $data = array(
    //         'course_category' => $this->input->post('course_category'),
    //         'course_name' => $this->input->post('course_name'),
    //         'course_seo_title' => $this->input->post('course_seo_title'),
    //         'course_slug' =>$course_slug,
    //         'course_meta_description' => $this->input->post('course_meta_description'),
    //         'course_meta_keywords' => $this->input->post('course_meta_keywords'),
    //         'course_title' => $this->input->post('course_title'),
    //         'course_caption' =>$this->input->post('course_caption'),
    //         'course_content' =>$this->input->post('course_content'),
    //         'course_duration' => $this->input->post('course_duration'),
    //         'course_parent' => $this->input->post('course_parent'),
    //         'course_priority' => $this->input->post('course_priority'),
    //         'course_home_visible' => $this->input->post('course_home_visible'),
    //         'course_enquiry_form' => $this->input->post('course_enquiry_form'),
    //         'course_image'      => $courseimage
    //     );
    //     $this->course_model->update_course($course_id, $data);
    //     $this->session->set_flashdata('success', 'Course updated successfully');
    //     redirect('admin/home/course');
    //     //print_r($courseimage);
    // }
  
    // function course_status()
    // {
    //     $this->admin->start_session();
    //     if(!$this->admin->is_loggedin())
    //     {
    //       redirect('admin/home/login');
    //     }
    //     $course_status = $this->input->post('status');
    //     $course_id = $this->input->post('id');
    //     $this->course_model->update_course_status($course_id,$course_status);
    // }


    function add_blog(){ 
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $data["all_blog"] = $this->course_model->display_blog();     
        $this->load->library('form_validation');
        $this->form_validation->set_rules('blog_title','Title','required');
        $this->form_validation->set_rules('blog_postedby', 'Name', 'required');
        //$this->form_validation->set_rules('blog_image', '', 'callback_blog_file_check');

        if($this->form_validation->run()==FALSE){
            $this->load->view('admin/add-blog',$data);
        }
        else{

            $config['upload_path']          = './uploads/blog/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);  
               
            if($this->upload->do_upload('blog_image'))
            {
                $file_data=$this->upload->data();
                $files=$file_data['file_name'];
                $blog_slug = preg_replace('/\s+/', '', $this->input->post('blog_slug'));
                $data=array(
                'blog_title' => $this->input->post('blog_title'),
                'blog_description' =>$this->input->post('blog_description'),
                'blog_postedby' =>$this->input->post('blog_postedby'),            
                'blog_image'  => $files
                );
                
                $this->event_model->insert_blog($data);
                $this->session->set_flashdata('success', 'Blog inserted Successfully');
                redirect('admin/home/blog');
            }
            else
            {
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('admin/add-blog', $error);
            }                     
        }
    }

    function blog_file_check($str){
        $allowed_mime_type_arr = array('image/jpeg','image/pjpeg','image/png');
        $mime = get_mime_by_extension($_FILES['blog_image']['name']);
        if(isset($_FILES['blog_image']['name']) && $_FILES['blog_image']['name']!=""){
            if(in_array($mime, $allowed_mime_type_arr)){
                return true;
            }else{
                $this->form_validation->set_message('blog_file_check', 'Please select only jpg/png file.');
                return false;
            }
        }else{
            $this->form_validation->set_message('blog_file_check', 'Please choose a file to upload.');
            return false;
        }
    }

    function blog(){
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $this->data["all_blog"] = $this->event_model->display_blog();
        $this->load->view('admin/add-blog', $this->data);
    }
   //////testimonial////////

    // function testimonial(){
    //     $this->admin->start_session();
    //     if(!$this->admin->is_loggedin())
    //     {
    //       redirect('admin/home/login');
    //     }
    //     $this->data["all_testimonial"] =$this->event_model->display_testimonial();
    //     $this->load->view('admin/add-testimonial', $this->data);
    // }
    ///////close testimonial///////
    function blog_delete()
    {
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $this->event_model->blog_delete_status = 1;
        $blog_id=$this->input->post('blog_id');
        $this->event_model->delete_blog($blog_id);
        $this->session->set_flashdata('success', 'Blog deleted successfully');
        redirect('admin/home/blog');
    }

    function blog_edit($blog_id)
    {
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('blog_title', 'Name', 'required');
        if($this->form_validation->run() == FALSE)
       {
        $data["blog"]= $this->event_model->single_blog_id($blog_id);
        //print_r($data["blog"]);
        $data["all_blog"] = $this->event_model->display_blog();
        $this->load->view('admin/add-blog',$data);
      }
      else
      {
        $postedby='admin';
              
            //$this->event_model->about_dr_moinu = $this->input->post('about_moinu');
            $this->event_model->blog_title = $this->input->post('blog_title');
            $this->event_model->blog_postedby = $this->input->post('blog_postedby');
            $this->event_model->blog_description = $this->input->post('blog_description');
            //s$this->event_model->about_postedby = $postedby;
            if($_FILES['blog_image']['name'] != "")
         {
            $config['allowed_types'] = 'jpg|png|jpeg|JPG|JPEG|PNG';
            $config['upload_path'] = './uploads/blog';
            $config['file_name'] = 'direc'.time();
            $config['overwrite'] = false;
            $this->load->library('upload', $config);
            $this->upload->do_upload('blog_image');
            $logo = $this->upload->data();
            $this->event_model->blog_image =$logo['file_name'];
         }
            $this->event_model->update_blog($blog_id);
            $this->session->set_flashdata('success', 'Blog Updated successfully');
            redirect('admin/home/blog');
      }

    }

    // function blog_update($blog_id)
    // {
    //     $config['upload_path']          = './uploads/blog/';
    //     $config['allowed_types'] = 'jpg|jpeg|png|gif';
    //     //$config['max_size']   = '100';
    //     //$config['max_width'] = '1024';
    //     //$config['max_height'] = '768';
    //     $this->load->library('upload', $config);
    //     $this->upload->initialize($config);

    //     if($this->upload->do_upload('blog_image'))
    //     {
    //         $blog_image=$this->upload->data();
    //         $blogimage=$blog_image['file_name'];
    //     }
    //     else
    //     {
    //       $blogimage=$this->input->post('image');
    //     }

    //     $blog_slug = preg_replace('/\s+/', '', $this->input->post('blog_slug'));
    //     $data = array(
    //         'blog_title' => $this->input->post('blog_title'),
    //         'blog_description' =>$this->input->post('blog_description'),
    //         'blog_seo_title' => $this->input->post('blog_seo_title'),
    //         'blog_slug' =>$blog_slug,
    //         'blog_meta_description' => $this->input->post('blog_meta_description'),
    //         'blog_meta_keywords' => $this->input->post('blog_meta_keywords'),
    //         'blog_postedby' =>$this->input->post('blog_postedby'),            
    //         'blog_image'      => $blogimage
    //     );
    //     $this->course_model->update_blog($blog_id, $data);
    //     $this->session->set_flashdata('success', 'Blog updated successfully');
    //     redirect('admin/home/blog');
    // }

    function delete_blog_image()
    {
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $blog_id = $this->input->post('id');
        $blog_type = $this->input->post('type');
        $delete=$this->course_model->delete_blog_image($blog_id,$blog_type);
        //echo 'success';
        echo json_encode('success');

    }
  
    /*function blog_status()
    {
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $blog_status = $this->input->post('status');
        $blog_id = $this->input->post('id');
        $this->course_model->update_blog_status($blog_id,$blog_status);
    }*/
////////add sliders//////////
     function add_slider(){ 
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $data["all_slider"] = $this->event_model->display_slider();
        //$data["all_course"] = $this->course_model->get_course();     
        $this->load->library('form_validation');
        //$this->form_validation->set_rules('testimonial_course','Course','required');
        $this->form_validation->set_rules('slider_text','Name','required');
        if($this->form_validation->run()==FALSE){
            $this->load->view('admin/add-slider',$data);
        }
        else{
            $config['upload_path']   = './uploads/slider/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);  
               
            if($this->upload->do_upload('slider_image'))
            {
                $file_data=$this->upload->data();
                echo $files=$file_data['file_name'];
                //$blog_slug = preg_replace('/\s+/', '', $this->input->post('blog_slug'));
                $testimonial_type='1';
                $data=array(
                 'slider_text' => $this->input->post('slider_text'),
                 'slider_image'  => $files,
                
            );
            $this->event_model->insert_slider($data);
            $this->session->set_flashdata('success', 'Slider inserted Successfully');
            redirect('admin/home/slider');     
            }
                  
        }
    }
    ///////close add sliders////
    function add_testimonial(){ 
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $data["all_testimonial"] = $this->event_model->display_testimonial();
        //$data["all_course"] = $this->course_model->get_course();     
        $this->load->library('form_validation');
        //$this->form_validation->set_rules('testimonial_course','Course','required');
        $this->form_validation->set_rules('testimonial_name','Name','required');
        $this->form_validation->set_rules('testimonial_review','Post','required');

        if($this->form_validation->run()==FALSE){
            $this->load->view('admin/add-testimonial',$data);
        }
        else{
            $config['upload_path']   = './uploads/testimonial/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);  
               
            if($this->upload->do_upload('user_image'))
            {
                $file_data=$this->upload->data();
                echo $files=$file_data['file_name'];
                //$blog_slug = preg_replace('/\s+/', '', $this->input->post('blog_slug'));
                $testimonial_type='1';
                $data=array(
                
                'testimonial_name' => $this->input->post('testimonial_name'),
                'testimonial_review' => $this->input->post('testimonial_review'),
                'testimonial_image'  => $files,
                'testimonial_type'=>$testimonial_type
            );
               $this->event_model->insert_testimonial($data);
            $this->session->set_flashdata('success', 'Testimonial inserted Successfully');
            redirect('admin/home/testimonial');     
            }
            // $data=array(
                
            //     'testimonial_name' => $this->input->post('testimonial_name'),
            //     'testimonial_review' => $this->input->post('testimonial_review')
            // );
            
                  
        }
    }
    //////add vdo testimonial////////
        function add_vdo_testimonial(){ 
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $data["all_testimonial"] = $this->event_model->display_testimonial();
        //$data["all_course"] = $this->course_model->get_course();     
        $this->load->library('form_validation');
        //$this->form_validation->set_rules('testimonial_course','Course','required');
        $this->form_validation->set_rules('testimonial_title','Name','required');
        $this->form_validation->set_rules('testimonial_link','Post','required');

        if($this->form_validation->run()==FALSE){
            $this->load->view('admin/add-testimonial',$data);
        }
        else{
     
                $testimonial_type='2';
                $data=array(
                
                'testimonial_title' => $this->input->post('testimonial_title'),
                'testimonial_youtube_link' => $this->input->post('testimonial_link'),
                'testimonial_type'=>$testimonial_type
            );
               $this->event_model->insert_vdo_testimonial($data);
            $this->session->set_flashdata('success', 'Vdo Testimonial Added Successfully');
            redirect('admin/home/vdo_testimonial');     
            }
         
            
                  
       
    }
    /////close add vdo testimonial/////
    ///////////faq/////////
       function faq(){
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $this->data["all_faq"] = $this->event_model->display_faq();
        //$this->data["all_course"] = $this->course_model->get_course();
        $this->load->view('admin/add-faq', $this->data);
    }
    ///////close faq//////
    //////add faq///////
            function add_faq(){ 
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $data["all_faq"] = $this->event_model->display_faq();
        //$data["all_course"] = $this->course_model->get_course();     
        $this->load->library('form_validation');
        //$this->form_validation->set_rules('testimonial_course','Course','required');
        $this->form_validation->set_rules('faq_title','Name','required');
        $this->form_validation->set_rules('faq_description','Post','required');

        if($this->form_validation->run()==FALSE){
            $this->load->view('admin/add-faq',$data);
        }
        else
        {
          
                $data=array(
                
                'faq_title' => $this->input->post('faq_title'),
                'faq_description' => $this->input->post('faq_description'),
            );
            $this->event_model->insert_faq($data);
            $this->session->set_flashdata('success', 'Faq Added Successfully');
            redirect('admin/home/faq');     
            }
         
            
                  
       
    }
    //////close add faq/////
    /////slider start//////
    function slider()
    {
      $this->admin->start_session();
      if(!$this->admin->is_loggedin())
      {
        redirect('admin/home/login');
      }
      $this->data["all_slider"]=$this->event_model->display_slider();
      $this->load->view('admin/add-slider',$this->data);
    }
    /////close slider start////
    function testimonial(){
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $this->data["all_testimonial"] = $this->event_model->display_testimonial();
        //$this->data["all_course"] = $this->course_model->get_course();
        $this->load->view('admin/add-testimonial', $this->data);
    }
      function vdo_testimonial(){
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $this->data["all_testimonial"] = $this->event_model->display_vdo_testimonial();
        //$this->data["all_course"] = $this->course_model->get_course();
        $this->load->view('admin/add-vdo-testimonial', $this->data);
    }

    function testimonial_delete()
    {
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $this->event_model->testimonial_delete_status = 1;
        $testimonial_id=$this->input->post('testimonial_id');
        $this->event_model->delete_testimonial($testimonial_id);
        $this->session->set_flashdata('success', 'Testimonial deleted successfully');
        redirect('admin/home/testimonial');
    }
    ////////slider delete////////
     function slider_delete()
    {
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $this->event_model->slider_delete_status = 1;
        $slider_id=$this->input->post('slider_id');
        $this->event_model->delete_slider($slider_id);
        $this->session->set_flashdata('success', 'Slider deleted successfully');
        redirect('admin/home/slider');
    }
    ///////close slider delete//////
    ////vdo testimo delete////
       function vdo_testimonial_delete()
    {
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $this->event_model->testimonial_delete_status = 1;
        $testimonial_id=$this->input->post('vdo_testimonial_id');
        $this->event_model->delete_vdo_testimonial($testimonial_id);
        $this->session->set_flashdata('success', 'Vdo Testimonial deleted successfully');
        redirect('admin/home/vdo_testimonial');
    }
    ////close vdo testimo delete///
    ///////faq delete//////
   function faq_delete()
    {
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        //$this->course_model->delete_testimonial($testimonial_id);
        $this->event_model->faq_delete_status = 1;
        $faq_id=$this->input->post('faq_id');
        $this->event_model->delete_faq($faq_id);
        $this->session->set_flashdata('success', 'Faq deleted successfully');
        redirect('admin/home/faq');
    }
    /////close faq delete////////
    ///////start slider edit/////////
       function slider_edit($slider_id)
    {
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('slider_text', 'Name', 'required');
        if($this->form_validation->run() == FALSE)
      {
        $data["slider"]= $this->event_model->single_slider_id($slider_id);
        $data["all_slider"] = $this->event_model->display_slider();
        $this->load->view('admin/add-slider',$data);
    }
     else
      {
        $postedby='admin';
              
            $this->event_model->slider_text = $this->input->post('slider_text');
            //s$this->event_model->about_postedby = $postedby;
            if($_FILES['slider_image']['name'] != "")
         {
            $config['allowed_types'] = 'jpg|png|jpeg|JPG|JPEG|PNG';
            $config['upload_path'] = './uploads/slider';
            $config['file_name'] = 'direc'.time();
            $config['overwrite'] = false;
            $this->load->library('upload', $config);
            $this->upload->do_upload('slider_image');
            $logo = $this->upload->data();
            $this->event_model->slider_image =$logo['file_name'];
         }
            $this->event_model->update_slider($slider_id);
            $this->session->set_flashdata('success', 'Slider Updated successfully');
            redirect('admin/home/slider');
      }
    }
    //////close slider edit////////
    function testimonial_edit($testimonial_id)
    {
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('testimonial_name', 'Name', 'required');
        if($this->form_validation->run() == FALSE)
      {
        $data["testimonial"]= $this->event_model->single_testimonial_id($testimonial_id);
        $data["all_testimonial"] = $this->event_model->display_testimonial();
        $this->load->view('admin/add-testimonial',$data);
    }
     else
      {
        $postedby='admin';
              
            //$this->event_model->about_dr_moinu = $this->input->post('about_moinu');
            $this->event_model->testimonial_name = $this->input->post('testimonial_name');
             $this->event_model->testimonial_review = $this->input->post('testimonial_review');
            //s$this->event_model->about_postedby = $postedby;
            if($_FILES['user_image']['name'] != "")
         {
            $config['allowed_types'] = 'jpg|png|jpeg|JPG|JPEG|PNG';
            $config['upload_path'] = './uploads/testimonial';
            $config['file_name'] = 'direc'.time();
            $config['overwrite'] = false;
            $this->load->library('upload', $config);
            $this->upload->do_upload('user_image');
            $logo = $this->upload->data();
            $this->event_model->testimonial_image =$logo['file_name'];
         }
            $this->event_model->update_testimonial($testimonial_id);
            $this->session->set_flashdata('success', 'Testimonial Updated successfully');
            redirect('admin/home/testimonial');
      }
    }
    //////vdo testimonial edit/////
      function vdo_testimonial_edit($testimonial_id)
    {
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('testimonial_title', 'Name', 'required');
        if($this->form_validation->run() == FALSE)
      {
        $data["testimonial"]= $this->event_model->single_testimonial_id($testimonial_id);
        //print_r($data["testimonial"]);exit;
        $data["all_testimonial"] = $this->event_model->display_vdo_testimonial();
        $this->load->view('admin/add-vdo-testimonial',$data);
    }
     else
      {
        $postedby='admin';
            $this->event_model->testimonial_title = $this->input->post('testimonial_title');
            $this->event_model->testimonial_youtube_link = $this->input->post('testimonial_link');
            $this->event_model->update_testimonial($testimonial_id);
            $this->session->set_flashdata('success', 'Vdo Testimonial Updated successfully');
            redirect('admin/home/vdo_testimonial');
      }
    }
    /////close vdo testimonial edit//////
///////////faq edit///////////
        function faq_edit($faq_id)
    {
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('faq_title', 'Name', 'required');
        if($this->form_validation->run() == FALSE)
        {
        $data["faq"]= $this->event_model->single_faq_id($faq_id);
        $data["all_faq"] = $this->event_model->display_faq();
        $this->load->view('admin/add-faq',$data);
        }
     else
      {
        //$postedby='admin';
              
            //$this->event_model->about_dr_moinu = $this->input->post('about_moinu');
            $this->event_model->faq_title = $this->input->post('faq_title');
            $this->event_model->faq_description = $this->input->post('faq_description');
            $this->event_model->update_faq($faq_id);
            $this->session->set_flashdata('success', 'Faq Updated successfully');
            redirect('admin/home/faq');
      }
    }
    ///////close faq edit//////
    // function testimonial_update($testimonial_id)
    // {
    //     $this->admin->start_session();
    //     if(!$this->admin->is_loggedin())
    //     {
    //       redirect('admin/home/login');
    //     }

    //     $data = array(
    //         'testimonial_course' => $this->input->post('testimonial_course'),
    //         'testimonial_name' => $this->input->post('testimonial_name'),
    //         'testimonial_sourse' => $this->input->post('testimonial_sourse'),
    //         'testimonial_review' => $this->input->post('testimonial_review')
    //     );
    //     $this->course_model->update_testimonial($testimonial_id, $data);
    //     $this->session->set_flashdata('success', 'Testimonial updated successfully');
    //     redirect('admin/home/testimonial');
    // }
  
    /*function testimonial_status()
    {
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $testimonial_status = $this->input->post('status');
        $testimonial_id = $this->input->post('id');
        $this->course_model->update_testimonial_status($testimonial_id,$testimonial_status);
    }*/

    function enquiry(){
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $this->data["all_enquiry"] = $this->event_model->get_all_enquiry();
        $this->load->view('admin/enquiry', $this->data);
    }

    function batch_register(){
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $this->data["batch_register"] = $this->course_model->get_all_batch_register();
        $this->load->view('admin/batch_register', $this->data);
    }

    function get_category()
    {
        $cate_id = $this->input->post('cate_id');
        $this->data['cate']= $this->course_model->get_category($cate_id);
        $this->load->view('admin/menu',$this->data);
    }

    function get_courses()
    {        
        $category = $this->input->post('category');
        $course = $this->course_model->get_course_by_category($category);
        echo json_encode($course);            
    }

    function header_menu()
    {
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $this->data["header_menu_category"] = $this->course_model->get_category(); 
        $this->data["header_menu_course"] = $this->course_model->get_course();
        $this->data["header_menu"] = $this->course_model->display_header_menus();        
        $this->load->view('admin/add-header-menu', $this->data);
    }

    function add_header_menu()
    {
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $data["header_menu_category"] = $this->course_model->get_category(); 
        $data["header_menu_course"] = $this->course_model->get_course();
        $data["header_menu"] = $this->course_model->display_header_menus();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('category','Category','required');
        $this->form_validation->set_rules('level_one','Level One','required');
        $this->form_validation->set_rules('header_priority','Priority','required');

        if($this->form_validation->run()==FALSE)
        {
            $this->load->view('admin/add-header-menu',$data);
        }
        else
        {
            $header_course = implode(",", $this->input->post('level_one'));
            $data = array(
                'header_category' => $this->input->post('category'),
                'header_course' => $header_course,
                'header_priority' => $this->input->post('header_priority')
            );
            $this->course_model->insert_header_menu($data);
            $this->session->set_flashdata('success', 'Header menu inserted successfully');
            redirect('admin/home/header_menu');
        }
    }

    function header_menu_delete($id)
    {
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $this->course_model->delete_header_menu($id);
        $this->session->set_flashdata('success', 'Header menu Deleted successfully');
        redirect('admin/home/header_menu');
    }

    function header_menu_edit($id)
    {
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $this->data['header_menu']= $this->course_model->single_header_menu_id($id);
        $this->data["header_menu_category"] =$this->course_model->get_category(); 
        $this->data["header_menu_course"] = $this->course_model->get_course();
        $this->load->view('admin/update-header-menu',$this->data);
    }
    
    function header_menu_update($id)
    {
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $header_course = implode(",", $this->input->post('level_one'));
        $data = array(
           'header_category' => $this->input->post('category'),
            'header_course' => $header_course,
            'header_priority' => $this->input->post('header_priority')
        );
        $this->course_model->update_header_menu($id, $data);
        $this->session->set_flashdata('success', 'Header menu updated successfully');
        redirect('admin/home/header_menu');
    }

    function header_menu_status()
    {
        $header_menu_status = $this->input->post('status');
        $header_menu_id = $this->input->post('id');
        $this->course_model->update_header_menu_status($header_menu_id,$header_menu_status);
    }

    function footer_menu()
    {
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $this->data["footer_menu_category"] = $this->course_model->get_category(); 
        $this->data["footer_menu_course"] = $this->course_model->get_course();
        $this->data["footer_menu"] = $this->course_model->display_footer_menus();
        $this->load->view('admin/add-footer-menu', $this->data);
    }

    function add_footer_menu()
    {
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $data["footer_menu_category"] = $this->course_model->get_category(); 
        $data["footer_menu_course"] = $this->course_model->get_course();
        $data["footer_menu"] = $this->course_model->display_footer_menus();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('category','Category','required');
        $this->form_validation->set_rules('level_one','Level One','required');

        if($this->form_validation->run()==FALSE)
        {
            $this->load->view('admin/add-footer-menu',$data);
        }
        else
        {
            $footer_course = implode(",", $this->input->post('level_one'));
            $data = array(
               'footer_category' => $this->input->post('category'),
                'footer_course' => $footer_course
            );
            $this->course_model->insert_footer_menu($data);
            $this->session->set_flashdata('success', 'Footer menu inserted successfully');
            redirect('admin/home/footer_menu');
        }
    }

    function footer_menu_delete($id)
    {
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $this->course_model->delete_footer_menu($id);
        $this->session->set_flashdata('success', 'Footer menu Deleted successfully');
        redirect('admin/home/footer_menu');
    }

    function footer_menu_edit($id)
    {
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $this->data['footer_menu']= $this->course_model->single_footer_menu_id($id);
        $this->data["footer_menu_category"] = $this->course_model->get_category(); 
        $this->data["footer_menu_course"] = $this->course_model->get_course();
        $this->load->view('admin/update-footer-menu',$this->data);
    }
    
    function footer_menu_update($id)
    {
        $this->admin->start_session();
        if(!$this->admin->is_loggedin())
        {
          redirect('admin/home/login');
        }
        $footer_course = implode(",", $this->input->post('level_one'));
        $data = array(
           'footer_category' => $this->input->post('category'),
            'footer_course' => $footer_course
        );
        $this->course_model->update_footer_menu($id, $data);
        $this->session->set_flashdata('success', 'Footer menu updated successfully');
        redirect('admin/home/footer_menu');
    }

    function footer_menu_status()
    {
        $footer_menu_status = $this->input->post('status');
        $footer_menu_id = $this->input->post('id');
        $this->course_model->update_footer_menu_status($footer_menu_id,$footer_menu_status);
    }

    public function language_count_and_get($add_more_length = 1) {
        $id = $this->input->post('id');
        $result = $this->course_model->language_count_and_get($id);
        $languages_count = sizeof(explode(",",$result['course_language']));
        $languages = explode(",",$result['course_language']);
        $html = "";
        $i = 0;
         for($i=0;$i<$languages_count;$i++) {
          $html .= 
                    '<div class="module-form">
                        <p id="language">
                           '.$languages[$i].'
                        </p>
                        <div class="j-span3 j-unit">
                        <div class="j-input">
                            <input type="hidden" name="course" value="'.$result['course_id'].'">
                            <input type="hidden" name="module_language[]" value="' .$languages[$i].'">
                            <input type="text" class="module_name_value" id="course_module['.$i.'][module_title]" name="course_module['.$i.'][module_title]" placeholder="Module 1" value="" >
                            <span class="j-tooltip j-tooltip-right-top">Module1</span>
                        </div>
                    </div>
                    <div class="j-span3 j-unit">
                        <div class="j-input j-append-small-btn">
                            <div class="j-file-button">
                                Browse
                                <input type="file" name="course_module['.$i.'][module_pdf]">
                            </div>
                            <input type="text" id=" name="module_pdf" readonly="" placeholder="Add Course Pdf">
                        </div>
                    </div>
                    <div class="j-row">
                        <div class="j-span3 j-unit">
                            <div class="j-input">
                                <input type="text" id="module_video_url[]" name="course_module['.$i.'][module_url]" placeholder="Youtube Url" value="">
                                <span class="j-tooltip j-tooltip-right-top">Youtube Video Url</span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <a href="javascript:void(0);" class="add_button" title="Add field" style="margin-top: 26px;float: left;"></a>
                            </div>
                        </div>
                        <div class="">
                            <button type="button" class="btn-link addSubModule" style="margin-top: 26px;float: left;">Add Sub Module</button>
                        </div>
                    </div>

                    <!-- end name -->
                    <div class="divider gap-bottom-25"></div>
                        <div class="j-response"></div>
                        <!-- end response from server -->
                    </div>
                    <div id="sub_module_form">

                    </div>
                    ';
                    
        } 
        $addMoreHtml = '
            <div class="pull-right">
                <button type="button" class="btn btn-link" onclick="addMoreModule('.$id.')">Add More Module</button>
            </div>';

        $result['languages'] = explode(",", $result['course_language']);
        echo $html.$addMoreHtml;
    }
    
    public function add_module() {
        $count = count($this->input->post('course_module'));exit;
        $module_language = $this->input->post('module_language');
        $module_title = $this->input->post('module_title');
        $module_video = $this->input->post('module_video_url');
          
        if(!empty($_FILES['module_pdf']['name']))
        {
           $filesCount = count($_FILES['module_pdf']['name']);
           for($i = 0; $i < $filesCount; $i++)
           {
               $_FILES['userFile']['name']     = $_FILES['module_pdf']['name'][$i];
               $_FILES['userFile']['type']     = $_FILES['module_pdf']['type'][$i];
               $_FILES['userFile']['tmp_name'] = $_FILES['module_pdf']['tmp_name'][$i];
               $_FILES['userFile']['error']    = $_FILES['module_pdf']['error'][$i];
               $_FILES['userFile']['size']     = $_FILES['module_pdf']['size'][$i];

               $uploadPath = './uploads/modules/pdf';
               $config['upload_path'] = $uploadPath;
               $config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|JPEG|PNG|JPG';
               $time = time();
               $config['file_name'] = "MOINU_".$time;
               $config['overwrite'] = false;

               $this->load->library('upload', $config);
               $this->upload->initialize($config);
               if($this->upload->do_upload('userFile'))
               {
                   $fileData = $this->upload->data();
                   $inser_array[$i]['course_id']        = $this->input->post('course');
                   $inser_array[$i]['module_language']  = $module_language[$i];
                   $inser_array[$i]['module_pdf']       = $fileData['file_name'];
                   $inser_array[$i]['module_title']     = $module_title[$i];
                   $inser_array[$i]['module_video_url'] = $module_video[$i]; 
               }
           }
            //    die(print_r($inser_array));
           $this->course_model->insert_batch('tbl_modules',$inser_array);
           redirect('admin/home/course_module');
       } 
    }
}
