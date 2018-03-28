<?php 
    class Module_model extends CI_Model {
        public function __cinstruct() {
            parent::construct();
            $this->load->database();
        }
        

    }