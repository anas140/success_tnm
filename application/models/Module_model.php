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

        /* Update Model */
        public function update_module($id, $title) {
          $this->db->set('module_name', $title);
          $this->db->set('updated_at', date('Y-m-d H:i:s'));
          $this->db->where('module_id', $id);
          $this->db->update('tbl_modules');
          if($this->db->affected_rows() == 1) {
          	return TRUE;
          } else {
          	return FALSE;
          }
        }

        /* Get chapters by module_id */
        public function get_chapters($id) {
        	$this->db->select('chapter_id,module_id, content, content_type');
        	$this->db->where('module_id', $id);
        	$query = $this->db->get('tbl_chapters');
        	$result = $query->result_array();
        	return $result;
        }

        /* Delete Chapter */
        public function delete_chapter($id) {
          $this->db->where('chapter_id', $id);
          $result = $this->db->delete('tbl_chapters');
          return $result;
        }


    }