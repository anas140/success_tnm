<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('course_model');
        $this->load->model('site_model');
        $this->load->model('event_model');
    }

	public function index()
	{
		// $data['category'] = $this->course_model->get_category(); 
  //       $data['seo'] = $this->course_model->get_category(); 
		// $data['courses'] = $this->site_model->display_home_course(); 
  //       $data['all_batch'] = $this->site_model->display_batch();
		// $this->load->view('homepage', $data);
	}
    public function all_events()
    {
        $data['all_events']=$this->site_model->display_events();
        echo json_encode($data);
    }
    public function recent_events()
    {
        $data['recent_events']=$this->site_model->recent_events();
        echo json_encode($data);
    }
    public function all_blogs()
    {
        $data['all_blogs']=$this->site_model->display_blog();
        echo json_encode($data);
    }
    public function all_vdo_testimonials()
    {
        $data['all_vdo_testimonials']=$this->site_model->display_vdo_testimonial();
        echo json_encode($data);
    }
    public function all_text_testimonials()
    {
       $data['all_text_testimonials']=$this->site_model->display_text_testimonial();
       echo json_encode($data);
    }
    function register_user()
    {   
        $register_date=date('Y-m-d');
        $name=$this->site_model->register_firstname = $this->input->post('register_firstname');
        $this->site_model->register_lastname = $this->input->post('register_lastname');
        $this->site_model->register_nationality = $this->input->post('register_nationality');
        $this->site_model->register_location = $this->input->post('register_location');
        $this->site_model->register_dob = date("Y-m-d",strtotime($this->input->post('register_dob')));
        $this->site_model->register_gender = $this->input->post('register_gender');
        $this->site_model->register_mobile = $this->input->post('register_mobile');
        $email=$this->site_model->register_email = $this->input->post('register_email');
        $this->site_model->register_username = $this->input->post('register_username');
        $register_password=$this->site_model->register_password = $this->input->post('register_password');
        $hash = password_hash($register_password, PASSWORD_DEFAULT);
        $this->site_model->register_password = $hash;
        $this->site_model->register_date = $register_date;
        $register_id=$this->site_model->insert_register();
        $this->session->set_userdata('register_id',$register_id);
        $this->site_model->start_session();   
         $config = array(
          'protocol' => 'smtp', 
          'smtp_host' => 'ssl://smtp.googlemail.com',
          'smtp_port' => 465,
          'smtp_user' => 'keltronsarutty@gmail.com', 
          'smtp_pass' => 'phpdeveloper', 
          'mailtype' => 'html', 
          'smtp_timeout' => '4',
          'charset' => 'iso-8859-1'
        );

    $this->load->library('email',$config);
    $this->email->set_newline("\r\n");
    $this->email->set_mailtype("html");
    $this->email->from('keltronsarutty@gmail.com', 'moinu');
    $this->email->to($email); 
    $this->email->subject('Confirmation from Online academi');
    $data['name'] = $name;
    $data['email'] = $email;
    $data['password'] = $register_password;
    //$body=$this->load->view('mail/signup_mail',$data,TRUE);
    //$this->email->message($body);
    //$this->email->send();
    }
        function login()
  {
     $register_username=$this->input->post('username');
     $register_password=$this->input->post('password'); 
    if ($this->site_model->user_check($register_username, $register_password )) 
    {

       $register_id=$this->site_model->register_id;
      if($register_id>0)
      {             
        $this->session->set_userdata('register_id',$register_id);
        //$this->session->set_userdata('userId',$register_id);
        $this->site_model->start_session();                        
        //redirect($header_type);
      }
    } 
    else 
    {
       //redirect($header_type);
    }
  }
	 // public function inquiry() {
  
  //       $name = $this->input->post('name');
  //       $sender_email = $this->input->post('email');
  //       $code =$this->input->post('code');
  //       $phone =$this->input->post('phone');
  //       $course =$this->input->post('course');
  //       if($this->input->post('tick_check') != "")
  //       	$tick_check = 1;
  //       else
  //       	$tick_check = 0;

  //       $data = array(
  //       'inquiry_name' => $name ,
  //       'inquiry_email' => $sender_email,
  //       'inquiry_code' => $code,
  //       'inquiry_phone' => $phone,
  //       'inquiry_course' => $course,
  //       'inquiry_subscribe' => $tick_check
  //       );

  //       $this->site_model->insert_inquiry($data);   
        
  //       $receiver_email = 'info@timeseducationuae.com';
  //       $subject = 'New enquiry has been recieved';
        
  //       $mail_data['sender_name'] = $name;
  //       $mail_data['sender_email'] = $sender_email;
  //       $mail_data['sender_code'] = $code;
  //       $mail_data['sender_phone1'] = $phone;
  //       $mail_data['sender_course'] = $course; 
  //       $mail_data['caption'] = "Enquiry Details";      

  //       $config = Array(
  //            'protocol' => 'smtp',
  //            'smtp_host' => 'smtp.gmail.com.',
  //            'smtp_port' => 465,
  //            'smtp_user' => 'keltronsarutty@gmail.com', 
  //            'smtp_pass' => 'phpdeveloper', 
  //            'mailtype' => 'html',
  //            'charset' => 'iso-8859-1',
  //            'wordwrap' => TRUE
  //         ); 

  //       $this->load->library('email', $config);
  //       $this->email->set_newline("\r\n");
  //       $this->email->set_header('MIME-Version', '1.0; charset=utf-8'); 
  //       $this->email->set_header('Content-type', 'text/html'); 

  //       $this->email->from($sender_email, $name);
  //       $this->email->to($receiver_email);
  //       $this->email->subject($subject);
  //       $body=$this->load->view('mail-temp',$mail_data,TRUE);
  //       $this->email->message($body);

  //       if ($this->email->send()) {
            
  //           echo 'success';    
  //       } 
  //       else{
  //           $this->session->set_flashdata("error","Error in sending Email."); 
  //           echo 'fail';
  //       }
  //   }

  //   function course($course_slug)
  //   {
  //       $data['category'] = $this->course_model->get_category(); 
  //       $data['courses'] = $this->site_model->display_home_course();
  //       $data['course_details'] = $this->site_model->single_course_id($course_slug);
  //       $this->load->view('course_details', $data);
        
  //   }
    
  //   function search()
  //   {
  //       $search_item = $this->input->post('search_item');
  //       $data['course_details'] = $this->site_model->header_search($search_item);
  //       $data['category'] = $this->course_model->get_category(); 
  //       $data['courses'] = $this->site_model->display_home_course();
  //       if(!empty($data['course_details'])) {
  //           $this->load->view('course_details', $data);
  //       } else {
  //           redirect('home/index');
  //       }
  //   }

}
