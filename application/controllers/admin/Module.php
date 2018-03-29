<?php 
    class Module extends CI_Controller {
        public function show() {
            $this->admin->start_session();
            
            if(!$this->admin->is_loggedin()) {
                redirect('admin/home/login');
            }
            $data["courses"] = $this->event_model->get_courses();
            
            $this->load->view('admin/add_module',$data);
        }
        public function create() {
            // public function add_module() {
          $course_id = $this->input->post('course_id');
            $module  = $_POST['course_module'];
                //print_r($module);exit;
          foreach ($module as $key => $array1) 
          {
            //print_r($array1);exit;
            foreach ($array1 as $key2 => $array2) 
            {
                
                $array = array('course_id'=>$course_id  ,'module_language'=>$key,'module_name'=>$array2['module_title']);
                $module_id = $this->tbl_function->insert('tbl_modules',$array);                
                foreach ($array1['module_url'] as $key3 => $value) 
                {

                  $ins_array = array('course_id'=>$course_id  ,'module_id'=>$module_id,'contenet '=>$value,'chapter_language_id'=>$key);
                  $this->tbl_function->insert('tbl_chapters',$ins_array);
                }


                
            }
          }

                  // die(print_r($_FILES));
              /*  $language_count = count($_POST['course_module']);
                // echo $language_count;
                for($i = 0; i < $language_count; $i++) {
                  $modulecount = 0;
                  // $module_count = $_POST['']
                }

                // echo count($this->input->post('course_module'));
                // $count = count($this->input->post('course_module'));exit;
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
               } */
            // }
        }
        public function get_languages() {
            $data['languages'] = $this->course_model->get_languages();
            echo json_encode($data);
        }
        public function language_count_and_get() {
            $id = $this->input->post('id');
            $result = $this->course_model->language_count_and_get($id);
            $languages_count = sizeof(explode(",",$result['course_language']));
            $languages = explode(",",$result['course_language']);
            $html = "";
            $i = 0;
             for($i=0;$i<$languages_count;$i++) {
              $html .=  '<div class="module-form">
                            <p id="language">
                               '.$languages[$i].'
                            </p>
                            <div class="j-span10 j-unit">
                            <div class="j-input">
                            <input type="hidden" name="course_id" value='.$id.'>
                                <input type="text" class="module_name_value" name="course_module['.$languages[$i].'][0][module_title]" placeholder="Module Title">
                                <span class="j-tooltip j-tooltip-right-top">Module1
                                </span>
                            </div>
                        </div>
                        <div class="j-row">
                            <div class="j-span4 j-unit">
                            <div class="j-input j-append-small-btn">
                                <div class="j-file-button">
                                    Browse
                                    <input type="file" name="course_module['.$languages[$i].'][module_file][]">
                                </div>
                                <input type="text" id=" name="module_pdf" readonly="" placeholder="Add Course Pdf">
                            </div>
                        </div>
                            <div class="j-span4 j-unit">
                                <div class="j-input">
                                    <input type="text" id="module_video_url[]" name="course_module['.$languages[$i].'][module_url][]" placeholder="Youtube Url" value="">
                                    <span class="j-tooltip j-tooltip-right-top">Youtube Video Url</span>
                                </div>
                            </div>

                            <div class="j-span3 j-unit">
                                <button type="button" class="btn-link add" style="margin-top: 26px;float: left;" data-language='.$languages[$i].' data-olaka=0>Add</button>
                            </div>

                            <div class="">
                                <button type="button" class="btn-link addMore style="margin-top: 26px;float: left;" data-language='.$languages[$i].' data-olaka=0>Add More</button>
                            </div>
                        </div>
    
                        <!-- end name -->
                        <div class="divider gap-bottom-25"></div>
                            <div class="j-response"></div>
                            <!-- end response from server -->
                        </div>
                        <div id="sub_module_form">
    
                        </div>';
            } 
    
            $result['languages'] = explode(",", $result['course_language']);
            echo $html;
        }
        
    }