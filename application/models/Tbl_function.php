<?php
class Tbl_function extends CI_Model
{

  function search_all_by_value($select,$tbl_name,$fldname,$match,$options=''){
    $this->db->select($select)->from($tbl_name);
    $this->db->where($fldname." LIKE '%".$match."%'"); 
    if(!empty($options)){
      $this->db->where($options);
    }
    $this->db->order_by($fldname, 'asc');
    $query = $this->db->get();
    //echo $this->db->last_query();exit;
    return $query->result();
  }
	
  function get_name_from_id($id,$tblname,$match_fld,$return_fld)
  {
      $sql="SELECT * FROM $tblname WHERE $match_fld='$id'";
      $query = $this->db->query($sql);
      //echo $this->db->last_query();
      $row = $query->row(); 
      $Result_No = $this->db->count_all($tblname);
    
      if($Result_No>0)
      {
      $NAME = $row->$return_fld;
          return $NAME;exit;
      }
      else
      {
          return false;
      }

  }


  function is_Exist($tblname,$fldname,$checkvalue)
  {
  $CHECK="SELECT * FROM $tblname WHERE $fldname='$checkvalue'";

    $EXEC_CHECK=@$this->db->query($CHECK);
    //echo $this->db->last_query();
    $rowcount =$EXEC_CHECK->num_rows();
    if($rowcount>0)
    {
      return true;
    }
    else
    {
      return false;
    }
  }
  
  
  function get_branch_name($branch_id)
  {
    $this->db->select('tbl_city.city_name')->from('tbl_shop_branch');
    $this->db->join('tbl_city','tbl_city.city_id=tbl_shop_branch.branch_city','left');
    $this->db->where('tbl_shop_branch.branch_id', $branch_id);
    $query = $this->db->get();
    return $query->row();
  }



  function send_mail_temp($sender_id,$sender_name,$message_type,$message,$receiver_id){
    
     $sender_email=$this->get_name_from_id($sender_id,'tbl_user','user_matrimony_id','user_email');
     $receiver_name=$this->get_name_from_id($receiver_id,'tbl_user','user_matrimony_id','user_name');
     $receiver_email=$this->get_name_from_id($receiver_id,'tbl_user','user_matrimony_id','user_email');

      // email
      $config = array(
	        'protocol' => 'smtp', 
	        'smtp_host' => 'ssl://smtp.googlemail.com',
	        'smtp_port' => 465,
	        'smtp_user' => 'info@evamatrimony.com', 
	     	'smtp_pass' => 'prijeshshaijueva', 
	        'mailtype' => 'html', 
	        'smtp_timeout' => '4',
	        'charset' => 'iso-8859-1'
        );
 
        $data['receiver_id'] = $receiver_id;
        $data['name'] = $sender_name;
        $data['matri_id'] = $sender_id;
        $data['receiver_name']=$receiver_name;
        $this->load->library('email',$config);
        $this->email->set_newline("\r\n");
        $this->email->set_mailtype("html");
        $this->email->from($sender_email, $sender_name);
        $this->email->to($receiver_email); 

        if($message_type=='1'){
          $data['header_msg'] = 'You have received new interest';
          $data['msg']=$message;
          $data['footer_msg'] ='I am interested in your profile. Please Accept if you are interested';          
          $this->email->subject($sender_name.'('.$sender_id.')'. 'has sent you an Interest !!!'); 
        }

        else if($message_type=='5'){
          $data['header_msg'] = 'Shortlisted';
          $data['msg']=$message;
         $data['footer_msg'] ='';
          $this->email->subject($sender_name.'('.$sender_id.')'. 'Your Profile has been shortlisted !!!'); 
        }


        $body=$this->load->view('mail/interest_mail',$data,TRUE);
        $this->email->message($body);
        $this->email->send();

      }

    function mail_exists($user_email)
    {
       $query = $this->db->get_where('tbl_user', array('user_email' => $user_email));
       //echo $this->db->last_query();
       return $query->row();      
    }

function mail_exists_partner($user_email)
    {
       $query = $this->db->get_where('tbl_partner', array('partner_email' => $user_email));
       return $query->row();      
    }

 function find_package($matrimony_id)
   {
    $sql="SELECT user_member_type FROM tbl_user WHERE user_matrimony_id='$matrimony_id'";
      $query = $this->db->query($sql);
      $row = $query->row(); 
      $upgrade_name=$this->get_name_from_id($row->user_member_type,'tbl_upgrade','upgrade_id','upgrade_name');
           //$Result_No = $this->db->count_all($tblname);
      if($row->user_member_type=="")
      {
        return false;
      }
      else
      {
        return $upgrade_name;
      }
   }
function count_interest($field_name,$tbl_name,$matrimony_id) 
   {
    $sql="SELECT $field_name FROM $tbl_name WHERE user_matrimony_id='$matrimony_id'";
    $query = $this->db->query($sql);
      //echo $this->db->last_query();
    $row = $query->row(); 
    $COUNT = $row->$field_name;
    return $COUNT;exit;
    
   }

   function is_viewed_contact($matrimony_id,$matrimony_view,$field_name)
   {
     $sql="SELECT $field_name FROM tbl_view_contacts WHERE contact_matrimony_id='$matrimony_id'";
    $query = $this->db->query($sql);
     $row = $query->row(); 
    if(!empty($row->$field_name))
      {
        $res = unserialize($row->$field_name);
        $viewed_array = array();
        foreach ($res as $row) {
          $viewed_array[]=$row;
        }
      }
      if(in_array($matrimony_view,$viewed_array))
      {
        return true;
      }
      else
      {
        return false;
      }

   }
   
