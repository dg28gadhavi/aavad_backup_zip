<?php 

class Dashboard_workorder_model extends CI_Model {
	
	function encrypt_decrypt($action, $string)
	{
	    $output = false;

	    $encrypt_method = "AES-256-CBC";
	    $secret_key = 'This is my secret key';
	    $secret_iv = 'This is my secret iv';

	    // hash
	    $key = hash('sha256', $secret_key);
	    
	    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	    $iv = substr(hash('sha256', $secret_iv), 0, 16);

	    if( $action == 'encrypt' ) {
	        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
	        $output = base64_encode($output);
	    }
	    else if( $action == 'decrypt' ){
	        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	    }

	    return $output;
	}
	
	public function get_workorder_data()
    {
        //echo $this->input->get('executive'); die;
        $value = array();

        $this->db->select('COUNT(wo_id) as count');
        $this->db->from('tbl_work_order');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('wo_cid', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('wo_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        $this->db->where('wo_confirm_or_not','0');
        if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("wo_udate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("wo_udate <=",date("Y-m-d", strtotime(($end_date))));
        }
        $query = $this->db->get();
        //echo $this->db->last_query(); die;
        $value['active_wo'] = $query->row_array();

        /********************** */

        $this->db->select('COUNT(wo_id) as count');
        $this->db->from('tbl_work_order');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('wo_cid', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('wo_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        $this->db->where('wo_confirm_or_not','1');
        if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("wo_udate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("wo_udate <=",date("Y-m-d", strtotime(($end_date))));
        }
        $query = $this->db->get();
        //echo $this->db->last_query(); die;
        $value['completed_wo'] = $query->row_array();

        /******************************* */

        $this->db->select('SUM(inwi_qty) as count');
        $this->db->from('tbl_inward_item');
        $this->db->join('tbl_inward', 'tbl_inward_item.inwi_inw_id = tbl_inward.inw_id','left');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('inw_cid', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('inw_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        $this->db->where('inw_isdelete',0);
        $this->db->where('inwi_isdelete',0);
        if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("inw_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("inw_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
        $value['total_purchase'] = $query->row_array();

       
        /***************************************************************** *******************/

        $this->db->select('SUM(otwi_qty) as count');
        $this->db->from('tbl_outward_item');
        $this->db->join('tbl_outward', 'tbl_outward_item.otwi_owt_id = tbl_outward.otw_id','left');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('otw_cid', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('otw_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        $this->db->where('otw_isdelete',0);
        if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("otw_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("otw_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
        $value['total_sales'] = $query->row_array();

       
        /***************************************************************** *******************/

        $this->db->select('SUM(inwi_qty) as count');
        $this->db->from('tbl_inward_item');
        $this->db->join('tbl_inward', 'tbl_inward_item.inwi_inw_id = tbl_inward.inw_id','left');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('inw_cid', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('inw_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        $this->db->where('inw_cdate',date("Y-m-d"));
        $this->db->where('inw_isdelete',0);
        $this->db->where('inwi_isdelete',0);
        if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("inw_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("inw_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
        $value['today_purchase'] = $query->row_array();

       
        /***************************************************************** *******************/


        $this->db->select('SUM(otwi_qty) as count');
        $this->db->from('tbl_outward_item');
        $this->db->join('tbl_outward', 'tbl_outward_item.otwi_owt_id = tbl_outward.otw_id','left');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('otw_cid', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('otw_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        $this->db->where('otw_cdate ',date("Y-m-d"));
        $this->db->where('otw_isdelete',0);
        if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("otw_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("otw_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
        $value['today_sales'] = $query->row_array();

       
        /***************************************************************** *******************/
        
        
        return $value;
    }
	
}
?>