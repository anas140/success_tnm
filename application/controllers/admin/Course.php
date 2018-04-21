<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Course extends CI_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->model('course_model');
            $this->load->model('event_model');
            $this->load->model('admin');
            $this->load->library('session'); // Start Session   
        }
        public function course() {
            $this->admin->start_session();
            if(!$this->admin->is_loggedin())
            {
              redirect('admin/home/login');
            }
            $data["all_course"] = $this->course_model->display_course();
            $data["language"] = $this->course_model->get_all_language();

            $this->load->view('admin/add-course', $data);
        }

        function course_edit($course_id) {
        $this->admin->start_session();
        if(!$this->admin->is_loggedin()) {
            redirect('admin/home/login');
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('course_name', 'Name', 'required');
        if($this->form_validation->run() == FALSE) {
            $data["all_course"] = $this->course_model->display_course();
            $data["single_course"]= $this->course_model->single_course_id($course_id);
            $this->load->view('admin/add-course',$data);
        } else {
            //$postedby='admin';
            $this->course_model->course_name = $this->input->post('course_name');
			$this->course_model->course_description = $this->input->post('course_description');
			$this->course_model->course_duration = $this->input->post('course_duration');
			$this->course_model->course_rate = $this->input->post('course_rate');
			$this->course_model->course_renewal_rate = $this->input->post('renewal_rate');
			$this->course_model->course_top_status = $this->input->post('top_course');
			$this->course_model->course_language = $this->input->post('course_language');
            if($_FILES['course_image']['name'] != "")
         {
            $config['allowed_types'] = 'jpg|png|jpeg|JPG|JPEG|PNG';
            $config['upload_path'] = './uploads/course';
            $config['file_name'] = 'direc'.time();
            $config['overwrite'] = false;
            $this->load->library('upload', $config);
            $this->upload->do_upload('course_image');
            $logo = $this->upload->data();
            $this->course_model->course_image =$logo['file_name'];
         }
            $this->course_model->update_course($course_id);
            $this->session->set_flashdata('success', 'Course Updated successfully');
            redirect('admin/home/course');
      }
    }
    }