        ///////////////////sreenish///////////////
     function get_amount_from_id($id,$tblname,$match_fld,$return_fld)
    {
      $sql="SELECT sum($return_fld) as total_paid_amount FROM $tblname WHERE $match_fld='$id'";
      $query = $this->db->query($sql);
      //$this->db->last_query();
      $row = $query->row(); 
      $Result_No = $this->db->count_all($tblname);
      if($Result_No>0)
      {

       $total_paid_amount = $row->total_paid_amount;
          return $total_paid_amount;exit;
      }
      else
      {
          return false;
      }
    }
  

/////////////////////END SREENISH//////////////////////
function get_deal_details($deal_coupen,$deal_type)
{
  if($deal_type=='main_deal')
  {
    $this->db->select('tbl_offer.offer_coupon_code,tbl_offer.offer_image,tbl_offer.offer_cashback_amount,tbl_offer.offer_total_coupon_count,tbl_offer.offer_user_coupon_count,tbl_offer.offer_new_price,tbl_offer.offer_old_price,tbl_offer.offer_name')->from('tbl_offer');
    $this->db->where('tbl_offer.offer_coupon_code ',$deal_coupen);
    $query = $this->db->get();
   // echo $this->db->last_query();
      $row = $query->row(); 
      return $row;  
  }
  if($deal_type=='sub_deal')
  {

   $this->db->select('tbl_offer.offer_coupon_code,tbl_offer.offer_image,tbl_offer.offer_cashback_amount,tbl_offer.offer_total_coupon_count,tbl_offer.offer_user_coupon_count,tbl_offer.offer_new_price,tbl_offer.offer_old_price,tbl_offer.offer_name,tbl_sub_deal.*')->from('tbl_offer');
    $this->db->join('tbl_sub_deal','tbl_sub_deal.main_deal_coupon_code=tbl_offer.offer_coupon_code','left');
  
    $query = $this->db->get();
 
    $row = $query->row(); 
      return $row;  
  }

}

   function update_lastlogin($tablename,$updatefield,$checkfield,$id,$type)
   {
     $last_login=date("Y-m-d H:i:s");
     $sql="UPDATE $tablename SET $updatefield='$last_login' WHERE $checkfield=".$id;
     $query = $this->db->query($sql);
     return $this->db->insert_id();
   }
   
   ////// sruthi ///////////////
   
   function is_exist_where($tblname,$fldname,$checkvalue,$where='')
    {
      $this->db->select('*')->from($tblname);
      $this->db->where($fldname,$checkvalue);
      if(!empty($where)){
        $this->db->where($where);
      }
      $query = $this->db->get();
      //echo $this->db->last_query();exit;
      $rowcount = $query->num_rows();
      if($rowcount>0)
      {
        return true;
      }
      else
      {
        return false;
      }
    }
    
    function update($table,$field_value,$where){
      $this->db->where($where);
      $this->db->update($table,$field_value);
      //echo $this->db->last_query();exit;
      return $this->db->affected_rows();
      //echo $this->db->last_query();exit;
   }
   
         function update_set($table,$field,$set,$where){
      $this->db->set($field, $set, FALSE);
      $this->db->where($where);
      $this->db->update($table);
      //echo $this->db->last_query();exit;
      return $this->db->affected_rows();
      //echo $this->db->last_query();exit;
   }


   function delete_batch($table,$field,$ids){
      $this->db->where_in($field, $ids);
      $this->db->delete($table);
      return $this->db->affected_rows();
   }
   
   function delete($table,$field,$id){
      $this->db->where($field, $id);
      $this->db->delete($table);
      return $this->db->affected_rows();
   }

   function update_batch($table,$data,$field){
      $this->db->update_batch($table, $data, $field);
      return $this->db->affected_rows();
   }
   
   function insert($tablename,$data)
   {
     $this->db->insert($tablename,$data);
     return $this->db->insert_id();
   }
   
      function select_one_row($table,$return_field,$where)
   {
     $this->db->select($table.'.'.$return_field)->from($table);
     $this->db->where($where);
     $query = $this->db->get();
     //echo $this->db->last_query();exit;
     return $query->row();
   }



   function get_details_two_condition($table,$return_field,$where)
   {

     $this->db->select($table.'.'.$return_field)->from($table);
     $this->db->where($where);
     $query = $this->db->get();
     //echo $this->db->last_query();exit;
     return $query->row();

   }
   
          function get_all_from_condition($table,$return_field,$where,$order_by='')
   {
     $this->db->select($table.'.'.$return_field)->from($table);
     $this->db->where($where);
     $this->db->order_by($order_by);
     $query = $this->db->get();
     //echo $this->db->last_query();exit;
     return $query->result();
   }
   
         function change_visibility($table,$field_value,$where)
    {
      $this->db->where($where);
      $this->db->update($table,$field_value);
     // echo $this->db->last_query();exit;
      return $this->db->affected_rows();
     
   }
   
      function join_table($select,$joins,$tblname,$where,$group_by,$order_by='')
   {
      $this->db->select($select)->from($tblname);
      //print_r($joins[0]['tbl_name']);exit;
      foreach ($joins as $value) 
      {
        $this->db->join($value['tbl_name'],$value['join_fields'],'left');
      }

      if($where!='')
      {
        $this->db->where($where);
      }

      if($group_by!='')
      {
        $this->db->group_by($group_by);
      }
      if($order_by!='')
      {
        $this->db->order_by('tbl_rest_timing.rest_timing_day','asc');
      }
      
      $query = $this->db->get();
        //echo $this->db->last_query();exit;
      return $query->result();
    }

      function insert_batch($tablename,$data)
   {
     $this->db->insert_batch($tablename,$data);
     //echo $this->db->insert_id();
     //echo $this->db->last_query();exit;
     return $this->db->insert_id();
   }

}


?>