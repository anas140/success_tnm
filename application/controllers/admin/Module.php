<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
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
            //print_r($_FILES);exit;
            $course_id    = $this->input->post('course_id');
            $module       = $_POST['course_module'];
            $module_file  = $_FILES['course_module']['name'];
           //print_r($module_file);exit;
            $filesCount = count($module_file);


            foreach ($module as $key => $array1) 
            {
              foreach ($array1 as $key1 => $array2) // array 2 = tmp_array, 
              {
                if(!empty($array2['module_title'])) {
                  $array = array(
                    'course_id'       => $course_id, 
                    'module_language' => $key,
                    'module_name'     => $array2['module_title']
                  );
                  $module_id = $this->tbl_function->insert('tbl_modules',$array);  
                }
                
                foreach ($module_file[$key][$key1] as $files) 
                {
                  $i=0;
                  //print_r($files);exit;
                 foreach ($files as $img) 
                 {
                   
                    $_FILES['pdf']['name']      = $_FILES['course_module']['name'][$key][$key1]['module_file'][$i];
                    $_FILES['pdf']['type']       = $_FILES['course_module']['type'][$key][$key1]['module_file'][$i];
                    $_FILES['pdf']['tmp_name'] = $_FILES['course_module']['tmp_name'][$key][$key1]['module_file'][$i];
                    $_FILES['pdf']['size'] = $_FILES['course_module']['size'][$key][$key1]['module_file'][$i];

                    $uploadPath = './uploads/modules/pdf';
                    $config['upload_path'] = $uploadPath;
                    $config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|JPEG|PNG|JPG';
                    $time = time();
                    $config['file_name'] = "MOINU_".$time;
                    $config['size']      = 0 ;
                    $config['overwrite'] = false;
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if($this->upload->do_upload('pdf'))
                    {
                       $fileData = $this->upload->data();
                       $ins_array = array(
                      'course_id' => $course_id,
                      'module_id' => $module_id,
                      'content'  =>  $fileData['file_name'],
                      'chapter_language_id'=>$key,
                      'content_type'=>0
                     );
                     $this->tbl_function->insert('tbl_chapters',$ins_array);
                    }
                    $i++;
                  }
                }
                

                
                foreach ($array2['module_url'] as $value) 
                {
                  if(!empty($value)) {

                  $ins_array = array(
                    'course_id' => $course_id,
                    'module_id' => $module_id,
                    'content'  => $value,
                    'chapter_language_id'=>$key,
                    'content_type'=>1
                  );
                  $this->tbl_function->insert('tbl_chapters',$ins_array);

                  }
                 
                }
              }
            }
          }
        public function get_languages() {
            $data['languages'] = $this->course_model->get_languages();
            echo json_encode($data);
        }
        public function language_count_and_get() {
            $id = $this->input->post('id');
            $result = $this->course_model->language_count_and_get($id);
            $languages_count = sizeof($result);
            $html = "";

            $i = 0;
             for($i=0; $i<$languages_count; $i++) {
              $html .=  '<div class="module-form">
                            <p id="language">
                               '.ucfirst($result[$i]['language_name']).'
                            </p>
                            <div class="j-span10 j-unit">
                            <div class="j-input">
                            <input type="hidden" name="course_id" value='.$id.'>
                                <input type="text" class="module_name_value" name="course_module['.$result[$i]['language_id'].'][0][module_title]" placeholder="Module Title">
                                <span class="j-tooltip j-tooltip-right-top">Module1
                                </span>
                            </div>
                        </div>
                        <div class="j-row">
                            <div class="j-span4 j-unit">
                            <div class="j-input j-append-small-btn">
                                <div class="j-file-button">
                                    Browse
                                    <input type="file" name="course_module['.$result[$i]['language_id'].'][0][module_file][]">
                                </div>
                                <input type="text" id=" name="module_pdf" readonly="" placeholder="Add Course Pdf">
                            </div>
                        </div>
                            <div class="j-span4 j-unit">
                                <div class="j-input">
                                    <input type="text" id="module_video_url[]" name="course_module['.$result[$i]['language_id'].'][0][module_url][]" placeholder="Youtube Url" value="">
                                    <span class="j-tooltip j-tooltip-right-top">Youtube Video Url</span>
                                </div>
                            </div>

                            <div class="j-span3 j-unit">
                                <button type="button" class="btn btn-primary add" style="float: left;" data-language='.$result[$i]['language_id'].' data-olaka=0>
                                  +
                                </button>
                            </div>

                            <div class="">
                                <button type="button" class="btn-small addMore style="margin-top: 4px;float: left;" data-language='.$result[$i]['language_id'].' data-olaka=0>Add More</button>
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
    
            echo $html;
        }

        public function get_modules_by_course() {
          $id = $this->input->post('id');
          $result = $this->module_model->get_modules_by_course($id);
          // echo $result->result();
          // print_r($result);
          echo json_encode($result);
        }

        // delete module
        public function delete_module() {
          $module_id = $this->input->post('id');
          $result = $this->module_model->delete_module($module_id);
          echo $result;
        }

        // update Module
        public function update_module() {
          $module_id = $this->input->post('id');
          $module_title = $this->input->post('title');
          $result = $this->module_model->update_module($module_id, $module_title);
          echo $result;
        }

        // get chapters by module
        public function get_chapters() {
          $module_id = $this->input->post('id');
          $result = $this->module_model->get_chapters($module_id);
          // echo $result;
          echo json_encode($result);
        }

        // delete chapter
        public function delete_chapter() {
          $chapter_id = $this->input->post('id');
          $result = $this->module_model->delete_chapter($chapter_id);
          echo $result;
        } 
        // Create Chapters In Modal
        public function create_chapter() {
          // print_r($_POST);exit;
          // print_r($_FILES);exit;
          $count = count($this->input->post('module_url'));
          // echo $count;exit;
          $module_url = $this->input->post('module_url');
          $module_id = $this->input->post('module_id');
          $language_id = $this->input->post('language_id');
          $course_id = $this->input->post('course_id');

          $data = array();

          for($i = 0; $i < $count; $i++) {
            $data[$i] = array(
                'module_id' => $module_id,
                'course_id' => $course_id,
                'chapter_language_id' => $language_id,
                'content' => $module_url[$i],
                'content_type' => 1, //pdf
            );
          }
          // $this->
          
          // $data = array(
          //     'module_id' => 
          // );
          $result = $this->module_model->insert_chapters($data);
          print_r($result); exit;

        }
        
    }