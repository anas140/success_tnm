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
        		 tbl_course.course_id, 
        		 tbl_languages.language_name, 
        		 tbl_modules.module_name,
        		 tbl_modules.updated_at
        		')->from('tbl_modules');
        	
        	$this->db->join('tbl_course', "tbl_course.course_id = tbl_modules.course_id", "left");
        	$this->db->join('tbl_languages','FIND_IN_SET(tbl_languages.language_id, tbl_modules.module_language)', 'left');
        	$this->db->where('tbl_course.course_id', $id);
        	$this->db->order_by('tbl_modules.module_id', "asc");
        	$query = $this->db->get();
        	return $query->result_array();
        	// echo $this->db->last_query();
        }

        /* Delete Module */
        public function delete_module($id) {
        	$this->db->where('module_id', $id);
        	$this->db->delete('tbl_modules');
        	if($this->db->affected_rows() == 1) {
        		return TRUE;
        	}
        	else { 
        		return FALSE;

        	}
        }

    }