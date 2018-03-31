<?php 
    class Module_model extends CI_Model {
        public function __cinstruct() {
            parent::construct();
            $this->load->database();
        }
        public function get_modules_by_course($id) {
        	$this->db->select('
        		 tbl_modules.module_id, 
        		 tbl_course.course_name, 
        		 tbl_languages.language_name, 
        		 tbl_modules.module_name,
        		 tbl_modules.updated_at
        		')->from('tbl_modules');
        	$this->db->join('tbl_course', "tbl_course.course_id = tbl_modules.course_id");
        	$this->db->join('tbl_languages','FIND_IN_SET(tbl_languages.language_id, tbl_course.course_language)', 'left');
        	$this->db->where('tbl_course.course_id', $id);
        	$this->db->get();
        	echo $this->db->last_query();
        }


    }