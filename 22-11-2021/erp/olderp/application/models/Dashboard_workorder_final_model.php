<?php 

class Dashboard_workorder_final_model extends CI_Model {
	
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
	    }else if( $action == 'decrypt' ){
	        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	    }

	    return $output;
	}

    public function get_account_work_order()
    {

        /*
        $this->db->select('tbl_work_order.*,tbl_master_party.*,prepared_by.au_fname as prepared_by_fname,prepared_by.au_lname as prepared_by_lname,created_by.au_fname as created_by_fname,created_by.au_lname as created_by_lname,tbl_work_order_type.wo_type_name as type_name,tbl_work_order_type.wo_type_id as type_id,(SELECT tbl_work_order_open.woopen_id FROM tbl_work_order_open WHERE tbl_work_order_open.woopen_woid = tbl_work_order.wo_id AND tbl_work_order_open.woopen_userid = '.$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']).') as woopen_id'.$spuradminstr);
        $this->db->from('tbl_work_order');
        $this->db->join('tbl_admin_users prepared_by','prepared_by.au_id = tbl_work_order.wo_preparedby');
        $this->db->join('tbl_admin_users created_by','created_by.au_id = tbl_work_order.wo_cid');
        $this->db->join('tbl_master_party','tbl_master_party.master_party_id = tbl_work_order.wo_customer_id','left');
         */

        $this->db->select('*,testedby.au_fname as testedbyf,testedby.au_lname as testedbyl,preparedby.au_fname as preparedbyf,preparedby.au_lname as preparedbyl,(SELECT tbl_work_order_open.woopen_id FROM tbl_work_order_open WHERE tbl_work_order_open.woopen_woid = tbl_work_order.wo_id AND tbl_work_order_open.woopen_userid = '.$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']).') as woopen_id,(SELECT tbl_work_order_starview.wos_id FROM tbl_work_order_starview WHERE tbl_work_order_starview.wos_woid = tbl_work_order.wo_id AND tbl_work_order_starview.wos_type = '."'completed'".' AND tbl_work_order_starview.wos_userid = '.$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']).') as wogreen_view,prepared_by.au_fname as prepared_by_fname,prepared_by.au_lname as prepared_by_lname,created_by.au_fname as created_by_fname,created_by.au_lname as created_by_lname');
        $this->db->from('tbl_outward');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_outward.otw_work_ord_id');
        $this->db->join('tbl_work_order_type','tbl_work_order_type.wo_type_id = tbl_work_order.wo_type','left');
        $this->db->join('tbl_admin_users as testedby','tbl_work_order.wo_testedby = testedby.au_id','left');
        $this->db->join('tbl_admin_users as preparedby','tbl_work_order.wo_preparedby = preparedby.au_id','left');
        $this->db->join('tbl_admin_users prepared_by','prepared_by.au_id = tbl_work_order.wo_preparedby');
        $this->db->join('tbl_admin_users created_by','created_by.au_id = tbl_work_order.wo_cid');
        $this->db->join('tbl_master_party','tbl_master_party.master_party_id = tbl_outward.otw_customer_id','left');
        $this->db->where('otw_completed','1');
        $this->db->where('wo_isdeleted','0');
        $this->db->where('otw_isdelete',0);

        if($this->input->get('inq_start_date') && $this->input->get('inq_start_date') != "")
        {
            $start_date=$this->input->get('inq_start_date');
            $this->db->where("wo_wo_date >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('inq_end_date') && $this->input->get('inq_end_date') != "")
        {
                $end_date=$this->input->get('inq_end_date');
            $this->db->where("wo_wo_date <=",date("Y-m-d", strtotime(($end_date))));
        }
        if($this->input->get('customer') && $this->input->get('customer') != "")
        {
            $this->db->where("wo_customer_name",$this->input->get('customer'));
        }
        if($this->input->get('wo_no') && $this->input->get('wo_no') != "")
        {
            $this->db->like("wo_wo_no",$this->input->get('wo_no'));
        }

        $this->db->order_by('otw_manager_confirm_date','ASC');
        $query = $this->db->get();
        $value['outward_lists'] = $query->result_array();

        foreach ($value['outward_lists'] as $outkey => $outvalue) {
            $this->db->select('tbl_outward_item.*,tbl_work_order_item.*,(SELECT GROUP_CONCAT(tbl_outward_serail_key.outward_serial_keyname)  FROM tbl_outward_serail_key where tbl_outward_serail_key.outward_item_id = tbl_outward_item.otwi_id) as serialkey');
            $this->db->from('tbl_outward_item');
             $this->db->join('tbl_work_order_item','tbl_work_order_item.woi_id = tbl_outward_item.otwi_woitemid');
            $this->db->where('otwi_owt_id',$outvalue['otw_id']);
            $this->db->where('otwi_isdelete',0);
            $this->db->where('woi_isdelete',0);
            $query = $this->db->get();
            $value['outward_lists'][$outkey]['item_lists'] = $query->result_array();
        }
        //echo "<pre>";print_r($value);die;
        return $value;
    }

    public function get_Executive(){

        $this->db->select('*');
        $this->db->from('tbl_work_order');
        $this->db->join('tbl_admin_users','tbl_admin_users.au_id = tbl_work_order.wo_preparedby');
        $this->db->where('wo_isdeleted', '0');
        $query = $this->db->get();
        //echo'<pre>';print_r($query->result_array());die;
        return $query->result_array();
    }


    public function get_sticker_work_order()
    {
        $this->db->select('*,testedby.au_fname as testedbyf,testedby.au_lname as testedbyl,preparedby.au_fname as preparedbyf,preparedby.au_lname as preparedbyl');
        $this->db->from('tbl_outward');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_outward.otw_work_ord_id');
        $this->db->join('tbl_admin_users as testedby','tbl_work_order.wo_testedby = testedby.au_id','left');
        $this->db->join('tbl_admin_users as preparedby','tbl_work_order.wo_preparedby = preparedby.au_id','left');
        $this->db->join('tbl_master_party','tbl_master_party.master_party_id = tbl_outward.otw_customer_id','left');
        $this->db->where('otw_completed','1');
        $this->db->where('wo_isdeleted','0');
        $this->db->where('otw_id',$this->input->get('otw_id'));
        $query = $this->db->get();
        
        //echo "<pre>";print_r($value);die;
        return $query->row_array();;
    }

    public function get_production_work_order()
    {
       // echo "<pre>";print_r($this->session->userdata['miconlogin']);die;
        $this->db->select('*');
        $this->db->from('tbl_work_order_item');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
       $this->db->where('woi_production_cid',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
       $this->db->where_in('woi_production_approve',array('0','2'));
        $this->db->where('wo_isdeleted','0');
        $this->db->where('wo_iscompleted','0');
        $query = $this->db->get();
        //echo "<pre>";print_r($query->result_array());die;
        return $query->result_array();
    }
    public function get_store_work_order()
    {
        $this->db->select('*');
        $this->db->from('tbl_work_order_item');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
        $this->db->where('woi_production_approve','1');
        $this->db->where('woi_store_approve','0');
         $this->db->where('wo_isdeleted','0');
        $query = $this->db->get();
        //echo "<pre>";print_r($query->result_array());die;
        return $query->result_array();
    }

    public function get_single_outward_details()
    {
        $this->db->select('*');
        $this->db->from('tbl_outward');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_outward.otw_work_ord_id');
        $this->db->where('wo_isdeleted','0');
         $this->db->where('otw_id',$this->input->get('otw_id'));
        $query = $this->db->get();
        //echo "<pre>";print_r($query->row_array());die;
        return $query->row_array();
    }
    
    public function get_inv_no()
    {
        $this->db->select('inq_id');
        $this->db->from('tbl_inquiry');
        $this->db->order_by('inq_id','DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        $autoid = $query->row_array();
        $autoid['inq_id'] = isset($autoid['inq_id']) ? $autoid['inq_id'] : '';
        return $autoid['inq_id']+1;
    }

    public function get_all_report_work_order($start,$limit)
    {
        $dep_id =  $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']);
        $this->db->select('*,testedby.au_fname as testedbyf,testedby.au_lname as testedbyl,preparedby.au_fname as preparedbyf,preparedby.au_lname as preparedbyl');
        $this->db->from('tbl_outward');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_outward.otw_work_ord_id');
        $this->db->join('tbl_work_order_type','tbl_work_order_type.wo_type_id = tbl_work_order.wo_type','left');
        $this->db->join('tbl_admin_users as testedby','tbl_work_order.wo_testedby = testedby.au_id','left');
        $this->db->join('tbl_admin_users as preparedby','tbl_work_order.wo_preparedby = preparedby.au_id','left');
        $this->db->join('tbl_master_party','tbl_master_party.master_party_id = tbl_outward.otw_customer_id','left');
        //$this->db->join('tbl_work_order_type','tbl_work_order_type.wo_type_id = tbl_work_order.wo_type','left');
        if($this->input->get('product') && $this->input->get('product') != "")
        {
            //echo "<pre>";print_r($this->input->get('customer'));die;
            $this->db->join('tbl_work_order_item','tbl_work_order_item.woi_wo_id = tbl_work_order.wo_id');
            $this->db->where("tbl_work_order_item.woi_item_id",$this->input->get('product'));
        }
        if($this->input->get('inq_start_date') && $this->input->get('inq_start_date') != "")
        {
            $start_date=$this->input->get('inq_start_date');
            $this->db->where("otw_invdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('inq_end_date') && $this->input->get('inq_end_date') != "")
        {
                $end_date=$this->input->get('inq_end_date');
            $this->db->where("otw_invdate <=",date("Y-m-d", strtotime(($end_date))));
        }
        if($this->input->get('au_fname') && $this->input->get('au_fname') != "")
        {
            $this->db->where("wo_cid",$this->input->get('au_fname'));
        }
        if($this->input->get('customer') && $this->input->get('customer') != "")
        {
            //echo "<pre>";print_r($this->input->get('customer'));die;
            $this->db->where("wo_customer_id",$this->input->get('customer'));
        }
        if($this->input->get('wo_no') && $this->input->get('wo_no') != "")
        {
            $this->db->where("wo_wo_no",$this->input->get('wo_no'));
        }

        if($this->input->get('otw_invno') && $this->input->get('otw_invno') != "")
        {
            $this->db->where("otw_invno",$this->input->get('otw_invno'));
        }

        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != '') && $dep_id != 10 && $dep_id != 11 && $dep_id != 2)
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                //$this->db->where_in('wo_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));

                $this->db->group_start();
                $this->db->where('tbl_work_order.wo_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                $this->db->or_where('tbl_work_order.wo_preparedby',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid'])); 
                $this->db->group_end();

                //$this->db->where_in('wo_cid', $this->session->userdata['miconlogin']['all_users']);
            }else{
                //$this->db->where('wo_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                $this->db->group_start();
                $this->db->where('tbl_work_order.wo_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                $this->db->or_where('tbl_work_order.wo_preparedby',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid'])); 
                $this->db->group_end();
            }
        }
        $this->db->where('otw_completed','2');
        $this->db->where('wo_isdeleted','0');
        $this->db->where('otw_isdelete',0);
        $this->db->where('wo_iscompleted',1);
        $this->db->where('wo_isdeleted',0);
        $this->db->limit($limit,$start);
        $this->db->order_by('otw_account_confirm_date','DESC');
        $query = $this->db->get();
        $value['outward_lists'] = $query->result_array();

        foreach ($value['outward_lists'] as $outkey => $outvalue) {
            $this->db->select('tbl_outward_item.*,tbl_work_order_item.*,tbl_admin_users.au_fname,tbl_admin_users.au_lname,(SELECT GROUP_CONCAT(tbl_outward_serail_key.outward_serial_keyname)  FROM tbl_outward_serail_key where tbl_outward_serail_key.outward_item_id = tbl_outward_item.otwi_id) as serialkey');
            $this->db->from('tbl_outward_item');
             $this->db->join('tbl_work_order_item','tbl_work_order_item.woi_id = tbl_outward_item.otwi_woitemid');
              $this->db->join('tbl_admin_users','tbl_work_order_item.woi_production_cid = tbl_admin_users.au_id','left');
            $this->db->where('otwi_owt_id',$outvalue['otw_id']);
            $this->db->where('woi_isdelete',0);
            $this->db->where('otwi_isdelete',0);
            if($this->input->get('product') && $this->input->get('product') != "")
            {
                //echo "<pre>";print_r($this->input->get('customer'));die;
                $this->db->where("woi_item_id",$this->input->get('product'));
            }
            if($dep_id == 9)
            {
                $this->db->where("woi_production_cid",$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['user_id']));
            }
            $query = $this->db->get();
            $value['outward_lists'][$outkey]['item_lists'] = $query->result_array();
        }
        //echo "<pre>";print_r($value);die;
        return $value;
    }

    public function get_all_report_work_order_count()
    {
        $this->db->select('*,testedby.au_fname as testedbyf,testedby.au_lname as testedbyl,preparedby.au_fname as preparedbyf,preparedby.au_lname as preparedbyl');
        $this->db->from('tbl_outward');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_outward.otw_work_ord_id');
        $this->db->join('tbl_work_order_type','tbl_work_order_type.wo_type_id = tbl_work_order.wo_type','left');
        $this->db->join('tbl_admin_users as testedby','tbl_work_order.wo_testedby = testedby.au_id','left');
        $this->db->join('tbl_admin_users as preparedby','tbl_work_order.wo_preparedby = preparedby.au_id','left');
        $this->db->join('tbl_master_party','tbl_master_party.master_party_id = tbl_outward.otw_customer_id','left');
        if($this->input->get('product') && $this->input->get('product') != "")
        {
            //echo "<pre>";print_r($this->input->get('customer'));die;
            $this->db->join('tbl_work_order_item','tbl_work_order_item.woi_wo_id = tbl_work_order.wo_id');
            $this->db->where("tbl_work_order_item.woi_item_id",$this->input->get('product'));
        }
        if($this->input->get('inq_start_date') && $this->input->get('inq_start_date') != "")
        {
            $start_date=$this->input->get('inq_start_date');
            $this->db->where("otw_invdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('inq_end_date') && $this->input->get('inq_end_date') != "")
        {
                $end_date=$this->input->get('inq_end_date');
            $this->db->where("otw_invdate <=",date("Y-m-d", strtotime(($end_date))));
        }
        if($this->input->get('au_fname') && $this->input->get('au_fname') != "")
        {
            $this->db->where("wo_cid",$this->input->get('au_fname'));
        }
        if($this->input->get('customer') && $this->input->get('customer') != "")
        {
            //echo "<pre>";print_r($this->input->get('customer'));die;
            $this->db->where("wo_customer_id",$this->input->get('customer'));
        }
        if($this->input->get('wo_no') && $this->input->get('wo_no') != "")
        {
            $this->db->where("wo_wo_no",$this->input->get('wo_no'));
        }
        if($this->input->get('otw_invno') && $this->input->get('otw_invno') != "")
        {
            $this->db->where("otw_invno",$this->input->get('otw_invno'));
        }
        if($this->input->get('otw_invno') && $this->input->get('otw_invno') != "")
        {
            $this->db->where("otw_invno",$this->input->get('otw_invno'));
        }
        $this->db->where('otw_completed','2');
        $this->db->where('wo_isdeleted','0');
        $this->db->where('otw_isdelete',0);
        $this->db->where('wo_iscompleted',1);
        $this->db->where('wo_isdeleted',0);
        $query = $this->db->get();
        return $query->num_rows();
    }
	
	public function get_all_confirm_work_order()
    {
        //echo $this->input->get('executive'); die;
        $woids = array();
        if(($this->input->get('production') && $this->input->get('production') != "") || ($this->input->get('vendor') && $this->input->get('vendor') != ""))
        {
            $this->db->select('DISTINCT(woi_wo_id) as work_order_id');
            $this->db->from('tbl_work_order_item');
            if($this->input->get('production') && $this->input->get('production') != "")
            {
                $this->db->where("tbl_work_order_item.woi_production_cid",$this->input->get('production'));
            }
            if($this->input->get('vendor') && $this->input->get('vendor') != "")
            {
                $this->db->join('tbl_master_item','tbl_master_item.master_item_id = tbl_work_order_item.woi_item_id');
                $this->db->where("tbl_master_item.master_item_make",$this->input->get('vendor'));
            }
            $this->db->where('woi_account_approve','0');
            $this->db->where('woi_isdelete',0);
            $type_id = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']);
            if($type_id == 3)
            {
                $this->db->where('woi_manager_approve','1');
                $this->db->order_by('woi_admin_approve','ASC');
            }else{
                $dep_id =  $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']);
                if($dep_id == 10)
                {
                    //$this->db->where('woi_admin_approve','1');
                    $this->db->order_by('woi_manager_approve','ASC');
                }else if($dep_id == 11){
                    $this->db->where('woi_admin_approve','1');
                    $this->db->where('woi_manager_approve','1');
                }else if($dep_id == 9){
                    $this->db->where('woi_admin_approve','1');
                    $this->db->where('woi_manager_approve','1');
                    $this->db->where('woi_promanager_approve','1');
                }
            }            
            $query = $this->db->get();
            //echo $query->num_rows();die;
            if($query->num_rows() > 0)
            {
                $woids = array_column($query->result_array(), 'work_order_id');
            }else{
                $woids = array(0);
            }
        }
        $value = array();
        /********************** */
        if($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) == 3)
        {
            $spuradminstr = ',(SELECT COUNT(*) AS spending FROM tbl_work_order_item where tbl_work_order_item.woi_wo_id = tbl_work_order.wo_id AND woi_manager_approve = '."'1'".' AND woi_admin_approve = '."'0'".') as spending';
        }else{
            $spuradminstr = '';
            if($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']) == 10){
                $spuradminstr = ',(SELECT COUNT(*) AS smpending FROM tbl_work_order_item where tbl_work_order_item.woi_wo_id = tbl_work_order.wo_id AND woi_manager_approve = '."'0'".') as smpending';
            }else if($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']) == 11){
                $spuradminstr = ',(SELECT COUNT(*) AS prompending FROM tbl_work_order_item where tbl_work_order_item.woi_wo_id = tbl_work_order.wo_id AND woi_manager_approve = '."'1'".' AND woi_admin_approve = '."'1'".' AND woi_promanager_approve = '."'0'".') as prompending';
                $spuradminstr .= ',(SELECT COUNT(*) AS prom_outwardpending FROM tbl_outward where tbl_outward.otw_work_ord_id = tbl_work_order.wo_id AND otw_completed = '."'0'".') as prom_outwardpending';
                //$spuradminstr .= ',(SELECT COUNT(*) AS prom_outwardpending_confirm FROM tbl_work_order_item JOIN tbl_outward ON tbl_outward.otw_work_ord_id = tbl_work_order_item.woi_wo_id where tbl_outward.otw_work_ord_id = tbl_work_order.wo_id AND tbl_work_order_item.woi_wo_id = tbl_work_order.wo_id AND otw_completed = '."'0'".') as prom_outwardpending';
            }
        }
        $this->db->select('tbl_work_order.*,tbl_master_party.*,prepared_by.au_fname as prepared_by_fname,prepared_by.au_lname as prepared_by_lname,created_by.au_fname as created_by_fname,created_by.au_lname as created_by_lname,tbl_work_order_type.wo_type_name as type_name,tbl_work_order_type.wo_type_id as type_id,(SELECT tbl_work_order_open.woopen_id FROM tbl_work_order_open WHERE tbl_work_order_open.woopen_woid = tbl_work_order.wo_id AND tbl_work_order_open.woopen_userid = '.$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']).') as woopen_id'.$spuradminstr);
        $this->db->from('tbl_work_order');
        $this->db->join('tbl_admin_users prepared_by','prepared_by.au_id = tbl_work_order.wo_preparedby');
        $this->db->join('tbl_admin_users created_by','created_by.au_id = tbl_work_order.wo_cid');
        $this->db->join('tbl_master_party','tbl_master_party.master_party_id = tbl_work_order.wo_customer_id','left');
        //$this->db->join('tbl_dispatch','tbl_dispatch.dis_woid = tbl_work_order.wo_id','left');
        $this->db->join('tbl_work_order_type','tbl_work_order_type.wo_type_id = tbl_work_order.wo_type','left');
        //$this->db->join('tbl_work_order_open','tbl_work_order_open.woopen_woid = tbl_work_order.wo_id','left');
        $dep_id =  $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']);
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != '') && $dep_id != 10 && $dep_id != 11)
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                //$this->db->where_in('wo_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));

                $this->db->group_start();
                $this->db->where('tbl_work_order.wo_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                $this->db->or_where('tbl_work_order.wo_preparedby',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid'])); 
                $this->db->group_end();

                //$this->db->where_in('wo_cid', $this->session->userdata['miconlogin']['all_users']);
            }else{
                //$this->db->where('wo_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                $this->db->group_start();
                $this->db->where('tbl_work_order.wo_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                $this->db->or_where('tbl_work_order.wo_preparedby',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid'])); 
                $this->db->group_end();
            }
        }
        if($dep_id == 11)
        {
            
        }
        $this->db->where('wo_confirm_or_not','1');
         $this->db->where('wo_isdeleted','0');
         $this->db->where('wo_iscompleted','0');
        if($this->input->get('inq_start_date') && $this->input->get('inq_start_date') != "")
        {
            $start_date=$this->input->get('inq_start_date');
            $this->db->where("wo_wo_date >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('inq_end_date') && $this->input->get('inq_end_date') != "")
        {
                $end_date=$this->input->get('inq_end_date');
            $this->db->where("wo_wo_date <=",date("Y-m-d", strtotime(($end_date))));
        }
        if($this->input->get('au_fname') && $this->input->get('au_fname') != "")
        {
            $this->db->where("wo_cid",$this->input->get('au_fname'));
        }
        if($this->input->get('customer') && $this->input->get('customer') != "")
        {
            $this->db->where("wo_customer_name",$this->input->get('customer'));
        }
        if($this->input->get('wo_no') && $this->input->get('wo_no') != "")
        {
            $this->db->like("wo_wo_no",$this->input->get('wo_no'));
        }
        //$this->db->order_by('wo_id','DESC');
        if(isset($woids) && is_array($woids) && !empty($woids))
        {
            $woids = array_unique($woids);
            $this->db->where_in('wo_id',$woids);
        }
        $this->db->order_by('wo_id','DESC');
        $query = $this->db->get();
        if(isset($woids) && is_array($woids) && !empty($woids))
        {
            //echo $this->db->last_query(); die;
        }
        //echo $this->db->last_query(); die;
        //
        $value['completed_wo'] = $query->result_array();
        //echo '<pre>';print_r($value['completed_wo']);die;
        /******************************* */

        foreach ($value['completed_wo'] as $ikey => $wodetails) {

            $this->db->select('*');
            $this->db->from('tbl_work_order_notification');
            $this->db->where('wo_noti_woid',$wodetails['wo_id']);
            $this->db->order_by('wo_noti_id','DESC');
            $query = $this->db->get();
            $value['completed_wo'][$ikey]['noti_lists'] = $query->result_array();

            $dep_id =  $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']);

            if($dep_id == 11)
            {
                $this->db->select('*');
                $this->db->from('tbl_outward');
                $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_outward.otw_work_ord_id');
                $this->db->join('tbl_master_party','tbl_master_party.master_party_id = tbl_outward.otw_customer_id','left');
                $this->db->where('otw_work_ord_id',$wodetails['wo_id']);
                $this->db->where('otw_completed','0');
                $this->db->where('wo_isdeleted','0');
                $this->db->where('otw_isdelete',0);
                $query = $this->db->get();
                $value['completed_wo'][$ikey]['outward_lists'] = $query->result_array();

                foreach ($value['completed_wo'][$ikey]['outward_lists'] as $outkey => $outvalue) {
                    $this->db->select('*');
                    $this->db->from('tbl_outward_item');
                    $this->db->join('tbl_work_order_item','tbl_work_order_item.woi_id = tbl_outward_item.otwi_woitemid','left');
                    //$this->db->join('tbl_admin_users as pro_admin','pro_admin.au_id = tbl_work_order_item.woi_production_cid','left');
                    //$this->db->where('woi_production_approve','3');
                    $this->db->where('otwi_owt_id',$outvalue['otw_id']);
                    $this->db->where('otwi_woid',$wodetails['wo_id']);
                    $this->db->where('otwi_isdelete',0);
                    $query = $this->db->get();
                    $value['completed_wo'][$ikey]['outward_lists'][$outkey]['item_lists'] = $query->result_array();
                }
            }

            $this->db->select('tbl_work_order_item.*,tbl_master_item.*,(select ROUND(SUM(tcredit.tran_itm_qty),2) as tcreditpoints FROM tbl_transaction as tcredit WHERE tcredit.tran_cr_or_dr = 1 AND tcredit.tran_itm_id = tbl_work_order_item.woi_item_id AND tcredit.tran_is_hold = '."'0'".') as tcreditpoints,(select ROUND(SUM(tdebit.tran_itm_qty),2) as tdebitpoints FROM tbl_transaction as tdebit WHERE tdebit.tran_cr_or_dr = 2 AND tdebit.tran_itm_id = tbl_work_order_item.woi_item_id AND tdebit.tran_is_hold = '."'0'".') as tdebitpoints,pro_admin.au_fname as production_fname,pro_admin.au_lname as production_lname');
            $this->db->from('tbl_work_order_item');
            $this->db->join('tbl_admin_users as pro_admin','pro_admin.au_id = tbl_work_order_item.woi_production_cid','left');
            $this->db->join('tbl_master_item','tbl_master_item.master_item_id = tbl_work_order_item.woi_item_id','left');
            $this->db->where('woi_wo_id',$wodetails['wo_id']);
            $this->db->where('woi_account_approve','0');
            $this->db->where('woi_isdelete',0);
            $type_id = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']);
            if($type_id == 3)
            {
                $this->db->where('woi_manager_approve','1');
                $this->db->order_by('woi_admin_approve','ASC');
            }else{
                $dep_id =  $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']);
                if($dep_id == 10)
                {
                    //$this->db->where('woi_admin_approve','1');
                    $this->db->order_by('woi_manager_approve','ASC');
                }else if($dep_id == 11){
                    $this->db->where('woi_admin_approve','1');
                    $this->db->where('woi_manager_approve','1');
                }else if($dep_id == 9){
                    $this->db->where('woi_admin_approve','1');
                    $this->db->where('woi_manager_approve','1');
                    $this->db->where('woi_promanager_approve','1');
                }
            }
            if($this->input->get('production') && $this->input->get('production') != "")
            {
                $this->db->where("tbl_work_order_item.woi_production_cid",$this->input->get('production'));
            }
            $query = $this->db->get();
            $value['completed_wo'][$ikey]['items'] = $query->result_array();
        }
        /***************************************************************** *******************/
        //echo '<pre>';print_r($value);die;
        return $value;
    }
    public function approve_qty_for_super_admin($data)
    {
        $updatear = array('woi_admin_approve' => '1','woi_admin_approve_date' => date("Y-m-d H:i:s"));
        $this->db->where('woi_id',$data['wo_itemid']);
        $this->db->update('tbl_work_order_item',$updatear);

        $this->db->select('*');
        $this->db->from('tbl_work_order');
        $this->db->join('tbl_work_order_item','tbl_work_order_item.woi_wo_id = tbl_work_order.wo_id');
        $this->db->where('tbl_work_order_item.woi_id',$data['wo_itemid']);
        $this->db->where('tbl_work_order.wo_id',$data['wo_id']);
        $query = $this->db->get();
        if($query->num_rows() == 1)
        {
            $workorder_data = $query->row_array();
            $notimsg = $workorder_data['wo_wo_no'].' - '.$workorder_data['woi_part_no'].'-Qty: '.$workorder_data['woi_qty']." Approved By ".$this->session->userdata['miconlogin']['fname'].' Waitning for Production Manager Confirmation';
        }else{
            $notimsg = " Approved By ".$this->session->userdata['miconlogin']['fname'];
        }

        $noti = array(
                    'wo_noti_woid' => $data['wo_id'],
                    'wo_noti_wo_itmid' => $data['wo_itemid'],
                    'wo_noti_msg' => $notimsg,
                    'wo_noti_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
                    'wo_noti_date' => date('Y-m-d H:i:s')
                );
            $this->db->insert('tbl_work_order_notification',$noti);
            $wonid = $this->db->insert_id();
            $assigndep = array('production_manager','super_admin','sales_manager');
            $this->assign_notification_rights($wonid,$assigndep,$single_user = false,$data['wo_id']);

    }
    public function approve_qty_for_manager($data)
    {
        //echo "<pre>";print_r($data);die;
        $updatear = array('woi_manager_approve' => '1','woi_manager_approve_date' => date("Y-m-d H:i:s"));
        $this->db->where('woi_id',$data['wo_itemid']);
        $this->db->update('tbl_work_order_item',$updatear);

        $this->db->select('*');
        $this->db->from('tbl_work_order');
        $this->db->join('tbl_work_order_item','tbl_work_order_item.woi_wo_id = tbl_work_order.wo_id');
        $this->db->where('tbl_work_order_item.woi_id',$data['wo_itemid']);
        $this->db->where('tbl_work_order.wo_id',$data['wo_id']);
        $query = $this->db->get();
        if($query->num_rows() == 1)
        {
            $workorder_data = $query->row_array();
            $notimsg = $workorder_data['wo_wo_no'].' - '.$workorder_data['woi_part_no'].'-Qty: '.$workorder_data['woi_qty']." Approved By ".$this->session->userdata['miconlogin']['fname'].' Waitning for Admin Confirmation';
        }else{
            $notimsg = " Approved By ".$this->session->userdata['miconlogin']['fname'];
        }
        $noti = array(
                    'wo_noti_woid' => $data['wo_id'],
                    'wo_noti_wo_itmid' => $data['wo_itemid'],
                    'wo_noti_msg' => $notimsg,
                    'wo_noti_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
                    'wo_noti_date' => date('Y-m-d H:i:s')
                );
            $this->db->insert('tbl_work_order_notification',$noti);
            $wonid = $this->db->insert_id();
            $assigndep = array('super_admin','sales_manager','production_manager');
            $this->assign_notification_rights($wonid,$assigndep,$single_user = false,$data['wo_id']);


    }
    public function approve_qty_for_pro_manager($data)
    {
        $updatear = array('woi_promanager_approve' => '1','woi_promanager_approve_date' => date("Y-m-d H:i:s"));
        $this->db->where('woi_id',$data['wo_itemid']);
        $this->db->update('tbl_work_order_item',$updatear);

        $this->db->select('*');
        $this->db->from('tbl_work_order');
        $this->db->join('tbl_work_order_item','tbl_work_order_item.woi_wo_id = tbl_work_order.wo_id');
        $this->db->where('tbl_work_order_item.woi_id',$data['wo_itemid']);
        $this->db->where('tbl_work_order.wo_id',$data['wo_id']);
        $query = $this->db->get();
        if($query->num_rows() == 1)
        {
            $workorder_data = $query->row_array();
            $notimsg = $workorder_data['wo_wo_no'].' - '.$workorder_data['woi_part_no'].'-Qty: '.$workorder_data['woi_qty']." Approved By ".$this->session->userdata['miconlogin']['fname'].' Waitning for Production Confirmation';
        }else{
            $notimsg = " Approved By ".$this->session->userdata['miconlogin']['fname'];
        }

        $noti = array(
                    'wo_noti_woid' => $data['wo_id'],
                    'wo_noti_wo_itmid' => $data['wo_itemid'],
                    'wo_noti_msg' => $notimsg,
                    'wo_noti_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
                    'wo_noti_date' => date('Y-m-d H:i:s')
                );
            $this->db->insert('tbl_work_order_notification',$noti);
            $wonid = $this->db->insert_id();
            $assigndep = array('test','super_admin','sales_manager','production_manager');
            $this->assign_notification_rights($wonid,$assigndep,$single_user = false,$data['wo_id']);
    }
    public function approve_qty_for_store($data)
    {
        $value = array();
        $updatear = array('woi_store_approve' => '1','woi_production_approve' => '2','woi_store_approve_date' => date("Y-m-d H:i:s"));
        $this->db->where('woi_id',$data['wo_itemid']);
        $this->db->update('tbl_work_order_item',$updatear);

        $this->db->select('*');
        $this->db->from('tbl_work_order');
        $this->db->join('tbl_work_order_item','tbl_work_order_item.woi_wo_id = tbl_work_order.wo_id');
        $this->db->where('tbl_work_order_item.woi_id',$data['wo_itemid']);
        $this->db->where('tbl_work_order.wo_id',$data['wo_id']);
        $query = $this->db->get();
        if($query->num_rows() == 1)
        {
            $workorder_data = $query->row_array();
            $notimsg = $workorder_data['wo_wo_no'].' - '.$workorder_data['woi_part_no'].'-Qty: '.$workorder_data['woi_qty']." Approved By ".$this->session->userdata['miconlogin']['fname'].' Waitning for Production Confirmation';
        }else{
            $notimsg = " Approved By ".$this->session->userdata['miconlogin']['fname'];
        }
        if(isset($workorder_data) && !empty($workorder_data) && isset($workorder_data['woi_production_cid']) && ($workorder_data['woi_production_cid'] != 0)){
            $single_user[] = $workorder_data['woi_production_cid'];
        }else{
            $single_user = FALSE;
        }
        $noti = array(
                    'wo_noti_woid' => $data['wo_id'],
                    'wo_noti_wo_itmid' => $data['wo_itemid'],
                    'wo_noti_msg' => $notimsg,
                    'wo_noti_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
                    'wo_noti_date' => date('Y-m-d H:i:s')
                );
            $this->db->insert('tbl_work_order_notification',$noti);
            $wonid = $this->db->insert_id();
            $assigndep = array('test','super_admin','sales_manager','production_manager');
            $this->assign_notification_rights($wonid,$assigndep,$single_user,$data['wo_id']);

        $this->db->select('*');
        $this->db->from('tbl_work_order_item');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id ');
        $this->db->where('woi_id',$data['wo_itemid']);
        $this->db->where('wo_isdeleted','0');
        $this->db->where('woi_store_approve','1');
        $query = $this->db->get();
        $wodata = $query->row_array();
        //echo "<pre>";print_r($wodata);die;



        $this->db->select('otw_id');
        $this->db->from('tbl_outward');
        $this->db->where('otw_work_ord_id',$wodata['woi_wo_id']);
        $this->db->where('otw_completed','0');
        $this->db->where('otw_isdelete',0);
        $query = $this->db->get();
        $autoid = $query->row_array();
        //echo "<pre>";print_r($autoid);die;


        if($query->num_rows() == 0)
        {
                $this->db->select('otw_id');
                $this->db->from('tbl_outward');
                $this->db->order_by('otw_id','DESC');
                $this->db->limit(1);
                $query = $this->db->get();
                $autoid = $query->row_array();
                /* $this->db->select('*');
                $this->db->from('tbl_prefix');
                //$this->db->where('pre_cid',$this->session->userdata['login']['aus_Id']);
                $query = $this->db->get();
                $code = $query->row_array();
                $autoid['otw_id'] = isset($autoid['otw_id']) ? $autoid['otw_id'] : '';
                $otwno = $code['pre_Outward'].''.($autoid['otw_id']+1); */
                if(date("m") < 4)
                {
                    $last_year = date('y', strtotime('-1 year'));
                    $this_year = date('y');
                    $year_string = $last_year.''.$this_year.'-'.strtoupper(date('M'));
                }else{
                    $next_year = date('y', strtotime('+1 year'));
                    $this_year = date('y');
                    $year_string = $this_year.''.$next_year.'-'.strtoupper(date('M'));
                }

                $autoid['otw_id'] = isset($autoid['otw_id']) ? $autoid['otw_id'] : '';
                $otwno = 'OTW-'.$year_string.'-'.($autoid['otw_id']+1);

                $item = array(
                'otw_no' => $otwno,
                'otw_customer_name' => $wodata['wo_customer_name'],
                'otw_customer_id' => $wodata['wo_customer_id'],
                //'otw_invoice_no' => $wodata['otw_invoice_no'],
                'otw_work_ord_no' => $wodata['wo_wo_no'],
                'otw_work_ord_id' => $wodata['woi_wo_id'],
                'otw_completed' => '0',
                'otw_cid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
                'otw_cdate' => date('Y-m-d H:i:s'),
                'otw_udate' => date('Y-m-d H:i:s')
                );
                //echo '<pre>';print_r($item);die;
                $this->db->insert('tbl_outward',$item);
                $lid = $this->db->insert_id();

                $value['otwid'] = $lid;
                $item1 = array(
                'otwi_owt_id' => $lid,
                'otwi_itm_name' => $wodata['woi_item_id'],
                'otwi_itm_title' => $wodata['woi_itm_title'],
                'otwi_itm_desc ' => $wodata['woi_itm_desc'],
                'otwi_part_no'=> isset($wodata['woi_part_no']) ? $wodata['woi_part_no'] : '',
                'otwi_stock'=> $wodata['woi_stock'],
                'otwi_qty'=> $wodata['woi_qty'],
                'otwi_price'=> $wodata['woi_price'],
                'otwi_total'=> $wodata['woi_total'],
                'otwi_discount'=> $wodata['woi_discount'],
                'otwi_ftotal'=> $wodata['woi_final_price'],
                'otwi_udate' => date('Y-m-d H:i:s'),
                'otwi_woid' => $wodata['woi_wo_id'],
                'otwi_woitemid' => $data['wo_itemid']
                );
                //echo '<pre>'; print_r($item1); die;
                $this->db->insert('tbl_outward_item',$item1);
                $item_lid = $this->db->insert_id();
                $value['itmid'] = $item_lid;

                $transaction = array(
                            'tran_itm_id' => $wodata['woi_item_id'],
                            'tran_itm_qty' => $wodata['woi_qty'],
                            'tran_otw_id' => $lid,
                            'tran_otw_item_id' => $item_lid,
                            'tran_cr_or_dr' => 2,
                            'tran_add_or_edit' => 1,
                            'tran_ip' => $_SERVER['REMOTE_ADDR'],
                            'tran_cid'=> $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
                            'tran_cdate' => date('Y-m-d H:i:s'),
                            'tran_udate' => date('Y-m-d H:i:s')
                        );
                    $this->db->insert('tbl_transaction',$transaction);

                $transaction = array(
                            'tran_itm_id' => $wodata['woi_item_id'],
                            'tran_itm_qty' => $wodata['woi_qty'],
                            'tran_otw_id' => $lid,
                            'tran_otw_item_id' => $item_lid,
                            'tran_is_hold' => "1",
                            'tran_cr_or_dr' => 1,
                            'tran_add_or_edit' => 1,
                            'tran_ip' => $_SERVER['REMOTE_ADDR'],
                            'tran_cid'=> $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
                            'tran_cdate' => date('Y-m-d H:i:s'),
                            'tran_udate' => date('Y-m-d H:i:s')
                        );
                    $this->db->insert('tbl_transaction',$transaction);
        }else{
            $item1 = array(
                'otwi_owt_id' => $autoid['otw_id'],
                'otwi_itm_name' => $wodata['woi_item_id'],
                'otwi_itm_title' => $wodata['woi_itm_title'],
                'otwi_itm_desc ' => $wodata['woi_itm_desc'],
                'otwi_part_no'=> isset($wodata['woi_part_no']) ? $wodata['woi_part_no'] : '',
                'otwi_stock'=> $wodata['woi_stock'],
                'otwi_qty'=> $wodata['woi_qty'],
                'otwi_price'=> $wodata['woi_price'],
                'otwi_total'=> $wodata['woi_total'],
                'otwi_discount'=> $wodata['woi_discount'],
                'otwi_ftotal'=> $wodata['woi_final_price'],
                'otwi_udate' => date('Y-m-d H:i:s'),
                'otwi_woid' => $wodata['woi_wo_id'],
                'otwi_woitemid' => $data['wo_itemid']
                );
                //echo '<pre>'; print_r($item1); die;
                $this->db->insert('tbl_outward_item',$item1);
                $item_lid = $this->db->insert_id();

                $value['itmid'] = $item_lid;
                $value['otwid'] = $autoid['otw_id'];

                $transaction = array(
                            'tran_itm_id' => $wodata['woi_item_id'],
                            'tran_itm_qty' => $wodata['woi_qty'],
                            'tran_otw_id' => $autoid['otw_id'],
                            'tran_otw_item_id' => $item_lid,
                            'tran_cr_or_dr' => 2,
                            'tran_add_or_edit' => 1,
                            'tran_ip' => $_SERVER['REMOTE_ADDR'],
                            'tran_cid'=> $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
                            'tran_cdate' => date('Y-m-d H:i:s'),
                            'tran_udate' => date('Y-m-d H:i:s')
                        );
                    $this->db->insert('tbl_transaction',$transaction);

                $transaction = array(
                            'tran_itm_id' => $wodata['woi_item_id'],
                            'tran_itm_qty' => $wodata['woi_qty'],
                            'tran_otw_id' => $autoid['otw_id'],
                            'tran_otw_item_id' => $item_lid,
                            'tran_is_hold' => "1",
                            'tran_cr_or_dr' => 1,
                            'tran_add_or_edit' => 1,
                            'tran_ip' => $_SERVER['REMOTE_ADDR'],
                            'tran_cid'=> $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
                            'tran_cdate' => date('Y-m-d H:i:s'),
                            'tran_udate' => date('Y-m-d H:i:s')
                        );
                    $this->db->insert('tbl_transaction',$transaction);
        }

        return $value;

    }
    public function approve_qty_for_production($data)
    {
        if($this->input->get('pro_status') && $this->input->get('pro_status') == "done")
        {
            $updatear = array('woi_production_approve' => '3','woi_production_approve_date' => date("Y-m-d H:i:s"));
            $this->db->where('woi_id',$data['wo_itemid']);
            $this->db->update('tbl_work_order_item',$updatear);

            $this->db->select('*');
            $this->db->from('tbl_work_order');
            $this->db->join('tbl_work_order_item','tbl_work_order_item.woi_wo_id = tbl_work_order.wo_id');
            $this->db->where('tbl_work_order_item.woi_id',$data['wo_itemid']);
            $this->db->where('tbl_work_order.wo_id',$data['wo_id']);
            $query = $this->db->get();
            if($query->num_rows() == 1)
            {
                $workorder_data = $query->row_array();
                $notimsg = $workorder_data['wo_wo_no'].' - '.$workorder_data['woi_part_no'].'-Qty: '.$workorder_data['woi_qty']." Approved By ".$this->session->userdata['miconlogin']['fname'].' Waitning for Production Manager Confirmation';
            }else{
                $notimsg = " Approved By ".$this->session->userdata['miconlogin']['fname'];
            }

            $noti = array(
                    'wo_noti_woid' => $data['wo_id'],
                    'wo_noti_wo_itmid' => $data['wo_itemid'],
                    'wo_noti_msg' => $notimsg,
                    'wo_noti_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
                    'wo_noti_date' => date('Y-m-d H:i:s')
                );
            $this->db->insert('tbl_work_order_notification',$noti);
            $wonid = $this->db->insert_id();
            $assigndep = array('production_manager','super_admin','sales_manager');
            $single_user = array();
            $single_user[] = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']);
            $this->assign_notification_rights($wonid,$assigndep,$single_user,$data['wo_id']);
        }
        else{
            $updatear = array('woi_production_approve' => '1','woi_production_approve_date' => date("Y-m-d H:i:s"));
            $this->db->where('woi_id',$data['wo_itemid']);
            $this->db->update('tbl_work_order_item',$updatear);

            $this->db->select('*');
            $this->db->from('tbl_work_order');
            $this->db->join('tbl_work_order_item','tbl_work_order_item.woi_wo_id = tbl_work_order.wo_id');
            $this->db->where('tbl_work_order_item.woi_id',$data['wo_itemid']);
            $this->db->where('tbl_work_order.wo_id',$data['wo_id']);
            $query = $this->db->get();
            if($query->num_rows() == 1)
            {
                $workorder_data = $query->row_array();
                $notimsg = $workorder_data['wo_wo_no'].' - '.$workorder_data['woi_part_no'].'-Qty: '.$workorder_data['woi_qty']." Approved By ".$this->session->userdata['miconlogin']['fname'].' Waitning for Store Confirmation';
            }else{
                $notimsg = "Assign To Store By ".$this->session->userdata['miconlogin']['fname'];
            }

            $noti = array(
                    'wo_noti_woid' => $data['wo_id'],
                    'wo_noti_wo_itmid' => $data['wo_itemid'],
                    'wo_noti_msg' => $notimsg,
                    'wo_noti_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
                    'wo_noti_date' => date('Y-m-d H:i:s')
                );
            $this->db->insert('tbl_work_order_notification',$noti);
            $wonid = $this->db->insert_id();
            $assigndep = array('store','super_admin','sales_manager','production_manager');
            $single_user = array();
            $single_user[] = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']);
            $this->assign_notification_rights($wonid,$assigndep,$single_user,$data['wo_id']);
        }

        

    }
    public function get_wo_item_details($data)
    {
        $this->db->select('tbl_work_order_item.*,tbl_work_order.*,(select ROUND(SUM(tcredit.tran_itm_qty),2) as tcreditpoints FROM tbl_transaction as tcredit WHERE tcredit.tran_cr_or_dr = 1 AND tcredit.tran_itm_id = tbl_work_order_item.woi_item_id AND tcredit.tran_is_hold = '."'0'".') as tcreditpoints,(select ROUND(SUM(tdebit.tran_itm_qty),2) as tdebitpoints FROM tbl_transaction as tdebit WHERE tdebit.tran_cr_or_dr = 2 AND tdebit.tran_itm_id = tbl_work_order_item.woi_item_id AND tdebit.tran_is_hold = '."'0'".') as tdebitpoints');
        $this->db->from('tbl_work_order_item');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
        $this->db->where('woi_id',$data['wo_itemid']);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function update_wo_items($postvalue,$data)
    {
        //echo '<pre>';print_r($data);die;
        $this->db->select('*');
        $this->db->from('tbl_work_order_item');
        $this->db->where('woi_id',$data['wo_itemid']);
        $query = $this->db->get();
        if($query->num_rows() == 1)
        {
            $woitems = $query->row_array();
            $this->db->delete('tbl_work_order_item',array("woi_id" => $data['wo_itemid']));

            unset($woitems['woi_id']);
            $woitems['woi_qty'] = $postvalue['approve_qty'];
            $woitems['woi_admin_approve'] = '1';
            $woitems['woi_admin_approve_date'] = date("Y-m-d H:i:s");
            $this->db->insert('tbl_work_order_item',$woitems);
            unset($woitems['woi_admin_approve_date']);
            $woitems['woi_qty'] = $postvalue['open_qty'];
            $woitems['woi_admin_approve'] = '0';
            $this->db->insert('tbl_work_order_item',$woitems);

            $total_qty = $postvalue['approve_qty'] + $postvalue['open_qty'];

            $this->db->select('*');
            $this->db->from('tbl_work_order');
            $this->db->join('tbl_work_order_item','tbl_work_order_item.woi_wo_id = tbl_work_order.wo_id');
            $this->db->where('tbl_work_order_item.woi_id',$data['wo_itemid']);
            $this->db->where('tbl_work_order.wo_id',$data['wo_id']);
            $query = $this->db->get();
            if($query->num_rows() == 1)
            {
                $workorder_data = $query->row_array();
                $notimsg = $workorder_data['wo_wo_no'].' - '.$workorder_data['woi_part_no'].'-Qty: '.$postvalue['approve_qty']." Out of  ".$total_qty." Approved By "." Approved By ".$this->session->userdata['miconlogin']['fname'].' Waitning for Production Manager Confirmation';
            }else{
                $notimsg = "".$postvalue['approve_qty']." Out of  ".$total_qty." Approved By ".$this->session->userdata['miconlogin']['fname'];
            }

            $noti = array(
                    'wo_noti_woid' => $data['wo_id'],
                    'wo_noti_wo_itmid' => $data['wo_itemid'],
                    'wo_noti_msg' => $notimsg,
                    'wo_noti_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
                    'wo_noti_date' => date('Y-m-d H:i:s')
                );
            $this->db->insert('tbl_work_order_notification',$noti);
            $wonid = $this->db->insert_id();
            $assigndep = array('super_admin','sales_manager','production_manager');
            $this->assign_notification_rights($wonid,$assigndep,$single_user = false,$data['wo_id']);



        }else{
            echo 'sfasfasf';die;
        }

    }
    public function update_wo_items_manager($postvalue,$data)
    {
        $this->db->select('*');
        $this->db->from('tbl_work_order_item');
        $this->db->where('woi_id',$data['wo_itemid']);
        $query = $this->db->get();
        if($query->num_rows() == 1)
        {
            $woitems = $query->row_array();
            $this->db->delete('tbl_work_order_item',array("woi_id" => $data['wo_itemid']));

            unset($woitems['woi_id']);
            $woitems['woi_qty'] = $postvalue['approve_qty'];
            $woitems['woi_manager_approve'] = '1';
            $woitems['woi_manager_approve_date'] = date("Y-m-d H:i:s");
            $this->db->insert('tbl_work_order_item',$woitems);
            unset($woitems['woi_manager_approve_date']);
            $woitems['woi_qty'] = $postvalue['open_qty'];
            $woitems['woi_manager_approve'] = '0';
            $this->db->insert('tbl_work_order_item',$woitems);

            $total_qty = $postvalue['approve_qty'] + $postvalue['open_qty'];

            $this->db->select('*');
            $this->db->from('tbl_work_order');
            $this->db->join('tbl_work_order_item','tbl_work_order_item.woi_wo_id = tbl_work_order.wo_id');
            $this->db->where('tbl_work_order_item.woi_id',$data['wo_itemid']);
            $this->db->where('tbl_work_order.wo_id',$data['wo_id']);
            $query = $this->db->get();
            if($query->num_rows() == 1)
            {
                $workorder_data = $query->row_array();
                $notimsg = $workorder_data['wo_wo_no'].' - '.$workorder_data['woi_part_no'].'-Qty: '.$postvalue['approve_qty']." Out of  ".$total_qty." Approved By "." Approved By ".$this->session->userdata['miconlogin']['fname'].' Waitning for Admin Confirmation';
            }else{
                $notimsg = "".$postvalue['approve_qty']." Out of  ".$total_qty." Approved By ".$this->session->userdata['miconlogin']['fname'];
            }

            $noti = array(
                    'wo_noti_woid' => $data['wo_id'],
                    'wo_noti_wo_itmid' => $data['wo_itemid'],
                    'wo_noti_msg' => $notimsg,
                    'wo_noti_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
                    'wo_noti_date' => date('Y-m-d H:i:s')
                );
            $this->db->insert('tbl_work_order_notification',$noti);
            $wonid = $this->db->insert_id();
            $assigndep = array('super_admin','sales_manager','production_manager');
            $this->assign_notification_rights($wonid,$assigndep,$single_user = false,$data['wo_id']);

        }else{
            echo 'sfasfasf';die;
        }
    }
    public function update_wo_items_promanager($postvalue,$data)
    {
        $this->db->select('*');
        $this->db->from('tbl_work_order_item');
        $this->db->where('woi_id',$data['wo_itemid']);
        $query = $this->db->get();
        if($query->num_rows() == 1)
        {
            $woitems = $query->row_array();
            $this->db->delete('tbl_work_order_item',array("woi_id" => $data['wo_itemid']));

            unset($woitems['woi_id']);
            $woitems['woi_qty'] = $postvalue['approve_qty'];
            $woitems['woi_promanager_approve'] = '1';
            $woitems['woi_promanager_approve_date'] = date("Y-m-d H:i:s");
            $this->db->insert('tbl_work_order_item',$woitems);
            unset($woitems['woi_promanager_approve_date']);
            $woitems['woi_qty'] = $postvalue['open_qty'];
            $woitems['woi_promanager_approve'] = '0';
            $this->db->insert('tbl_work_order_item',$woitems);

            $total_qty = $postvalue['approve_qty'] + $postvalue['open_qty'];

            $this->db->select('*');
            $this->db->from('tbl_work_order');
            $this->db->join('tbl_work_order_item','tbl_work_order_item.woi_wo_id = tbl_work_order.wo_id');
            $this->db->where('tbl_work_order_item.woi_id',$data['wo_itemid']);
            $this->db->where('tbl_work_order.wo_id',$data['wo_id']);
            $query = $this->db->get();
            if($query->num_rows() == 1)
            {
                $workorder_data = $query->row_array();
                $notimsg = $workorder_data['wo_wo_no'].' - '.$workorder_data['woi_part_no'].'-Qty: '.$postvalue['approve_qty']." Out of  ".$total_qty." Approved By "." Approved By ".$this->session->userdata['miconlogin']['fname'].' Waitning for Production Confirmation';
            }else{
                $notimsg = "".$postvalue['approve_qty']." Out of  ".$total_qty." Approved By ".$this->session->userdata['miconlogin']['fname'];
            }

            $noti = array(
                    'wo_noti_woid' => $data['wo_id'],
                    'wo_noti_wo_itmid' => $data['wo_itemid'],
                    'wo_noti_msg' => $notimsg,
                    'wo_noti_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
                    'wo_noti_date' => date('Y-m-d H:i:s')
                );
            $this->db->insert('tbl_work_order_notification',$noti);
            $wonid = $this->db->insert_id();
            $assigndep = array('super_admin','sales_manager','production_manager');
            $this->assign_notification_rights($wonid,$assigndep,$single_user = false,$data['wo_id']);

        }else{
            echo 'sfasfasf';die;
        }
    }

    public function update_wo_items_production($postvalue,$data)
    {
        echo "You can not update this values";die;
        $this->db->select('*');
        $this->db->from('tbl_work_order_item');
        $this->db->where('woi_id',$data['wo_itemid']);
        $query = $this->db->get();
        if($query->num_rows() == 1)
        {
            $woitems = $query->row_array();
            $this->db->delete('tbl_work_order_item',array("woi_id" => $data['wo_itemid']));

            unset($woitems['woi_id']);
            $woitems['woi_qty'] = $postvalue['approve_qty'];
            $woitems['woi_production_approve'] = '1';
            $woitems['woi_production_approve_date'] = date("Y-m-d H:i:s");
            $this->db->insert('tbl_work_order_item',$woitems);
            unset($woitems['woi_production_approve_date']);
            $woitems['woi_qty'] = $postvalue['open_qty'];
            $woitems['woi_production_approve'] = '0';
            $this->db->insert('tbl_work_order_item',$woitems);

            $total_qty = $postvalue['approve_qty'] + $postvalue['open_qty'];
            $noti = array(
                    'wo_noti_woid' => $data['wo_id'],
                    'wo_noti_wo_itmid' => $data['wo_itemid'],
                    'wo_noti_msg' => "".$postvalue['approve_qty']." Out of  ".$total_qty." Approved By ".$this->session->userdata['miconlogin']['fname'],
                    'wo_noti_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
                    'wo_noti_date' => date('Y-m-d H:i:s')
                );
            $this->db->insert('tbl_work_order_notification',$noti);
            $wonid = $this->db->insert_id();
            $assigndep = array('super_admin','sales_manager','production_manager','store');
            $this->assign_notification_rights($wonid,$assigndep,$single_user = false,$data['wo_id']);

        }else{
            echo 'sfasfasf';die;
        }
    }

    public function update_wo_items_store($postvalue,$data)
    {
        echo "You can not update this values";die;
        $this->db->select('*');
        $this->db->from('tbl_work_order_item');
        $this->db->where('woi_id',$data['wo_itemid']);
        $query = $this->db->get();
        if($query->num_rows() == 1)
        {
            $woitems = $query->row_array();
            $this->db->delete('tbl_work_order_item',array("woi_id" => $data['wo_itemid']));

            unset($woitems['woi_id']);
            $woitems['woi_qty'] = $postvalue['approve_qty'];
            $woitems['woi_store_approve'] = '1';
            $woitems['woi_production_approve'] = '2';
            $woitems['woi_store_approve_date'] = date("Y-m-d H:i:s");
            $this->db->insert('tbl_work_order_item',$woitems);
            $data['wo_itemid'] = $this->db->insert_id();
            unset($woitems['woi_store_approve_date']);
            $woitems['woi_qty'] = $postvalue['open_qty'];
            $woitems['woi_store_approve'] = '0';
            $woitems['woi_production_approve'] = '1';
            $this->db->insert('tbl_work_order_item',$woitems);

            $total_qty = $postvalue['approve_qty'] + $postvalue['open_qty'];
            $noti = array(
                    'wo_noti_woid' => $data['wo_id'],
                    'wo_noti_wo_itmid' => $data['wo_itemid'],
                    'wo_noti_msg' => "".$postvalue['approve_qty']." Out of  ".$total_qty." Approved By ".$this->session->userdata['miconlogin']['fname'],
                    'wo_noti_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
                    'wo_noti_date' => date('Y-m-d H:i:s')
                );
            $this->db->insert('tbl_work_order_notification',$noti);
            $wonid = $this->db->insert_id();
            $assigndep = array('super_admin','sales_manager','production_manager','production');
            $this->assign_notification_rights($wonid,$assigndep,$single_user = false,$data['wo_id']);
            
        }else{
            echo 'sfasfasf';die;
        }



        $this->db->select('*');
        $this->db->from('tbl_work_order_item');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
        $this->db->where('woi_id',$data['wo_itemid']);
        $this->db->where('wo_isdeleted','0');
        $this->db->where('woi_store_approve','1');
        $query = $this->db->get();
        $wodata = $query->row_array();
        //echo "<pre>";print_r($wodata);die;



        $this->db->select('otw_id');
        $this->db->from('tbl_outward');
        $this->db->where('otw_work_ord_id',$wodata['woi_wo_id']);
        $this->db->where('otw_completed','0');
        $query = $this->db->get();
        $autoid = $query->row_array();
        //echo "<pre>";print_r($autoid);die;


        if($query->num_rows() == 0)
        {
                $this->db->select('otw_id');
                $this->db->from('tbl_outward');
                $this->db->order_by('otw_id','DESC');
                $this->db->limit(1);
                $query = $this->db->get();
                $autoid = $query->row_array();
                $this->db->select('*');
                $this->db->from('tbl_prefix');
                //$this->db->where('pre_cid',$this->session->userdata['login']['aus_Id']);
                $query = $this->db->get();
                $code = $query->row_array();
                $autoid['otw_id'] = isset($autoid['otw_id']) ? $autoid['otw_id'] : '';
                $otwno = $code['pre_Outward'].''.($autoid['otw_id']+1);




                $item = array(
                'otw_no' => $otwno,
                'otw_customer_name' => $wodata['wo_customer_name'],
                'otw_customer_id' => $wodata['wo_customer_id'],
                //'otw_invoice_no' => $wodata['otw_invoice_no'],
                'otw_work_ord_no' => $wodata['wo_wo_no'],
                'otw_work_ord_id' => $wodata['woi_wo_id'],
                'otw_completed' => '0',
                'otw_cid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
                'otw_cdate' => date('Y-m-d H:i:s'),
                'otw_udate' => date('Y-m-d H:i:s')
                );
                //echo '<pre>';print_r($item);die;
                $this->db->insert('tbl_outward',$item);
                $lid = $this->db->insert_id();

                $value['otwid'] = $lid;
                $item1 = array(
                'otwi_owt_id' => $lid,
                'otwi_itm_name' => $wodata['woi_item_id'],
                'otwi_itm_title' => $wodata['woi_itm_title'],
                'otwi_itm_desc ' => $wodata['woi_itm_desc'],
                'otwi_part_no'=> isset($wodata['woi_part_no']) ? $wodata['woi_part_no'] : '',
                'otwi_stock'=> $wodata['woi_stock'],
                'otwi_qty'=> $wodata['woi_qty'],
                'otwi_price'=> $wodata['woi_price'],
                'otwi_total'=> $wodata['woi_total'],
                'otwi_discount'=> $wodata['woi_discount'],
                'otwi_ftotal'=> $wodata['woi_final_price'],
                'otwi_udate' => date('Y-m-d H:i:s'),
                'otwi_woid' => $wodata['woi_wo_id'],
                'otwi_woitemid' => $data['wo_itemid']
                );
                //echo '<pre>'; print_r($item1); die;
                $this->db->insert('tbl_outward_item',$item1);
                $item_lid = $this->db->insert_id();
                $value['itmid'] = $item_lid;

                $transaction = array(
                            'tran_itm_id' => $wodata['woi_item_id'],
                            'tran_itm_qty' => $wodata['woi_qty'],
                            'tran_otw_id' => $lid,
                            'tran_otw_item_id' => $item_lid,
                            'tran_cr_or_dr' => 2,
                            'tran_add_or_edit' => 1,
                            'tran_ip' => $_SERVER['REMOTE_ADDR'],
                            'tran_cid'=> $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
                            'tran_cdate' => date('Y-m-d H:i:s'),
                            'tran_udate' => date('Y-m-d H:i:s')
                        );
                    $this->db->insert('tbl_transaction',$transaction);
        }else{
            $item1 = array(
                'otwi_owt_id' => $autoid['otw_id'],
                'otwi_itm_name' => $wodata['woi_item_id'],
                'otwi_itm_title' => $wodata['woi_itm_title'],
                'otwi_itm_desc ' => $wodata['woi_itm_desc'],
                'otwi_part_no'=> isset($wodata['woi_part_no']) ? $wodata['woi_part_no'] : '',
                'otwi_stock'=> $wodata['woi_stock'],
                'otwi_qty'=> $wodata['woi_qty'],
                'otwi_price'=> $wodata['woi_price'],
                'otwi_total'=> $wodata['woi_total'],
                'otwi_discount'=> $wodata['woi_discount'],
                'otwi_ftotal'=> $wodata['woi_final_price'],
                'otwi_udate' => date('Y-m-d H:i:s'),
                'otwi_woid' => $wodata['woi_wo_id'],
                'otwi_woitemid' => $data['wo_itemid']
                );
                //echo '<pre>'; print_r($item1); die;
                $this->db->insert('tbl_outward_item',$item1);
                $item_lid = $this->db->insert_id();

                $value['itmid'] = $item_lid;
                $value['otwid'] = $autoid['otw_id'];

                $transaction = array(
                            'tran_itm_id' => $wodata['woi_item_id'],
                            'tran_itm_qty' => $wodata['woi_qty'],
                            'tran_otw_id' => $autoid['otw_id'],
                            'tran_otw_item_id' => $item_lid,
                            'tran_cr_or_dr' => 2,
                            'tran_add_or_edit' => 1,
                            'tran_ip' => $_SERVER['REMOTE_ADDR'],
                            'tran_cid'=> $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
                            'tran_cdate' => date('Y-m-d H:i:s'),
                            'tran_udate' => date('Y-m-d H:i:s')
                        );
                    $this->db->insert('tbl_transaction',$transaction);
        }

        return $value;

    }

    public function get_production_user()
    {
        $this->db->select('au_id,au_fname,au_lname');
        $this->db->from('tbl_admin_users');
        $this->db->where('au_dep_id',9);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_admin_user($data)
    {
        $this->db->select('au_id,au_fname,au_lname');
        $this->db->from('tbl_admin_users');
        $this->db->where('au_dep_id',9);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function update_production_user($postvalue,$data)
    {
        //echo "<pre>";print_r($postvalue);die;
        $updatear = array('woi_production_cid' => $postvalue['select_admin'],'woi_itm_remark' => $postvalue['woi_itm_remark'],'woi_production_assigndt' => date("Y-m-d H:i:s"));
        $this->db->where('woi_id',$data['wo_itemid']);
        $this->db->update('tbl_work_order_item',$updatear);

        $this->db->select('au_fname');
        $this->db->from('tbl_admin_users');
        $this->db->where('au_id',$postvalue['select_admin']);
        $query = $this->db->get();
        $admin_data = $query->row_array();
        //echo "<pre>";print_r($admin_data);die;

        $this->db->select('*');
        $this->db->from('tbl_work_order');
        $this->db->join('tbl_work_order_item','tbl_work_order_item.woi_wo_id = tbl_work_order.wo_id');
        $this->db->where('tbl_work_order_item.woi_id',$data['wo_itemid']);
        $this->db->where('tbl_work_order.wo_id',$data['wo_id']);
        $query = $this->db->get();
        if($query->num_rows() == 1)
        {
            $workorder_data = $query->row_array();
            $notimsg = $workorder_data['wo_wo_no'].' - '.$workorder_data['woi_part_no'].'-Qty: '.$workorder_data['woi_qty']." Approved By ".$this->session->userdata['miconlogin']['fname'].' Assign To '.$admin_data['au_fname'].' Waitning for Production '.$admin_data['au_fname'].' Confirmation';
        }else{
            $notimsg = "Assign To ".$admin_data['au_fname'];
        }

        $noti = array(
                    'wo_noti_woid' => $data['wo_id'],
                    'wo_noti_wo_itmid' => $data['wo_itemid'],
                    'wo_noti_msg' => $notimsg,
                    'wo_noti_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
                    'wo_noti_date' => date('Y-m-d H:i:s')
                );
        $this->db->insert('tbl_work_order_notification',$noti);
        $wonid = $this->db->insert_id();
        $assigndep = array('super_admin','sales_manager','production_manager');
        $single_user = array();
        $single_user[] = $postvalue['select_admin'];
        $this->assign_notification_rights($wonid,$assigndep,$single_user,$data['wo_id']);
    }

    public function outward_confirm($data)
    {
        //echo "<pre>";print_r($data);die;
        $updatear = array('otw_completed' => '1','otw_manager_confirm_date' => date("Y-m-d H:i:s"));
        $this->db->where('otw_id',$data['otw_id']);
        $this->db->update('tbl_outward',$updatear);

        $this->db->select('*');
        $this->db->from('tbl_work_order');
        $this->db->where('tbl_work_order.wo_id',$data['wo_id']);
        $query = $this->db->get();
        if($query->num_rows() == 1)
        {
            $workorder_data = $query->row_array();
            $notimsg = $workorder_data['wo_wo_no'].' - '." Approved By ".$this->session->userdata['miconlogin']['fname'].' Waitning for Account department Confirmation';
        }else{
            $notimsg = "Approved For Billing By ".$this->session->userdata['miconlogin']['fname'];
        }

        $noti = array(
                    'wo_noti_woid' => $data['wo_id'],
                    //'wo_noti_wo_itmid' => $data['wo_itemid'],
                    'wo_noti_msg' => $notimsg,
                    'wo_noti_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
                    'wo_noti_date' => date('Y-m-d H:i:s')
                );
            $this->db->insert('tbl_work_order_notification',$noti);
            $wonid = $this->db->insert_id();
            $assigndep = array('accounts','super_admin','sales_manager','production_manager');
            $this->assign_notification_rights($wonid,$assigndep,$single_user = false,$data['wo_id']);
    }

    public function invnocheck()
    {
        $value = $this->input->get();
        $otwid=$value['otw_id'];
        //echo "<pre>";print_r($value);die;
        if($this->input->get('invoice_tupe') == 1)
        {
            $insert = array('otw_invoice_type' => '1');
            $this->db->where('otw_id',$otwid);
            $this->db->update('tbl_outward',$insert);
        }
        else if($this->input->get('invoice_tupe') == 2)
        {
            $insert = array('otw_invoice_type' => '2');
            $this->db->where('otw_id',$otwid);
            $this->db->update('tbl_outward',$insert);
        }
        else
        {
            $insert = array('otw_invoice_type' => '3');
            $this->db->where('otw_id',$otwid);
            $this->db->update('tbl_outward',$insert);
        }
    }
    public function get_wo_type()
    {
        $this->db->select('*');
        $this->db->from('tbl_work_order_type');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_invoiceno($data)
    {
        //echo '<pre>';print_r($data);die;
        if($data == 1)
        {
            $this->db->select('otw_invno');
            $this->db->from('tbl_outward');
            $this->db->where('otw_invoice_type',$data);
            $this->db->order_by('otw_id','DESC');
            $this->db->limit(1);
            $query = $this->db->get();
            //echo '<pre>';print_r($query->row_array());die;
            $autoid = $query->row_array();
            $autoid['otw_invno'] = isset($autoid['otw_invno']) ? $autoid['otw_invno'] : '';
            $otw_invno = explode("TI-",$autoid['otw_invno']);
            //echo '<pre>';print_r($iparr);die;
            return "TI-".''.($otw_invno['1']+1);
        }
        else if($data == 2)
        {
            $this->db->select('otw_invno');
            $this->db->from('tbl_outward');
            $this->db->where('otw_invoice_type',$data);
            $this->db->order_by('otw_id','DESC');
            $this->db->limit(1);
            $query = $this->db->get();
            //echo '<pre>';print_r($query->row_array());die;
            $autoid = $query->row_array();
            $autoid['otw_invno'] = isset($autoid['otw_invno']) ? $autoid['otw_invno'] : '';
            $otw_invno = explode("RT-",$autoid['otw_invno']);
            //echo '<pre>';print_r($iparr);die;
            return "RT-".''.($otw_invno['1']+1);
        }
        else if($data == 3)
        {
            $this->db->select('otw_invno');
            $this->db->from('tbl_outward');
            $this->db->where('otw_invoice_type',$data);
            $this->db->order_by('otw_id','DESC');
            $this->db->limit(1);
            $query = $this->db->get();
            //echo '<pre>';print_r($query->row_array());die;
            $autoid = $query->row_array();
            $autoid['otw_invno'] = isset($autoid['otw_invno']) ? $autoid['otw_invno'] : '';
            $otw_invno = explode("RP-",$autoid['otw_invno']);
            //echo '<pre>';print_r($iparr);die;
            return "RP-".''.($otw_invno['1']+1);
        }
       
    }
    public function get_challan_no()
    {
        $this->db->select('otw_challan_no');
        $this->db->from('tbl_outward');
        $this->db->order_by('otw_id','DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        //echo '<pre>';print_r($query->row_array());die;
        $autoid = $query->row_array();
        $autoid['otw_challan_no'] = isset($autoid['otw_challan_no']) ? $autoid['otw_challan_no'] : '';
        //echo '<pre>';print_r($iparr);die;
        return ($autoid['otw_challan_no']+1);
    }
    public function check_invoice_type($data)
    {
        $result = array();
        $result['invoice_no'] = '';
        $result['challan_no'] = '';
        $result['invoice_type'] = 0;
        //echo '<pre>';print_r($data);die;
        $this->db->select('otw_invoice_type');
        $this->db->from('tbl_outward');
        $this->db->where('otw_id',$data);
        $query = $this->db->get();
        $inv_type = $query->row_array();

        $this->db->select('otw_invno,otw_challan_account');
        $this->db->from('tbl_outward');
        $this->db->where('otw_invoice_type',$inv_type['otw_invoice_type']);
        $this->db->where('otw_completed','2');
        $this->db->order_by('otw_id','DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        $otw_data = $query->row_array();
        $prefix = '';
        if(isset($inv_type) && isset($inv_type['otw_invoice_type']) && ($inv_type['otw_invoice_type'] == 1))
        {
            $prefix = 'TI-';
        }else if(isset($inv_type) && isset($inv_type['otw_invoice_type']) && ($inv_type['otw_invoice_type'] == 2))
        {
            $prefix = 'RT-';
        }else if(isset($inv_type) && isset($inv_type['otw_invoice_type']) && ($inv_type['otw_invoice_type'] == 3))
        {
            $prefix = 'RP-';
        }else{
            $prefix = '';
        }
        $result['invoice_type'] = $inv_type['otw_invoice_type'];
        $noget = explode($prefix, $otw_data['otw_invno']);

        $this->db->select('otw_invno,otw_challan_account');
        $this->db->from('tbl_outward');
        $this->db->where('otw_completed','2');
        $this->db->order_by('otw_id','DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        $challan_data = $query->row_array();

        $chnoget = $challan_data['otw_challan_account'];
        if(isset($noget) && is_array($noget) && !empty($noget) && isset($noget[1]) && ($noget[1] != ''))
        {
            $result['invoice_no'] = $prefix.($noget[1]+1);
        }else{
            $result['invoice_no'] = $prefix.'1';
        }
        if(isset($chnoget) && ($chnoget != ''))
        {
            $result['challan_no'] = $chnoget+1;
        }else{
            $result['challan_no'] = $chnoget+1;
        }
        //echo '<pre>';print_r($inv_type);die;
        return $result;
    }
    public function get_invoicedata($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_outward');
        $this->db->where('otw_id',$id);
        $query = $this->db->get();
        //echo '<pre>';print_r($query->row_array());die;
        return $query->row_array();
        //echo '<pre>';print_r($data);die;

    }

    public function insert_reinvoicedata($data)
    {
        //echo '<pre>';print_r($data);die;
        $updatear = array('otw_invno' => $data['inv_no'],'otw_completed' => '2','otw_invdate' => date("Y-m-d", strtotime($data['inv_date'])),'otw_challan_no' => $data['otw_challan_no'],'otw_challan_date' => date("Y-m-d", strtotime($data['otw_challan_date'])),'otw_invftotal' => $data['inv_amount']);
        $this->db->where('otw_id',$data['otw_id']);
        $this->db->update('tbl_outward',$updatear);
    }
    public function insert_invoicedata($data)
    {
        //echo '<pre>';print_r($data);die;
        $updatear = array('otw_invno' => $data['inv_no'],'otw_completed' => '2','otw_invdate' => date("Y-m-d", strtotime($data['inv_date'])),'otw_challan_no' => $data['otw_challan_no'],'otw_challan_date' => date("Y-m-d", strtotime($data['otw_challan_date'])),'otw_invftotal' => $data['inv_amount'],'otw_account_confirm_date' => date("Y-m-d H:i:s"));
        $this->db->where('otw_id',$data['otw_id']);
        $this->db->update('tbl_outward',$updatear);

        $this->db->select('otw_work_ord_id');
        $this->db->from('tbl_outward');
        $this->db->where('otw_id',$data['otw_id']);
        $query = $this->db->get();
        $woid = $query->row_array();
       //echo '<pre>';print_r($woid['otw_work_ord_id']);die;

        $this->db->select('otwi_woitemid,otw_work_ord_id');
        $this->db->from('tbl_outward');
        $this->db->join('tbl_outward_item','tbl_outward_item.otwi_owt_id = tbl_outward.otw_id');
        $this->db->where('otw_id',$data['otw_id']);
        $this->db->where('otw_isdelete',0);
        $this->db->where('otwi_isdelete',0);
        $query = $this->db->get();
        $itmdata = $query->result_array();
        foreach ($itmdata as $key => $value)
        {
            $updatear = array('woi_account_approve' => '1','woi_account_approve_date' => date("Y-m-d H:i:s"));
            $this->db->where('woi_id',$value['otwi_woitemid']);
            $this->db->update('tbl_work_order_item',$updatear);
        }

        if(isset($itmdata) && is_array($itmdata) && !empty($itmdata) && isset($itmdata[0]) && isset($itmdata[0]['otw_work_ord_id']))
        {
            //otw_work_ord_id
            $this->db->select('*');
            $this->db->from('tbl_work_order_item');
            $this->db->where('woi_wo_id',$itmdata[0]['otw_work_ord_id']);
            $this->db->where('woi_account_approve','0');
            $query = $this->db->get();
            if($query->num_rows() == 0)
            {
                $this->db->set('wo_iscompleted',1);
                $this->db->set('wo_completed_date',date("Y-m-d H:i:s"));
                $this->db->where('wo_id',$woid['otw_work_ord_id']);
                $this->db->update('tbl_work_order');
            }
        }

        // ******************************************************************************************


        $this->db->select('*');
        $this->db->from('tbl_work_order');
        $this->db->where('tbl_work_order.wo_id',$woid['otw_work_ord_id']);
        $query = $this->db->get();
        if($query->num_rows() == 1)
        {
            $workorder_data = $query->row_array();
            $notimsg = $workorder_data['wo_wo_no'].' - '." Approved By ".$this->session->userdata['miconlogin']['fname'].'. Item Ready For dispatch.';
        }else{
            $notimsg = "Approved By ".$this->session->userdata['miconlogin']['fname']." Item Ready For dispatch. ";
        }

        $noti = array(
                'wo_noti_woid' => $woid['otw_work_ord_id'],
                //'wo_noti_wo_itmid' => $data['wo_itemid'],
                'wo_noti_msg' => $notimsg,
                'wo_noti_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
                'wo_noti_date' => date('Y-m-d H:i:s')
            );
        $this->db->insert('tbl_work_order_notification',$noti);
        $wonid = $this->db->insert_id();
        $assigndep = array('test','accounts','super_admin','sales_manager','production_manager');
        $this->assign_notification_rights($wonid,$assigndep,$single_user = false,$woid['otw_work_ord_id']);


        // ******************************************************************************************

        $this->db->select('*');
        $this->db->from('tbl_outward');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_outward.otw_work_ord_id');
        $this->db->join('tbl_master_party','tbl_master_party.master_party_id = tbl_outward.otw_customer_id','left');
        $this->db->where('otw_id',$data['otw_id']);
        $query = $this->db->get();
        $otwdata = $query->row_array();
        //echo '<pre>';print_r($otwdata);die;

        if($otwdata['wo_demoreturn'] != 1 && $otwdata['otw_demoreturn'] != 1)
        {
            $this->db->select('dis_id');
            $this->db->from('tbl_dispatch');
            $this->db->order_by('dis_id','DESC');
            $this->db->limit(1);
            $query = $this->db->get();
            $autoid = $query->row_array();
            /* $this->db->select('*');
            $this->db->from('tbl_prefix');
            //$this->db->where('pre_cid',$this->session->userdata['login']['aus_Id']);
            $query = $this->db->get();
            $code = $query->row_array();
            $autoid['dis_id'] = isset($autoid['dis_id']) ? $autoid['dis_id'] : '';
            $disno = $code['pre_dispatch'].''.($autoid['dis_id']+1); */

            if(date("m") < 4)
            {
                $last_year = date('y', strtotime('-1 year'));
                $this_year = date('y');
                $year_string = $last_year.''.$this_year.'-'.strtoupper(date('M'));
            }else{
                $next_year = date('y', strtotime('+1 year'));
                $this_year = date('y');
                $year_string = $this_year.''.$next_year.'-'.strtoupper(date('M'));
            }

            $autoid['dis_id'] = isset($autoid['dis_id']) ? $autoid['dis_id'] : '';
            $disno = 'DIS-'.$year_string.'-'.($autoid['dis_id']+1);

            $item = array(
                'dis_no' => $disno,
                'dis_po_no' => $otwdata['wo_po_no'],
                'dis_po_date' => $otwdata['wo_po_date'],
                'dis_wo_no' => $otwdata['wo_wo_no'],
                'dis_wo_date' => $otwdata['wo_wo_date'],
                'dis_woid' => $otwdata['otw_work_ord_id'],
                'dis_otwid' => $otwdata['otw_id'],
                'dis_vendor' => $otwdata['otw_customer_name'],
                'dis_courier_name' => $otwdata['wo_couriername'],
                'dis_cust_address' => $otwdata['wo_address'],
                'dis_vendorid' => $otwdata['otw_customer_id'],
                'dis_cust_name' => $otwdata['otw_customer_name'],
                //'dis_cust_email' => $otwdata['master_party_email_address'],
                'dis_cid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
                'dis_cdate' => date('Y-m-d H:i:s'),
                'dis_udate' => date('Y-m-d H:i:s'),
                'dis_docket_date' => date('Y-m-d H:i:s')
                );
                //echo '<pre>';print_r($item);die;
            $this->db->insert('tbl_dispatch',$item);
            $lid = $this->db->insert_id();

            $this->db->select('*');
            $this->db->from('tbl_outward_item');
            $this->db->where('otwi_owt_id',$data['otw_id']);
            $this->db->where('otwi_isdelete',0);
            $query = $this->db->get();
            //echo'<pre>';print_r($query->result_array());die;
            $data['inqitm'] = $query->result_array();
            if(isset($data['inqitm']) && !empty($data['inqitm']) && $data['inqitm'] != '')
            {
                foreach($data['inqitm'] as $key => $itm)
                {
                    //echo'<pre>';print_r($itm['otwi_itm_name']);die;
                $item = array(
                        'disi_dispatch_id' => $lid,
                        'disi_woid' => $itm['otwi_woid'],
                        'disi_woitmid' => $itm['otwi_woitemid'],
                        'disi_otwid' => $itm['otwi_owt_id'],
                        'disi_otwitm' => $itm['otwi_id'],
                        'disi_itm_name' => $itm['otwi_itm_name'],
                        'disi_itm_code' => $itm['otwi_itm_code'],
                        'disi_itm_title' => $itm['otwi_itm_title'],
                        'disi_partno'=> isset($itm['otwi_part_no']) ? $itm['otwi_part_no'] : '',
                        'disi_qty'=> $itm['otwi_qty'],
                        'disi_unit'=> $itm['otwi_unit'],
                        'disi_itm_price'=> $itm['otwi_price'],
                        'disi_itm_total'=> $itm['otwi_total'],
                        'disi_itm_discount'=> $itm['otwi_discount'],
                        'disi_ftotal'=> $itm['otwi_ftotal'],
                        'disi_udate' => date('Y-m-d H:i:s')
                        );
                    //echo'<pre>';print_r($item);die;
                    $this->db->insert('tbl_dispatch_item',$item);
                    }
            }
        }
        
    }
    public function delete_wo_items($data)
    {
        $this->db->select('*');
        $this->db->from('tbl_work_order_item');
        $this->db->where('woi_id',$data['wo_itemid']);
        $query = $this->db->get();
        if($query->num_rows() == 1)
        {
            $itemdata = $query->row_array();
            unset($itemdata['woi_id']);
            //unset($itemdata['woi_comment']);
            $this->db->insert('tbl_work_order_item_delete',$itemdata);
            //echo '<pre>';print_r($data['wo_itemid']);die;
            $this->db->where('woi_id',$data['wo_itemid']);
            $this->db->delete('tbl_work_order_item');

            $transaction = array(
                    'tran_itm_id' => $itemdata['woi_item_id'],
                    'tran_itm_qty' => $itemdata['woi_qty'],
                    'tran_wo_id ' => $itemdata['woi_wo_id'],
                    'tran_woi_id' => $data['wo_itemid'],
                    'tran_is_hold' => "1",
                    'tran_cr_or_dr' => 1,
                    'tran_add_or_edit' => 1,
                    'tran_ip' => $_SERVER['REMOTE_ADDR'],
                    'tran_cid'=> $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
                    'tran_cdate' => date('Y-m-d H:i:s'),
                    'tran_udate' => date('Y-m-d H:i:s')
                );
            $this->db->insert('tbl_transaction',$transaction);

            $noti = array(
                    'wo_noti_woid' => $data['wo_id'],
                    'wo_noti_wo_itmid' => $data['wo_itemid'],
                    'wo_noti_msg' => "Delete Item :".$itemdata['woi_part_no']." By ".$this->session->userdata['miconlogin']['fname'],
                    'wo_noti_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
                    'wo_noti_date' => date('Y-m-d H:i:s')
                );
            $this->db->insert('tbl_work_order_notification',$noti);
             $wonid = $this->db->insert_id();
            $assigndep = array('super_admin','sales_manager','production_manager','production');
            $this->assign_notification_rights($wonid,$assigndep,$single_user = false,$data['wo_id']);
        }
    }
    public function insert_productiondata($data)
    {
       // echo '<pre>';print_r($this->input->get());die;

        $this->db->select('wo_type');
        $this->db->from('tbl_work_order');
        $this->db->where('wo_id',$this->input->get('wo_id'));
        $query = $this->db->get();
        $wotype_data = $query->row_array();
        //echo '<pre>';print_r($wotype_data['wo_type']);die;
        if($wotype_data['wo_type'] == 3)
        {

            $updatear = array('otw_weight' => $data['wo_productweight'],'otw_paymentinfo' => $data['wo_paymentinfo'],'otw_paymentrecive' => $data['wo_payment_receive']);
            $this->db->where('otw_id',$this->input->get()['otw_id']);
            $this->db->update('tbl_outward',$updatear);

            if(isset($data['wo_payment_img']))
            {
                $item = array(
                'otw_payment_img' => $data['wo_payment_img']
                );
                $this->db->where('otw_id',$this->input->get()['otw_id']);
                $this->db->update('tbl_outward', $item); 
            }

            $this->db->select('otwi_woitemid');
            $this->db->from('tbl_outward');
            $this->db->join('tbl_outward_item','tbl_outward_item.otwi_owt_id = tbl_outward.otw_id');
            $this->db->where('otw_id',$this->input->get()['otw_id']);
            $query = $this->db->get();
            $itmdata = $query->result_array();
            foreach ($itmdata as $key => $value)
            {
                $updatear = array('woi_promanager_approve' => '2','woi_promanager_approve_date' => date("Y-m-d H:i:s"));
                $this->db->where('woi_id',$value['otwi_woitemid']);
                $this->db->update('tbl_work_order_item',$updatear);
            }

            /********************** dispatch Insert  ******************************************************************/
            $this->db->select('*');
            $this->db->from('tbl_outward');
            $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_outward.otw_work_ord_id');
                    $this->db->join('tbl_master_party','tbl_master_party.master_party_id = tbl_outward.otw_customer_id','left');
            $this->db->where('otw_id',$this->input->get('otw_id'));
            $query = $this->db->get();
            $otwdata = $query->row_array();
            //echo '<pre>';print_r($otwdata);die;


            $this->db->select('dis_id');
            $this->db->from('tbl_dispatch');
            $this->db->order_by('dis_id','DESC');
            $this->db->limit(1);
            $query = $this->db->get();
            $autoid = $query->row_array();
            /* $this->db->select('*');
            $this->db->from('tbl_prefix');
            //$this->db->where('pre_cid',$this->session->userdata['login']['aus_Id']);
            $query = $this->db->get();
            $code = $query->row_array();
            $autoid['dis_id'] = isset($autoid['dis_id']) ? $autoid['dis_id'] : '';
            $disno = $code['pre_dispatch'].''.($autoid['dis_id']+1); */

            if(date("m") < 4)
            {
                $last_year = date('y', strtotime('-1 year'));
                $this_year = date('y');
                $year_string = $last_year.''.$this_year.'-'.strtoupper(date('M'));
            }else{
                $next_year = date('y', strtotime('+1 year'));
                $this_year = date('y');
                $year_string = $this_year.''.$next_year.'-'.strtoupper(date('M'));
            }

            $autoid['dis_id'] = isset($autoid['dis_id']) ? $autoid['dis_id'] : '';
            $disno = 'DIS-'.$year_string.'-'.($autoid['dis_id']+1);

            $item = array(
                'dis_no' => $disno,
                'dis_po_no' => $otwdata['wo_po_no'],
                'dis_po_date' => $otwdata['wo_po_date'],
                'dis_wo_no' => $otwdata['wo_wo_no'],
                'dis_wo_date' => $otwdata['wo_wo_date'],
                'dis_woid' => $otwdata['otw_work_ord_id'],
                'dis_otwid' => $otwdata['otw_id'],
                'dis_vendor' => $otwdata['otw_customer_name'],
                'dis_courier_name' => $otwdata['wo_couriername'],
                'dis_cust_address' => $otwdata['wo_address'],
                'dis_vendorid' => $otwdata['otw_customer_id'],
                'dis_cust_name' => $otwdata['otw_customer_name'],
                //'dis_cust_email' => $otwdata['master_party_email_address'],
                'dis_cid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
                'dis_cdate' => date('Y-m-d H:i:s'),
                'dis_udate' => date('Y-m-d H:i:s')
                );
                //echo '<pre>';print_r($item);die;
            $this->db->insert('tbl_dispatch',$item);
            $lid = $this->db->insert_id();

            $this->db->select('*');
            $this->db->from('tbl_outward_item');
            $this->db->where('otwi_owt_id',$this->input->get('otw_id'));
            $this->db->where('otwi_isdelete',0);
            $query = $this->db->get();
            //echo'<pre>';print_r($query->result_array());die;
            $data['inqitm'] = $query->result_array();
            if(isset($data['inqitm']) && !empty($data['inqitm']) && $data['inqitm'] != '')
            {
                foreach($data['inqitm'] as $key => $itm)
                {
                    //echo'<pre>';print_r($itm['otwi_itm_name']);die;
                $item = array(
                        'disi_dispatch_id' => $lid,
                        'disi_woid' => $itm['otwi_woid'],
                        'disi_woitmid' => $itm['otwi_woitemid'],
                        'disi_otwid' => $itm['otwi_owt_id'],
                        'disi_otwitm' => $itm['otwi_id'],
                        'disi_itm_name' => $itm['otwi_itm_name'],
                        'disi_itm_code' => $itm['otwi_itm_code'],
                        'disi_itm_title' => $itm['otwi_itm_title'],
                        'disi_partno'=> isset($itm['otwi_part_no']) ? $itm['otwi_part_no'] : '',
                        'disi_qty'=> $itm['otwi_qty'],
                        'disi_unit'=> $itm['otwi_unit'],
                        'disi_itm_price'=> $itm['otwi_price'],
                        'disi_itm_total'=> $itm['otwi_total'],
                        'disi_itm_discount'=> $itm['otwi_discount'],
                        'disi_ftotal'=> $itm['otwi_ftotal'],
                        'disi_udate' => date('Y-m-d H:i:s')
                        );
                    //echo'<pre>';print_r($item);die;
                    $this->db->insert('tbl_dispatch_item',$item);

                    $updatear = array('woi_account_approve' => '1','woi_account_approve_date' => date("Y-m-d H:i:s"));
                    $this->db->where('woi_id',$itm['otwi_woitemid']);
                    $this->db->update('tbl_work_order_item',$updatear);
                }
            }
            
            $updatear = array('otw_completed' => '2');
            $this->db->where('otw_id',$this->input->get('otw_id'));
            $this->db->update('tbl_outward',$updatear);

            if($this->input->get('wo_id'))
            {
                //otw_work_ord_id
                $this->db->select('*');
                $this->db->from('tbl_work_order_item');
                $this->db->where('woi_wo_id',$this->input->get('wo_id'));
                $this->db->where('woi_account_approve','0');
                $query = $this->db->get();
                if($query->num_rows() == 0)
                {
                    $this->db->set('wo_iscompleted',1);
                    $this->db->set('wo_completed_date',date("Y-m-d H:i:s"));
                    $this->db->where('wo_id',$this->input->get('wo_id'));
                    $this->db->update('tbl_work_order');
                }
            }
            
            // $this->db->set('wo_iscompleted',1);
            // $this->db->set('wo_completed_date',date("Y-m-d H:i:s"));
            // $this->db->where('wo_id',$this->input->get('wo_id'));
            // $this->db->update('tbl_work_order');
        }
        else{
            $updatear = array('otw_weight' => $data['wo_productweight'],'otw_paymentinfo' => $data['wo_paymentinfo'],'otw_paymentrecive' => $data['wo_payment_receive']);
            $this->db->where('otw_id',$this->input->get()['otw_id']);
            $this->db->update('tbl_outward',$updatear);

            if(isset($data['wo_payment_img']))
            {
                $item = array(
                'otw_payment_img' => $data['wo_payment_img']
                );
                $this->db->where('otw_id',$this->input->get()['otw_id']);
                $this->db->update('tbl_outward', $item); 
            }

            $this->db->select('otwi_woitemid');
            $this->db->from('tbl_outward');
            $this->db->join('tbl_outward_item','tbl_outward_item.otwi_owt_id = tbl_outward.otw_id');
            $this->db->where('otw_id',$this->input->get()['otw_id']);
            $query = $this->db->get();
            $itmdata = $query->result_array();
            foreach ($itmdata as $key => $value)
            {
                $updatear = array('woi_promanager_approve' => '2','woi_promanager_approve_date' => date("Y-m-d H:i:s"));
                $this->db->where('woi_id',$value['otwi_woitemid']);
                $this->db->update('tbl_work_order_item',$updatear);
            }
        }
    }
    public function assign_notification_rights($wonid,$assigndep,$single_user,$work_order_id)
    {
        if(isset($assigndep) && !empty($assigndep))
        {
            $first = 0;
            foreach ($assigndep as $dkey => $dep) { $first++;
                $depid = 0;
                if($dep == 'super_admin')
                {
                    $depid = 12;
                }
                if($dep == 'sales_manager')
                {
                    $depid = 10;
                }
                if($dep == 'production_manager')
                {
                    $depid = 11;
                }
                if($dep == 'production')
                {
                    $depid = 9;
                }
                if($dep == 'store')
                {
                    $depid = 5;
                }
                if($dep == 'accounts')
                {
                    $depid = 2;
                }
                if($dep == 'dispatch')
                {
                    $depid = 4;
                }
                if($dep == 'sales')
                {
                    $depid = 1;
                }
                $this->db->select('au_id');
                $this->db->from('tbl_admin_users');
                $this->db->where('au_dep_id',$depid);
                $query = $this->db->get();
                foreach ($query->result_array() as $adkey => $adusers) {
                    $insertar = array(
                        'wna_fromid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
                        'wna_toid' => $adusers['au_id'],
                        'wna_dep_id' => $depid,
                        'wna_wo_noti_id' => $wonid,
                        'wna_read' => 0
                        );
                    if($first == 1)
                    {
                        $insertar['wna_urgent'] = '1';
                    }
                    $this->db->insert('tbl_wo_noti_assign',$insertar);
                }
            }
        }
        if(isset($single_user) && is_array($single_user) && !empty($single_user))
        {
            foreach ($single_user as $adkey => $adusers) {
                $insertar = array(
                    'wna_fromid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
                    'wna_toid' => $adusers,
                    'wna_dep_id' => 0,
                    'wna_wo_noti_id' => $wonid,
                    'wna_read' => 0,
                    'wna_urgent' => '1'
                    );
                $this->db->insert('tbl_wo_noti_assign',$insertar);
            }
        }
        $this->db->select('wo_preparedby');
        $this->db->from('tbl_work_order');
        $this->db->where('wo_id',$work_order_id);
        $query = $this->db->get();
        
        if($query->num_rows() == 1)
        {
            $wodetails = $query->row_array();
            $insertar = array(
                'wna_fromid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
                'wna_toid' => $wodetails['wo_preparedby'],
                'wna_dep_id' => 0,
                'wna_wo_noti_id' => $wonid,
                'wna_read' => 0
                );
            $this->db->insert('tbl_wo_noti_assign',$insertar);
        }
    }
    public function check_wono_view($data)
    {
        //echo '<pre>';print_r($data['woid']);die;
        $this->db->select('*');
        $this->db->from('tbl_work_order_open');
        $this->db->where('woopen_woid',$data['woid']);
        $this->db->where('woopen_userid',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));

        $query = $this->db->get();
        $checkdata = $query->num_rows();
        //echo '<pre>';print_r($checkdata);die;
        if($checkdata == 0)
        {
            $insertar = array(
                'woopen_userid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
                'woopen_woid' => $data['woid']
                );
            $this->db->insert('tbl_work_order_open',$insertar);
        }
        else{
            $this->db->where('woopen_woid',$data['woid']);
            $this->db->where('woopen_userid',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            $this->db->delete('tbl_work_order_open');
        }

        if($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']) == 2)
        {
            $this->db->select('*');
            $this->db->from('tbl_work_order_starview');
            $this->db->where('wos_woid',$data['woid']);
            $this->db->where('wos_type','completed');
            $this->db->where('wos_userid',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));

            $query = $this->db->get();
            $checkdata = $query->num_rows();
            //echo '<pre>';print_r($checkdata);die;
            if($checkdata == 0)
            {
                $insertar = array(
                    'wos_userid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
                    'wos_woid' => $data['woid'],
                    'wos_type' => 'completed'
                    );
                $this->db->insert('tbl_work_order_starview',$insertar);
            }
        }

    }

    public function get_all_production_count()
    {
        $dep_id =  $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']);
        $value = array();
        //echo $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']);die;
        $this->db->select('COUNT(woi_id) as count');
        $this->db->from('tbl_work_order_item');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
        $this->db->where('woi_production_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
        $this->db->where('woi_isdelete',0);
        $this->db->where('woi_admin_approve','1'); 
        $this->db->where('woi_manager_approve','1');
        $this->db->where('woi_promanager_approve','1');
        $this->db->where_in('woi_production_approve',array('0','2'));
        $this->db->where('wo_confirm_or_not',1);
        $this->db->where('wo_iscompleted',0);
        $query = $this->db->get();
        $value['total_production_pending'] = $query->row_array();

        $this->db->select('COUNT(woi_id) as count');
        $this->db->from('tbl_work_order_item');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
        $this->db->where('woi_production_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
        $this->db->where('woi_isdelete',0);
        $this->db->where('woi_admin_approve','1'); 
        $this->db->where('woi_manager_approve','1');
        $this->db->where('woi_promanager_approve','1');
        $this->db->where('woi_production_approve','1');
        $this->db->where('wo_confirm_or_not',1);
        $this->db->where('wo_iscompleted',0);
        $query = $this->db->get();
        $value['total_store_pending'] = $query->row_array();

        $this->db->select('COUNT(woi_id) as count');
        $this->db->from('tbl_work_order_item');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
        $this->db->where('woi_production_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
        $this->db->where('woi_isdelete',0);
        $this->db->where('woi_admin_approve','1'); 
        $this->db->where('woi_manager_approve','1');
        $this->db->where('woi_promanager_approve','1');
        $this->db->where('woi_production_approve','3');
        $this->db->where('wo_confirm_or_not',1);
        //$this->db->where('wo_iscompleted',0);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        $value['total_production_approved'] = $query->row_array();

        $this->db->select('COUNT(woi_id) as count');
        $this->db->from('tbl_work_order_item');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
        $this->db->where('woi_production_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
        $this->db->where('woi_isdelete',0);
        $this->db->where('woi_admin_approve','1'); 
        $this->db->where('woi_manager_approve','1');
        $this->db->where('woi_promanager_approve','1');
        $this->db->where('woi_production_approve','3');
        $this->db->where('wo_confirm_or_not',1);
        $this->db->where('DATE_FORMAT(woi_production_approve_date,"%Y-%m-%d")',date('Y-m-d'));
        //$this->db->where('wo_iscompleted',0);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        $value['today_production_approved'] = $query->row_array();

        $this->db->select('COUNT(woi_id) as count');
        $this->db->from('tbl_work_order_item');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
        $this->db->where('woi_production_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
        $this->db->where('woi_isdelete',0);
        $this->db->where('woi_admin_approve','1'); 
        $this->db->where('woi_manager_approve','1');
        $this->db->where('woi_promanager_approve','1');
        $this->db->where('woi_production_approve','3');
        $this->db->where('wo_confirm_or_not',1);
        $this->db->where('DATE_FORMAT(woi_production_approve_date,"%Y-%m-%d")',date('Y-m-d',strtotime("-1 days")));
        //$this->db->where('wo_iscompleted',0);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        $value['yesterday_production_approved'] = $query->row_array();

        $this->db->select('COUNT(woi_id) as count');
        $this->db->from('tbl_work_order_item');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
        $this->db->where('woi_production_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
        $this->db->where('woi_isdelete',0);
        $this->db->where('woi_admin_approve','1'); 
        $this->db->where('woi_manager_approve','1');
        $this->db->where('woi_promanager_approve','1');
        $this->db->where('woi_production_approve','3');
        $this->db->where('wo_confirm_or_not',1);
        $this->db->where('DATE_FORMAT(woi_production_approve_date,"%Y-%m")',date('Y-m'));
        //$this->db->where('wo_iscompleted',0);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        $value['this_month_production_approved'] = $query->row_array();

        $this->db->select('COUNT(woi_id) as count');
        $this->db->from('tbl_work_order_item');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
        $this->db->where('woi_production_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
        $this->db->where('woi_isdelete',0);
        $this->db->where('woi_admin_approve','1'); 
        $this->db->where('woi_manager_approve','1');
        $this->db->where('woi_promanager_approve','1');
        $this->db->where('woi_production_approve','3');
        $this->db->where('wo_confirm_or_not',1);
        $this->db->where('DATE_FORMAT(woi_production_approve_date,"%Y-%m")',date('Y-m',strtotime("-1 month")));
        //$this->db->where('wo_iscompleted',0);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        $value['last_month_production_approved'] = $query->row_array();

        $this->db->select('COUNT(woi_id) as count');
        $this->db->from('tbl_work_order_item');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
        $this->db->where('woi_production_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
        $this->db->where('woi_isdelete',0);
        $this->db->where('woi_admin_approve','1'); 
        $this->db->where('woi_manager_approve','1');
        $this->db->where('woi_promanager_approve','1');
        $this->db->where('woi_production_approve','3');
        $this->db->where('wo_confirm_or_not',1);
        if(date("m") < 4)
        {
            $last_year = date('Y', strtotime('-1 year'));
            $this_year = date('Y');
            //$year_string = $last_year.''.$this_year.'-'.strtoupper(date('M'));
            $this->db->where('DATE_FORMAT(woi_production_approve_date,"%Y-%m") >=',"".$last_year."-4");
            $this->db->where('DATE_FORMAT(woi_production_approve_date,"%Y-%m") <=',"".$this_year."-3");
        }else{
            $next_year = date('Y', strtotime('+1 year'));
            $this_year = date('Y');
            //$year_string = $this_year.''.$next_year.'-'.strtoupper(date('M'));
            $this->db->where('DATE_FORMAT(woi_production_approve_date,"%Y-%m") <=',"".$next_year."-03");
            $this->db->where('DATE_FORMAT(woi_production_approve_date,"%Y-%m") >=',"".$this_year."-04");
        }
        //$this->db->where('wo_iscompleted',0);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        $value['this_year_production_approved'] = $query->row_array();

        //echo '<pre>';print_r($value);die;
        return $value;
    }

    public function get_all_store_count()
    {
        $dep_id =  $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']);
        $value = array();
        //echo $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']);die;
        $this->db->select('COUNT(woi_id) as count');
        $this->db->from('tbl_work_order_item');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
        $this->db->where('woi_isdelete',0);
        $this->db->where('woi_admin_approve','1'); 
        $this->db->where('woi_manager_approve','1');
        $this->db->where('woi_promanager_approve','1');
        $this->db->where('woi_production_approve ','1');
        $this->db->where('woi_store_approve','0');
        $this->db->where('wo_confirm_or_not',1);
        $this->db->where('wo_iscompleted',0);
        $query = $this->db->get();
        $value['total_store_pending'] = $query->row_array();

        $this->db->select('COUNT(woi_id) as count');
        $this->db->from('tbl_work_order_item');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
        $this->db->where('woi_isdelete',0);
        $this->db->where('woi_admin_approve','1'); 
        $this->db->where('woi_manager_approve','1');
        $this->db->where('woi_promanager_approve','1');
        $this->db->where('woi_store_approve','1');
        $this->db->where('wo_confirm_or_not',1);
        //$this->db->where('wo_iscompleted',0);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        $value['total_store_approved'] = $query->row_array();

        $this->db->select('COUNT(woi_id) as count');
        $this->db->from('tbl_work_order_item');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
        $this->db->where('woi_isdelete',0);
        $this->db->where('woi_admin_approve','1'); 
        $this->db->where('woi_manager_approve','1');
        $this->db->where('woi_promanager_approve','1');
        $this->db->where('woi_store_approve','1');
        $this->db->where('wo_confirm_or_not',1);
        $this->db->where('DATE_FORMAT(woi_store_approve_date,"%Y-%m-%d")',date('Y-m-d'));
        //$this->db->where('wo_iscompleted',0);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        $value['today_store_approved'] = $query->row_array();

        $this->db->select('COUNT(woi_id) as count');
        $this->db->from('tbl_work_order_item');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
        $this->db->where('woi_isdelete',0);
        $this->db->where('woi_admin_approve','1'); 
        $this->db->where('woi_manager_approve','1');
        $this->db->where('woi_promanager_approve','1');
        $this->db->where('woi_store_approve','1');
        $this->db->where('wo_confirm_or_not',1);
        $this->db->where('DATE_FORMAT(woi_store_approve_date,"%Y-%m-%d")',date('Y-m-d',strtotime("-1 days")));
        //$this->db->where('wo_iscompleted',0);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        $value['yesterday_store_approved'] = $query->row_array();

        $this->db->select('COUNT(woi_id) as count');
        $this->db->from('tbl_work_order_item');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
        $this->db->where('woi_isdelete',0);
        $this->db->where('woi_admin_approve','1'); 
        $this->db->where('woi_manager_approve','1');
        $this->db->where('woi_promanager_approve','1');
        $this->db->where('woi_store_approve','1');
        $this->db->where('wo_confirm_or_not',1);
        $this->db->where('DATE_FORMAT(woi_store_approve_date,"%Y-%m")',date('Y-m'));
        //$this->db->where('wo_iscompleted',0);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        $value['this_month_store_approved'] = $query->row_array();

        $this->db->select('COUNT(woi_id) as count');
        $this->db->from('tbl_work_order_item');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
        $this->db->where('woi_isdelete',0);
        $this->db->where('woi_admin_approve','1'); 
        $this->db->where('woi_manager_approve','1');
        $this->db->where('woi_promanager_approve','1');
        $this->db->where('woi_store_approve','1');
        $this->db->where('wo_confirm_or_not',1);
        $this->db->where('DATE_FORMAT(woi_store_approve_date,"%Y-%m")',date('Y-m',strtotime("-1 month")));
        //$this->db->where('wo_iscompleted',0);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        $value['last_month_store_approved'] = $query->row_array();

        $this->db->select('COUNT(woi_id) as count');
        $this->db->from('tbl_work_order_item');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
        $this->db->where('woi_isdelete',0);
        $this->db->where('woi_admin_approve','1'); 
        $this->db->where('woi_manager_approve','1');
        $this->db->where('woi_promanager_approve','1');
        $this->db->where('woi_store_approve','1');
        $this->db->where('wo_confirm_or_not',1);
        if(date("m") < 4)
        {
            $last_year = date('Y', strtotime('-1 year'));
            $this_year = date('Y');
            //$year_string = $last_year.''.$this_year.'-'.strtoupper(date('M'));
            $this->db->where('DATE_FORMAT(woi_store_approve_date,"%Y-%m") >=',"".$last_year."-4");
            $this->db->where('DATE_FORMAT(woi_store_approve_date,"%Y-%m") <=',"".$this_year."-3");
        }else{
            $next_year = date('Y', strtotime('+1 year'));
            $this_year = date('Y');
            //$year_string = $this_year.''.$next_year.'-'.strtoupper(date('M'));
            $this->db->where('DATE_FORMAT(woi_store_approve_date,"%Y-%m") <=',"".$next_year."-03");
            $this->db->where('DATE_FORMAT(woi_store_approve_date,"%Y-%m") >=',"".$this_year."-04");
        }
        //$this->db->where('wo_iscompleted',0);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        $value['this_year_store_approved'] = $query->row_array();

        //echo '<pre>';print_r($value);die;
        return $value;
    }

    public function get_all_work_orders_count()
    {
        $dep_id =  $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']);
        $value = array();
        $this->db->select('COUNT(woi_id) as count');
        $this->db->from('tbl_work_order_item');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != '') && $dep_id != 10 && $dep_id != 11 && $dep_id != 2)
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('wo_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                //$this->db->where_in('wo_cid', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('wo_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        $this->db->where('woi_isdelete',0);
        $this->db->where('woi_manager_approve','1');
        $this->db->where('woi_admin_approve','0');
        $this->db->where('wo_confirm_or_not',1);
        $this->db->where('wo_iscompleted',0);
        $this->db->where('wo_isdeleted',0);
        $query = $this->db->get();
        $value['pending_woitm'] = $query->row_array();

        $this->db->select('COUNT(woi_id) as count');
        $this->db->from('tbl_work_order_item');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != '') && $dep_id != 10 && $dep_id != 11 && $dep_id != 2)
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('wo_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                //$this->db->where_in('wo_cid', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('wo_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        $this->db->where('woi_isdelete',0);
        $this->db->where('woi_manager_approve','1');
        $this->db->where('woi_admin_approve','1'); 
        $this->db->where('wo_confirm_or_not',1);
        $this->db->where('wo_isdeleted',0);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        $value['total_approve_woitm'] = $query->row_array();

        $this->db->select('COUNT(woi_id) as count');
        $this->db->from('tbl_work_order_item'); 
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != '') && $dep_id != 10 && $dep_id != 11 && $dep_id != 2)
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('wo_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                //$this->db->where_in('wo_cid', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('wo_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        $this->db->where('woi_isdelete',0);
        $this->db->where('wo_confirm_or_not',1);
        $this->db->where('woi_manager_approve','0');
        $this->db->where('wo_confirm_or_not',1);
        $this->db->where('wo_isdeleted',0);
        $query = $this->db->get();
        $value['total_sm_pending'] = $query->row_array();

        $this->db->select('COUNT(woi_id) as count');
        $this->db->from('tbl_work_order_item');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != '') && $dep_id != 10 && $dep_id != 11 && $dep_id != 2)
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('wo_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                //$this->db->where_in('wo_cid', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('wo_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        $this->db->where('wo_confirm_or_not',1);
        $this->db->where('woi_isdelete',0);
        $this->db->where('woi_manager_approve','1');
        $this->db->where('wo_confirm_or_not',1);
        $this->db->where('wo_isdeleted',0);
        $query = $this->db->get();
        $value['total_sm_approve'] = $query->row_array();

        $this->db->select('COUNT(woi_id) as count');
        $this->db->from('tbl_work_order_item');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != '') && $dep_id != 10 && $dep_id != 11 && $dep_id != 2)
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('wo_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                //$this->db->where_in('wo_cid', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('wo_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        $this->db->where('woi_isdelete',0);
        $this->db->where('woi_admin_approve','1'); 
        $this->db->where('woi_manager_approve','1');
        $this->db->where('woi_promanager_approve','0');
        $this->db->where('wo_confirm_or_not',1);
        $this->db->where('wo_isdeleted',0);
        $query = $this->db->get();
        $value['total_pm_pending'] = $query->row_array();

        $this->db->select('COUNT(woi_id) as count');
        $this->db->from('tbl_work_order_item');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
       if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != '') && $dep_id != 10 && $dep_id != 11 && $dep_id != 2)
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('wo_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                //$this->db->where_in('wo_cid', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('wo_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        $this->db->where('woi_isdelete',0);
        $this->db->where('woi_admin_approve','1'); 
        $this->db->where('woi_manager_approve','1');
        $this->db->where('woi_promanager_approve','1');
        $this->db->where('wo_confirm_or_not',1);
        $this->db->where('wo_isdeleted',0);
        $query = $this->db->get();
        $value['total_pm_approve'] = $query->row_array();

        $this->db->select('COUNT(woi_id) as count');
        $this->db->from('tbl_work_order_item');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != '') && $dep_id != 10 && $dep_id != 11 && $dep_id != 2)
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('wo_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                //$this->db->where_in('wo_cid', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('wo_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        $this->db->where('woi_isdelete',0);
        $this->db->where('woi_admin_approve','1'); 
        $this->db->where('woi_manager_approve','1');
        $this->db->where('woi_promanager_approve','1');
        $this->db->where('woi_production_approve','0');
        $this->db->where('wo_confirm_or_not',1);
        $this->db->where('wo_iscompleted',0);
        $query = $this->db->get();
        $value['total_production_pending'] = $query->row_array();

        $this->db->select('COUNT(woi_id) as count');
        $this->db->from('tbl_work_order_item');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != '') && $dep_id != 10 && $dep_id != 11 && $dep_id != 2)
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('wo_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                //$this->db->where_in('wo_cid', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('wo_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        $this->db->where('woi_isdelete',0);
        $this->db->where('woi_admin_approve','1'); 
        $this->db->where('woi_manager_approve','1');
        $this->db->where('woi_promanager_approve','1');
        $this->db->where('woi_production_approve','1');
        $this->db->where('wo_confirm_or_not',1);
        $this->db->where('wo_iscompleted',0);
        $query = $this->db->get();
        $value['total_production_approve'] = $query->row_array();

        $this->db->select('COUNT(woi_id) as count');
        $this->db->from('tbl_work_order_item');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != '') && $dep_id != 10 && $dep_id != 11 && $dep_id != 2)
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('wo_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                //$this->db->where_in('wo_cid', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('wo_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        $this->db->where('woi_isdelete',0);
        $this->db->where('woi_admin_approve','1'); 
        $this->db->where('woi_manager_approve','1');
        $this->db->where('woi_promanager_approve','1');
        $this->db->where('woi_production_approve','1');
        $this->db->where('wo_confirm_or_not',1);
        $this->db->where('wo_iscompleted',0);
        $query = $this->db->get();
        $value['total_pro_sec_pending'] = $query->row_array();

        $this->db->select('COUNT(woi_id) as count');
        $this->db->from('tbl_work_order_item');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != '') && $dep_id != 10 && $dep_id != 11 && $dep_id != 2)
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('wo_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                //$this->db->where_in('wo_cid', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('wo_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        $this->db->where('woi_isdelete',0);
        $this->db->where('woi_admin_approve','1'); 
        $this->db->where('woi_manager_approve','1');
        $this->db->where('woi_promanager_approve','1');
        $this->db->where('woi_production_approve','2');
        $this->db->where('wo_confirm_or_not',1);
        $this->db->where('wo_iscompleted',0);
        $query = $this->db->get();
        $value['total_pro_sec_approve'] = $query->row_array();

        $this->db->select('COUNT(woi_id) as count');
        $this->db->from('tbl_work_order_item');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
       if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != '') && $dep_id != 10 && $dep_id != 11 && $dep_id != 2)
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('wo_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                //$this->db->where_in('wo_cid', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('wo_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        $this->db->where('woi_isdelete',0);
        $this->db->where('woi_admin_approve','1'); 
        $this->db->where('woi_manager_approve','1');
        $this->db->where('woi_promanager_approve','1');
        $this->db->where('woi_production_approve','0');
         $this->db->where('woi_store_approve','0');
         $this->db->where('wo_confirm_or_not',1);
         $this->db->where('wo_iscompleted',0);
        $query = $this->db->get();
        $value['total_store_pending'] = $query->row_array();

        $this->db->select('COUNT(woi_id) as count');
        $this->db->from('tbl_work_order_item');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != '') && $dep_id != 10 && $dep_id != 11 && $dep_id != 2)
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('wo_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                //$this->db->where_in('wo_cid', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('wo_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        $this->db->where('woi_isdelete',0);
        $this->db->where('woi_admin_approve','1'); 
        $this->db->where('woi_manager_approve','1');
        $this->db->where('woi_promanager_approve','1');
        $this->db->where('woi_production_approve','1');
         $this->db->where('woi_store_approve','1');
         $this->db->where('wo_confirm_or_not',1);
         $this->db->where('wo_iscompleted',0);
        $query = $this->db->get();
        $value['total_store_approve'] = $query->row_array();

        $this->db->select('COUNT(otw_id) as count');
        $this->db->from('tbl_outward');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_outward.otw_work_ord_id');
       if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != '') && $dep_id != 10 && $dep_id != 11 && $dep_id != 2)
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('otw_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                //$this->db->where_in('wo_cid', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('otw_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
       $this->db->where('otw_isdelete',0);
        $this->db->where('otw_completed','1');
        $this->db->where('wo_isdeleted',0);
        $this->db->where('wo_iscompleted',0);
        $query = $this->db->get();
        $value['total_account_pending'] = $query->row_array();

        $this->db->select('COUNT(otw_id) as count');
        $this->db->from('tbl_outward');
       // $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
       if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != '') && $dep_id != 10 && $dep_id != 11 && $dep_id != 2)
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('otw_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                //$this->db->where_in('wo_cid', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('otw_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        $this->db->where('otw_completed','2');
        $this->db->where('otw_isdelete',0);
        $query = $this->db->get();
        $value['total_account_approve'] = $query->row_array();

        $this->db->select('(IFNULL(tcreditpoints,0) - IFNULL(tdebitpoints,0)) as final_points');
        $this->db->from('(select ROUND(SUM(tcredit.tran_itm_qty),2) as tcreditpoints FROM tbl_transaction as tcredit WHERE tcredit.tran_cr_or_dr = 1 AND tcredit.tran_is_hold = '."'0'".' ) as tcreditpoints,(select ROUND(SUM(tdebit.tran_itm_qty),2) as tdebitpoints FROM tbl_transaction as tdebit WHERE tdebit.tran_cr_or_dr = 2 AND tdebit.tran_is_hold = '."'0'".' ) as tdebitpoints',FALSE);
        $query = $this->db->get();
        $value['total_stock'] = $query->row_array();

        $this->db->select('SUM(otw_invftotal) as count');
        $this->db->from('tbl_outward');
        //$this->db->join('tbl_outward_item','tbl_outward_item.otwi_owt_id = tbl_outward.otw_id');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_outward.otw_work_ord_id');
       /* if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != '') && $dep_id != 10 && $dep_id != 11 && $dep_id != 2)
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('otw_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                //$this->db->where_in('wo_cid', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('otw_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        } */
        if($this->input->get('au_fname') && ($this->input->get('au_fname') != '')){
            $this->db->where('wo_preparedby', $this->input->get('au_fname'));
        }
        $this->db->where('otw_completed','2');
        $this->db->where('wo_type',2);
        $this->db->where('otw_invdate',date("Y-m-d"));
        $query = $this->db->get();
        $value['total_today_sales'] = $query->row_array();

        $this->db->select('SUM(otw_invftotal) as count');
        $this->db->from('tbl_outward');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_outward.otw_work_ord_id');
        //$this->db->join('tbl_outward_item','tbl_outward_item.otwi_owt_id = tbl_outward.otw_id');
       // $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
       if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != '') && $dep_id != 10 && $dep_id != 11 && $dep_id != 2)
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('otw_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                //$this->db->where_in('wo_cid', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('otw_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if($this->input->get('au_fname') && ($this->input->get('au_fname') != '')){
            $this->db->where('wo_preparedby', $this->input->get('au_fname'));
        }
        $this->db->where('otw_completed','2');
        $this->db->where('wo_type',2);
        $this->db->where('otw_invdate',date('Y-m-d',strtotime("-1 days")));
        $query = $this->db->get();
        $value['total_yesterday_sales'] = $query->row_array();

        $this->db->select('SUM(otw_invftotal) as count');
        $this->db->from('tbl_outward');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_outward.otw_work_ord_id');
        //$this->db->join('tbl_outward_item','tbl_outward_item.otwi_owt_id = tbl_outward.otw_id');
       // $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
       if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != '') && $dep_id != 10 && $dep_id != 11 && $dep_id != 2)
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('otw_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                //$this->db->where_in('wo_cid', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('otw_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if($this->input->get('au_fname') && ($this->input->get('au_fname') != '')){
            $this->db->where('wo_preparedby', $this->input->get('au_fname'));
        }
        $this->db->where('otw_completed','2');
        $this->db->where('wo_type',2);
        $this->db->where('DATE_FORMAT(otw_invdate,"%Y-%m")',date('Y-m'));
        $query = $this->db->get();
        $value['total_month_sales'] = $query->row_array();

        $this->db->select('SUM(otw_invftotal) as count');
        $this->db->from('tbl_outward');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_outward.otw_work_ord_id');
        //$this->db->join('tbl_outward_item','tbl_outward_item.otwi_owt_id = tbl_outward.otw_id');
       // $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
       if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != '') && $dep_id != 10 && $dep_id != 11 && $dep_id != 2)
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('otw_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                //$this->db->where_in('wo_cid', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('otw_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if($this->input->get('au_fname') && ($this->input->get('au_fname') != '')){
            $this->db->where('wo_preparedby', $this->input->get('au_fname'));
        }
        $this->db->where('otw_completed','2');
        $this->db->where('wo_type',2);
        $this->db->where('DATE_FORMAT(otw_invdate,"%Y-%m")',date('Y-m',strtotime("-1 month")));
        $query = $this->db->get();
        $value['total_lastmonth_sales'] = $query->row_array();

        $this->db->select('SUM(otw_invftotal) as count');
        $this->db->from('tbl_outward');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_outward.otw_work_ord_id');
        //$this->db->join('tbl_outward_item','tbl_outward_item.otwi_owt_id = tbl_outward.otw_id');
       // $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
       if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != '') && $dep_id != 10 && $dep_id != 11 && $dep_id != 2)
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('otw_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                //$this->db->where_in('wo_cid', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('otw_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if($this->input->get('au_fname') && ($this->input->get('au_fname') != '')){
            $this->db->where('wo_preparedby', $this->input->get('au_fname'));
        }
        if(date("m") < 4)
        {
            $last_year = date('Y', strtotime('-1 year'));
            $this_year = date('Y');
            //$year_string = $last_year.''.$this_year.'-'.strtoupper(date('M'));
            $this->db->where('DATE_FORMAT(otw_invdate,"%Y-%m") >=',"".$last_year."-4");
            $this->db->where('DATE_FORMAT(otw_invdate,"%Y-%m") <=',"".$this_year."-3");
        }else{
            $next_year = date('Y', strtotime('+1 year'));
            $this_year = date('Y');
            //$year_string = $this_year.''.$next_year.'-'.strtoupper(date('M'));
            $this->db->where('DATE_FORMAT(otw_invdate,"%Y-%m") <=',"".$next_year."-03");
            $this->db->where('DATE_FORMAT(otw_invdate,"%Y-%m") >=',"".$this_year."-04");
        }
        $this->db->where('otw_completed','2');
        $this->db->where('wo_type',2);
        $query = $this->db->get();
        $value['total_year_sales'] = $query->row_array();

        $this->db->select('SUM(otw_invftotal) as count');
        $this->db->from('tbl_outward');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_outward.otw_work_ord_id');
        //$this->db->join('tbl_outward_item','tbl_outward_item.otwi_owt_id = tbl_outward.otw_id');
       // $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
       if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != '') && $dep_id != 10 && $dep_id != 11 && $dep_id != 2)
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('otw_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                //$this->db->where_in('wo_cid', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('otw_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if($this->input->get('au_fname') && ($this->input->get('au_fname') != '')){
            $this->db->where('wo_preparedby', $this->input->get('au_fname'));
        }
        if(date("m") < 4)
        {
            $last_year = date('Y', strtotime('-1 year'));
            $this_year = date('Y');
            //$year_string = $last_year.''.$this_year.'-'.strtoupper(date('M'));
            $this->db->where('DATE_FORMAT(otw_invdate,"%Y-%m") >=',"".$last_year."-4");
            $this->db->where('DATE_FORMAT(otw_invdate,"%Y-%m") <=',"".$this_year."-3");
        }else{
            $next_year = date('Y', strtotime('+1 year'));
            $this_year = date('Y');
            //$year_string = $this_year.''.$next_year.'-'.strtoupper(date('M'));
            $this->db->where('DATE_FORMAT(otw_invdate,"%Y-%m") <=',"".$next_year."-03");
            $this->db->where('DATE_FORMAT(otw_invdate,"%Y-%m") >=',"".$this_year."-04");
        }
        $this->db->where('otw_completed','2');
        $this->db->where('wo_type',1);
        $query = $this->db->get();
        $value['total_year_sales_challan'] = $query->row_array();

        return $value;

    }

    public function get_all_account_count()
    {
        $dep_id =  $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']);
        $this->db->select('COUNT(otw_id) as count');
        $this->db->from('tbl_outward');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_outward.otw_work_ord_id');
       if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != '') && $dep_id != 10 && $dep_id != 11 && $dep_id != 2)
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('otw_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                //$this->db->where_in('wo_cid', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('otw_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        $this->db->where('otw_completed','2');
        $this->db->where('otw_isdelete',0);
        $this->db->where('wo_isdeleted',0);
        $this->db->where('DATE_FORMAT(otw_account_confirm_date,"%Y-%m-%d")',date("Y-m-d"));
        $query = $this->db->get();
        $value['today_account_approve'] = $query->row_array();

        $this->db->select('COUNT(otw_id) as count');
        $this->db->from('tbl_outward');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_outward.otw_work_ord_id');
       if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != '') && $dep_id != 10 && $dep_id != 11 && $dep_id != 2)
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('otw_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                //$this->db->where_in('wo_cid', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('otw_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        $this->db->where('otw_completed','2');
        $this->db->where('otw_isdelete',0);
        $this->db->where('wo_isdeleted',0);
        $this->db->where('DATE_FORMAT(otw_account_confirm_date,"%Y-%m-%d")',date('Y-m-d',strtotime("-1 days")));
        $query = $this->db->get();
        $value['yesterday_account_approve'] = $query->row_array();

        $this->db->select('COUNT(otw_id) as count');
        $this->db->from('tbl_outward');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_outward.otw_work_ord_id');
       if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != '') && $dep_id != 10 && $dep_id != 11 && $dep_id != 2)
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('otw_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                //$this->db->where_in('wo_cid', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('otw_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        $this->db->where('otw_completed','2');
        $this->db->where('otw_isdelete',0);
        $this->db->where('wo_isdeleted',0);
        $this->db->where('DATE_FORMAT(otw_invdate,"%Y-%m")',date('Y-m'));
        $query = $this->db->get();
        $value['this_month_account_approve'] = $query->row_array();

        $this->db->select('COUNT(otw_id) as count');
        $this->db->from('tbl_outward');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_outward.otw_work_ord_id');
       if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != '') && $dep_id != 10 && $dep_id != 11 && $dep_id != 2)
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('otw_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                //$this->db->where_in('wo_cid', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('otw_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        $this->db->where('otw_completed','2');
        $this->db->where('otw_isdelete',0);
        $this->db->where('wo_isdeleted',0);
        $this->db->where('DATE_FORMAT(otw_invdate,"%Y-%m")',date('Y-m',strtotime("-1 month")));
        $query = $this->db->get();
        $value['last_month_account_approve'] = $query->row_array();

        $this->db->select('COUNT(otw_id) as count');
        $this->db->from('tbl_outward');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_outward.otw_work_ord_id');
       if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != '') && $dep_id != 10 && $dep_id != 11 && $dep_id != 2)
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('otw_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                //$this->db->where_in('wo_cid', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('otw_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        $this->db->where('otw_completed','2');
        $this->db->where('otw_isdelete',0);
        $this->db->where('wo_isdeleted',0);
        //$this->db->where('DATE_FORMAT(otw_account_confirm_date,"%Y-%m")',date('Y-m',strtotime("-1 month")));
        if(date("m") < 4)
        {
            $last_year = date('Y', strtotime('-1 year'));
            $this_year = date('Y');
            //$year_string = $last_year.''.$this_year.'-'.strtoupper(date('M'));
            $this->db->where('DATE_FORMAT(otw_invdate,"%Y-%m") >=',"".$last_year."-4");
            $this->db->where('DATE_FORMAT(otw_invdate,"%Y-%m") <=',"".$this_year."-3");
        }else{
            $next_year = date('Y', strtotime('+1 year'));
            $this_year = date('Y');
            //$year_string = $this_year.''.$next_year.'-'.strtoupper(date('M'));
            $this->db->where('DATE_FORMAT(otw_invdate,"%Y-%m") <=',"".$next_year."-03");
            $this->db->where('DATE_FORMAT(otw_invdate,"%Y-%m") >=',"".$this_year."-04");
        }
        $query = $this->db->get();
        $value['year_account_approve'] = $query->row_array();
        return $value;
    }

    public function get_otwdata($data)
    {
        //echo '<pre>';print_r($data);die;
        $this->db->select('otwi_owt_id,otwi_id');
        $this->db->from('tbl_outward_item');
        $this->db->where('otwi_woitemid',$data['wo_itemid']);
        $query = $this->db->get();
        return $query->row_array();

    }

    public function change_desciption($data,$postdata)
    {
        $update = array(
            'woi_itm_desc' => $postdata['item_desc'],
            'woi_itm_remark' => $postdata['remark'],
            'woi_comment' => $postdata['comment']
            );
        $this->db->where('woi_id',$data['wo_itemid']);
        $this->db->where('woi_wo_id',$data['wo_id']);
        $this->db->update('tbl_work_order_item',$update);
        $notimsg = '';

        $this->db->select('*');
        $this->db->from('tbl_work_order');
        $this->db->join('tbl_work_order_item','tbl_work_order_item.woi_wo_id = tbl_work_order.wo_id');
        $this->db->where('tbl_work_order_item.woi_id',$data['wo_itemid']);
        $this->db->where('tbl_work_order.wo_id',$data['wo_id']);
        $query = $this->db->get();
        if($query->num_rows() == 1)
        {
            $workorder_data = $query->row_array();
            $notimsg = $workorder_data['wo_wo_no'].' - '.$workorder_data['woi_part_no'].''." Details Change By ".$this->session->userdata['miconlogin']['fname'].'';
        }else{
            $notimsg = "Details Change";
        }

        $noti = array(
                    'wo_noti_woid' => $data['wo_id'],
                    'wo_noti_wo_itmid' => $data['wo_itemid'],
                    'wo_noti_msg' => $notimsg,
                    'wo_noti_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
                    'wo_noti_date' => date('Y-m-d H:i:s')
                );
            $this->db->insert('tbl_work_order_notification',$noti);
            $wonid = $this->db->insert_id();
            $assigndep = array('super_admin','sales_manager','production_manager');
            $this->assign_notification_rights($wonid,$assigndep,$single_user = false,$data['wo_id']);

    }
    public function wo_report()
    {
        $this->db->select('tbl_outward.*,tbl_work_order.*,prepared_by.au_fname as prepared_by_fname,prepared_by.au_lname as prepared_by_lname');
        $this->db->from('tbl_outward');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_outward.otw_work_ord_id','left');
        $this->db->join('tbl_admin_users prepared_by','prepared_by.au_id = tbl_work_order.wo_preparedby','left');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                //$this->db->where_in('tbl_work_order.wo_cid', $this->session->userdata['miconlogin']['all_users']);
                //$this->db->where('tbl_Work_order_item_list.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }else{
                //$this->db->where('tbl_work_order.wo_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }

       if($this->input->get('au_fname') && ($this->input->get('au_fname') != ''))
        {
           $this->db->where('au_id', $this->input->get('au_fname'));   
        }

        if($this->input->get('inq_start_date') && ($this->input->get('inq_start_date') != ''))
        {
            $stdate = date("Y-m-d", strtotime($this->input->get('inq_start_date')));
            $this->db->where('wo_wo_date >=',$stdate);
        }
        if($this->input->get('inq_end_date') && ($this->input->get('inq_end_date') != ''))
        {
            $stdate = date("Y-m-d", strtotime($this->input->get('inq_end_date')));
            $this->db->where('wo_wo_date <=',$stdate);
        }

        if($this->input->post('inv_start_date') && ($this->input->post('inv_start_date') != ''))
        {
            $stdate = date("Y-m-d", strtotime($this->input->post('inv_start_date')));
            $this->db->where('otw_invdate >=',$stdate);
        }
        if($this->input->post('inv_end_date') && ($this->input->post('inv_end_date') != ''))
        {
            $stdate = date("Y-m-d", strtotime($this->input->post('inv_end_date')));
            $this->db->where('otw_invdate <=',$stdate);
        }

        if($this->input->post('wo_wo_no') && ($this->input->post('wo_wo_no') != ''))
        {
           $this->db->like('wo_wo_no', $this->input->post('wo_wo_no'));   
        }
         if($this->input->post('wo_wo_date') && ($this->input->post('wo_wo_date') != ''))
        {
           $this->db->like('wo_wo_date', $this->input->post('wo_wo_date'));   
        }
        if($this->input->post('wo_customer_name') && ($this->input->post('wo_customer_name') != ''))
        {
           $this->db->like('wo_customer_name', $this->input->post('wo_customer_name'));   
        }
        if($this->input->post('wo_preparedby') && ($this->input->post('wo_preparedby') != ''))
        {
           $this->db->like('prepared_by.au_fname', $this->input->post('wo_preparedby'));   
        }
        if($this->input->post('otw_invno') && ($this->input->post('otw_invno') != ''))
        {
           $this->db->like('otw_invno', $this->input->post('otw_invno'));   
        }
        if($this->input->post('otw_challan_no') && ($this->input->post('otw_challan_no') != ''))
        {
           $this->db->like('otw_challan_no', $this->input->post('otw_challan_no'));   
        }
        if($this->input->post('otw_invftotal') && ($this->input->post('otw_invftotal') != ''))
        {
           $this->db->like('otw_invftotal', $this->input->post('otw_invftotal'));   
        }
        if($this->input->post('wo_remark') && ($this->input->post('wo_remark') != ''))
        {
           $this->db->like('wo_remark', $this->input->post('wo_remark'));   
        }
        /* if($this->input->post('wo_udate') && ($this->input->post('wo_udate') != ''))
        {
           $this->db->like('wo_udate', $this->input->post('wo_udate'));   
        } */
        if($this->input->post('wo_start_date') && ($this->input->post('wo_start_date') != ''))
        {
            $stdate = date("Y-m-d", strtotime($this->input->post('wo_start_date')));
            $this->db->where('wo_wo_date >=',$stdate);
        }
        if($this->input->post('wo_end_date') && ($this->input->post('wo_end_date') != ''))
        {
            $stdate = date("Y-m-d", strtotime($this->input->post('wo_end_date')));
            $this->db->where('wo_wo_date <=',$stdate);
        }

        
        $this->db->where('wo_isdeleted', 0);
        $this->db->where('otw_completed','2');
        $dep_id =  $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']);
        if($dep_id == 2){
            $this->db->order_by('tbl_outward.otw_account_confirm_date','DESC');
        }else{
            $this->db->order_by('tbl_outward.otw_id','DESC');
        }
        $query = $this->db->get();
        //echo $this->db->last_query(); die;
    //echo "<pre>";print_r($query->result_array());die;
        

        return $query->result_array();
    }

    public function get_customer()
    {
        $this->db->select('*');
        $this->db->from('tbl_master_party');
        //$this->db->join('tbl_admin_users','tbl_admin_users.au_id = tbl_work_order.wo_preparedby');
        $this->db->where('master_party_isdelete', '0');
        $this->db->order_by('master_party_name','ASC');
        $query = $this->db->get();
        //echo'<pre>';print_r($query->result_array());die;
        return $query->result_array();
    }
    public function get_product()
    {
        $this->db->select('*');
        $this->db->from('tbl_master_item');
        //$this->db->join('tbl_admin_users','tbl_admin_users.au_id = tbl_work_order.wo_preparedby');
        //$this->db->where('master_party_isdelete', '0');
        $query = $this->db->get();
        //echo'<pre>';print_r($query->result_array());die;
        return $query->result_array();
    }
  /*  public function get_Executive()
    {
        $this->db->select('*');
        $this->db->from('tbl_admin_users');
        //$this->db->join('tbl_admin_users','tbl_admin_users.au_id = tbl_work_order.wo_preparedby');
        //$this->db->where('wo_isdeleted', '0');
        $query = $this->db->get();
        //echo'<pre>';print_r($query->result_array());die;
        return $query->result_array();
    }
*/
    public function get_vendor()
    {
        $this->db->select('DISTINCT(master_item_make),tbl_master_party.*');
        $this->db->from('tbl_master_item');
        $this->db->join('tbl_master_party','tbl_master_party.master_party_id = tbl_master_item.master_item_make');
        //$this->db->where('wo_isdeleted', '0');
        $query = $this->db->get();
        //echo'<pre>';print_r($query->result_array());die;
        return $query->result_array();
    }

    public function test_completed()
    {
        die;
        $this->db->select('*');
        $this->db->from('tbl_work_order');
        $this->db->where('wo_confirm_or_not',1);
        $this->db->where('wo_iscompleted',0);
        $query = $this->db->get();
        foreach ($query->result_array() as $key => $value) {
            $this->db->select('*');
            $this->db->from('tbl_work_order_item');
            $this->db->where('woi_wo_id',$value['wo_id']);
            $this->db->where('woi_account_approve','1');
            $query = $this->db->get();
            if($query->num_rows() > 0)
            {
                $this->db->select('*');
                $this->db->from('tbl_work_order_item');
                $this->db->where('woi_wo_id',$value['wo_id']);
                $this->db->where('woi_account_approve','0');
                $query = $this->db->get();
                if($query->num_rows() == 0)
                {
                $this->db->set('wo_iscompleted',1);
                $this->db->where('wo_id',$value['wo_id']);
                $this->db->update('tbl_work_order');
                //echo $value['wo_id'].'</br>';
                }
            }
        }
    }

    public function dashboard_stats()
    {
        $value = array();

        // ************************************************************


        // **************************************************************

        $this->db->select('SUM(otw_invftotal) as count');
        $this->db->from('tbl_outward');
        //$this->db->join('tbl_outward_item','tbl_outward_item.otwi_owt_id = tbl_outward.otw_id');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_outward.otw_work_ord_id');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('wo_preparedby', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                //$this->db->where_in('wo_cid', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('wo_preparedby', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        } 
        if($this->input->get('au_fname') && ($this->input->get('au_fname') != '')){
            $this->db->where('wo_preparedby', $this->input->get('au_fname'));
        }
        $this->db->where('otw_completed','2');
        $this->db->where('otw_invdate',date("Y-m-d"));
        $query = $this->db->get();
        $value['total_today_sales'] = $query->row_array();

        $this->db->select('SUM(otw_invftotal) as count');
        $this->db->from('tbl_outward');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_outward.otw_work_ord_id');
        //$this->db->join('tbl_outward_item','tbl_outward_item.otwi_owt_id = tbl_outward.otw_id');
       // $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
       if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('wo_preparedby', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                //$this->db->where_in('wo_cid', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('wo_preparedby', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        } 
        if($this->input->get('au_fname') && ($this->input->get('au_fname') != '')){
            $this->db->where('wo_preparedby', $this->input->get('au_fname'));
        }
        if($this->input->get('wo_type') && ($this->input->get('wo_type') != ''))
        {
            $this->db->where('wo_type', $this->input->get('wo_type'));
        }
        $this->db->where('otw_completed','2');
        $this->db->where('otw_invdate',date('Y-m-d',strtotime("-1 days")));
        $query = $this->db->get();
        $value['total_yesterday_sales'] = $query->row_array();

        $this->db->select('SUM(otw_invftotal) as count');
        $this->db->from('tbl_outward');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_outward.otw_work_ord_id');
        //$this->db->join('tbl_outward_item','tbl_outward_item.otwi_owt_id = tbl_outward.otw_id');
       // $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
       if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('wo_preparedby', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                //$this->db->where_in('wo_cid', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('wo_preparedby', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        } 
        if($this->input->get('au_fname') && ($this->input->get('au_fname') != '')){
            $this->db->where('wo_preparedby', $this->input->get('au_fname'));
        }
        if($this->input->get('wo_type') && ($this->input->get('wo_type') != ''))
        {
            $this->db->where('wo_type', $this->input->get('wo_type'));
        }
        $this->db->where('otw_completed','2');
        $this->db->where('DATE_FORMAT(otw_invdate,"%Y-%m")',date('Y-m'));
        $query = $this->db->get();
        $value['total_month_sales'] = $query->row_array();

        $this->db->select('SUM(otw_invftotal) as count');
        $this->db->from('tbl_outward');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_outward.otw_work_ord_id');
        //$this->db->join('tbl_outward_item','tbl_outward_item.otwi_owt_id = tbl_outward.otw_id');
       // $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
       if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('wo_preparedby', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                //$this->db->where_in('wo_cid', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('wo_preparedby', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        } 
        if($this->input->get('au_fname') && ($this->input->get('au_fname') != '')){
            $this->db->where('wo_preparedby', $this->input->get('au_fname'));
        }
        if($this->input->get('wo_type') && ($this->input->get('wo_type') != ''))
        {
            $this->db->where('wo_type', $this->input->get('wo_type'));
        }
        $this->db->where('otw_completed','2');
        $this->db->where('DATE_FORMAT(otw_invdate,"%Y-%m")',date('Y-m',strtotime("-1 month")));
        $query = $this->db->get();
        $value['total_lastmonth_sales'] = $query->row_array();

        $this->db->select('SUM(otw_invftotal) as count');
        $this->db->from('tbl_outward');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_outward.otw_work_ord_id');
        //$this->db->join('tbl_outward_item','tbl_outward_item.otwi_owt_id = tbl_outward.otw_id');
       // $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_work_order_item.woi_wo_id');
       if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('wo_preparedby', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                //$this->db->where_in('wo_cid', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('wo_preparedby', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        } 
        if($this->input->get('au_fname') && ($this->input->get('au_fname') != '')){
            $this->db->where('wo_preparedby', $this->input->get('au_fname'));
        }
        if(date("m") < 4)
        {
            $last_year = date('Y', strtotime('-1 year'));
            $this_year = date('Y');
            //$year_string = $last_year.''.$this_year.'-'.strtoupper(date('M'));
            $this->db->where('DATE_FORMAT(otw_invdate,"%Y-%m") >=',"".$last_year."-4");
            $this->db->where('DATE_FORMAT(otw_invdate,"%Y-%m") <=',"".$this_year."-3");
        }else{
            $next_year = date('Y', strtotime('+1 year'));
            $this_year = date('Y');
            //$year_string = $this_year.''.$next_year.'-'.strtoupper(date('M'));
            $this->db->where('DATE_FORMAT(otw_invdate,"%Y-%m") <=',"".$next_year."-03");
            $this->db->where('DATE_FORMAT(otw_invdate,"%Y-%m") >=',"".$this_year."-04");
        }
        if($this->input->get('wo_type') && ($this->input->get('wo_type') != ''))
        {
            $this->db->where('wo_type', $this->input->get('wo_type'));
        }
        $this->db->where('otw_completed','2');
        $query = $this->db->get();
        $value['total_year_sales'] = $query->row_array();


        // ************************************************************

        $this->db->select('wo_preparedby as preparedby,tbl_admin_users.au_fname as preparedby_fname,tbl_admin_users.au_lname as preparedby_lname,SUM(otw_invftotal) as count');
        $this->db->from('tbl_outward');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_outward.otw_work_ord_id');
        $this->db->join('tbl_admin_users','tbl_admin_users.au_id = tbl_work_order.wo_preparedby','left');
        //$this->db->join('tbl_inquiry_status', 'tbl_inquiry_status.inquiry_status_id = tbl_inquiry.inq_inqstatus');
        //$this->db->where('sq_isdeleted', 0);
        $this->db->where('wo_preparedby !=', 0);
        $this->db->group_by('wo_preparedby');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                //$this->db->where_in('wo_preparedby', $this->session->userdata['miconlogin']['all_users']);
                $this->db->where('wo_preparedby', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                //$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }else{
                $this->db->where('wo_preparedby', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if($this->input->get('wo_type') && ($this->input->get('wo_type') != ''))
        {
            $this->db->where('wo_type', $this->input->get('wo_type'));
        }
        $this->db->where('otw_invdate',date("Y-m-d"));
        $query = $this->db->get();
        $value['today_sale_lists'] = $query->result_array();

        $this->db->select('wo_preparedby as preparedby,tbl_admin_users.au_fname as preparedby_fname,tbl_admin_users.au_lname as preparedby_lname,SUM(otw_invftotal) as count');
        $this->db->from('tbl_outward');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_outward.otw_work_ord_id');
        $this->db->join('tbl_admin_users','tbl_admin_users.au_id = tbl_work_order.wo_preparedby','left');
        //$this->db->join('tbl_inquiry_status', 'tbl_inquiry_status.inquiry_status_id = tbl_inquiry.inq_inqstatus');
        //$this->db->where('sq_isdeleted', 0);
        $this->db->where('wo_preparedby !=', 0);
        $this->db->group_by('wo_preparedby');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                //$this->db->where_in('wo_preparedby', $this->session->userdata['miconlogin']['all_users']);
                $this->db->where('wo_preparedby', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                //$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }else{
                $this->db->where('wo_preparedby', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if($this->input->get('wo_type') && ($this->input->get('wo_type') != ''))
        {
            $this->db->where('wo_type', $this->input->get('wo_type'));
        }
        $this->db->where('otw_invdate',date('Y-m-d',strtotime("-1 days")));
        $this->db->order_by('SUM(otw_invftotal)','DESC');
        $query = $this->db->get();
        $value['yesterday_sale_lists'] = $query->result_array();

        $this->db->select('wo_preparedby as preparedby,tbl_admin_users.au_fname as preparedby_fname,tbl_admin_users.au_lname as preparedby_lname,SUM(otw_invftotal) as count');
        $this->db->from('tbl_outward');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_outward.otw_work_ord_id');
        $this->db->join('tbl_admin_users','tbl_admin_users.au_id = tbl_work_order.wo_preparedby','left');
        //$this->db->join('tbl_inquiry_status', 'tbl_inquiry_status.inquiry_status_id = tbl_inquiry.inq_inqstatus');
        //$this->db->where('sq_isdeleted', 0);
        $this->db->where('wo_preparedby !=', 0);
        $this->db->group_by('wo_preparedby');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                //$this->db->where_in('wo_preparedby', $this->session->userdata['miconlogin']['all_users']);
                $this->db->where('wo_preparedby', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                //$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }else{
                $this->db->where('wo_preparedby', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if($this->input->get('wo_type') && ($this->input->get('wo_type') != ''))
        {
            $this->db->where('wo_type', $this->input->get('wo_type'));
        }
        $this->db->where('DATE_FORMAT(otw_invdate,"%Y-%m")',date('Y-m'));
        $this->db->order_by('SUM(otw_invftotal)','DESC');
        $query = $this->db->get();
        $value['this_month_sale_lists'] = $query->result_array();

        $this->db->select('wo_preparedby as preparedby,tbl_admin_users.au_fname as preparedby_fname,tbl_admin_users.au_lname as preparedby_lname,SUM(otw_invftotal) as count');
        $this->db->from('tbl_outward');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_outward.otw_work_ord_id');
        $this->db->join('tbl_admin_users','tbl_admin_users.au_id = tbl_work_order.wo_preparedby','left');
        //$this->db->join('tbl_inquiry_status', 'tbl_inquiry_status.inquiry_status_id = tbl_inquiry.inq_inqstatus');
        //$this->db->where('sq_isdeleted', 0);
        $this->db->where('wo_preparedby !=', 0);
        $this->db->group_by('wo_preparedby');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                //$this->db->where_in('wo_preparedby', $this->session->userdata['miconlogin']['all_users']);
                $this->db->where('wo_preparedby', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                //$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }else{
                $this->db->where('wo_preparedby', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if($this->input->get('wo_type') && ($this->input->get('wo_type') != ''))
        {
            $this->db->where('wo_type', $this->input->get('wo_type'));
        }
        $this->db->where('DATE_FORMAT(otw_invdate,"%Y-%m")',date('Y-m',strtotime("-1 month")));
        $this->db->order_by('SUM(otw_invftotal)','DESC');
        $query = $this->db->get();
        $value['last_month_sale_lists'] = $query->result_array();

        $this->db->select('wo_preparedby as preparedby,tbl_admin_users.au_fname as preparedby_fname,tbl_admin_users.au_lname as preparedby_lname,SUM(otw_invftotal) as count');
        $this->db->from('tbl_outward');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_outward.otw_work_ord_id');
        $this->db->join('tbl_admin_users','tbl_admin_users.au_id = tbl_work_order.wo_preparedby','left');
        //$this->db->join('tbl_inquiry_status', 'tbl_inquiry_status.inquiry_status_id = tbl_inquiry.inq_inqstatus');
        //$this->db->where('sq_isdeleted', 0);
        $this->db->where('wo_preparedby !=', 0);
        $this->db->group_by('wo_preparedby');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                //$this->db->where_in('wo_preparedby', $this->session->userdata['miconlogin']['all_users']);
                $this->db->where('wo_preparedby', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                //$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }else{
                $this->db->where('wo_preparedby', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if(date("m") < 4)
        {
            $last_year = date('Y', strtotime('-1 year'));
            $this_year = date('Y');
            //$year_string = $last_year.''.$this_year.'-'.strtoupper(date('M'));
            $this->db->where('DATE_FORMAT(otw_invdate,"%Y-%m") >=',"".$last_year."-4");
            $this->db->where('DATE_FORMAT(otw_invdate,"%Y-%m") <=',"".$this_year."-3");
        }else{
            $next_year = date('Y', strtotime('+1 year'));
            $this_year = date('Y');
            //$year_string = $this_year.''.$next_year.'-'.strtoupper(date('M'));
            $this->db->where('DATE_FORMAT(otw_invdate,"%Y-%m") <=',"".$next_year."-03");
            $this->db->where('DATE_FORMAT(otw_invdate,"%Y-%m") >=',"".$this_year."-04");
        }
        if($this->input->get('wo_type') && ($this->input->get('wo_type') != ''))
        {
            $this->db->where('wo_type', $this->input->get('wo_type'));
        }
        $this->db->order_by('SUM(otw_invftotal)','DESC');
        $query = $this->db->get();
        $value['this_year_sale_lists'] = $query->result_array();
        //echo '<pre>';print_r($value);die;
        return $value;
    }
    public function account_delete_otw($data)
    {

        $this->db->select('otw_work_ord_id');
        $this->db->from('tbl_outward');
        $this->db->where('otw_id',$data['otw_id']);
        $query = $this->db->get();
        $woid = $query->row_array();
       //echo '<pre>';print_r($data);die;
         $updatear = array('otw_delete_remark' => $data['otw_delete_remark'],'otw_isdelete' => 1);
            $this->db->where('otw_id',$data['otw_id']);
            $this->db->update('tbl_outward',$updatear);

        // $updatear = array('wo_isdeleted' => 1);
        //     $this->db->where('wo_id',$woid['otw_work_ord_id']);
        //     $this->db->update('tbl_work_order',$updatear);

        $this->db->select('*');
        $this->db->from('tbl_outward_item');
        $this->db->where('otwi_owt_id',$data['otw_id']);
        $this->db->where('otwi_isdelete',0);
        $query = $this->db->get();
        $otwitm = $query->result_array();
        //echo '<pre>';print_r($otwitm);die;

        foreach ($otwitm as $key => $value) 
        {
            $transaction = array(
                            'tran_itm_id' => $value['otwi_itm_name'],
                            'tran_itm_qty' => $value['otwi_qty'],
                            'tran_otw_id' => $value['otwi_owt_id'],
                            'tran_otw_item_id' => $value['otwi_id'],
                            'tran_wo_id' => $woid['otw_work_ord_id'],
                            'tran_cr_or_dr' => 1,
                            'tran_ip' => $_SERVER['REMOTE_ADDR'],
                            'tran_cid'=> $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
                            'tran_cdate' => date('Y-m-d H:i:s'),
                            'tran_udate' => date('Y-m-d H:i:s')
                        );
                    $this->db->insert('tbl_transaction',$transaction);

            $updatear = array('woi_isdelete' => 1);
            $this->db->where('woi_id',$value['otwi_woitemid']);
            $this->db->update('tbl_work_order_item',$updatear);

            $updatear = array('otwi_isdelete' => 1);
            $this->db->where('otwi_id',$value['otwi_id']);
            $this->db->update('tbl_outward_item',$updatear);

        }

        $this->db->select('*');
        $this->db->from('tbl_work_order_item');
        $this->db->where('tbl_work_order_item.woi_wo_id',$woid['otw_work_ord_id']);
        $this->db->where('woi_isdelete',0);
        $query = $this->db->get();
        if($query->num_rows() == 0)
        {
            $updatear = array('wo_isdeleted' => 1);
            $this->db->where('wo_id',$woid['otw_work_ord_id']);
            $this->db->update('tbl_work_order',$updatear);
        }


        $this->db->select('*');
        $this->db->from('tbl_work_order');
        $this->db->where('tbl_work_order.wo_id',$woid['otw_work_ord_id']);
        $query = $this->db->get();
        if($query->num_rows() == 1)
        {
            $workorder_data = $query->row_array();
            $notimsg = $workorder_data['wo_wo_no'].' - '." Deleted By ".$this->session->userdata['miconlogin']['fname'].'. Stock Inward Successfully || Remark : '.$data['otw_delete_remark'];
        }else{
            $notimsg = "Deleted By ".$this->session->userdata['miconlogin']['fname']."";
        }

        $noti = array(
                'wo_noti_woid' => $woid['otw_work_ord_id'],
                //'wo_noti_wo_itmid' => $data['wo_itemid'],
                'wo_noti_msg' => $notimsg,
                'wo_noti_adid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
                'wo_noti_date' => date('Y-m-d H:i:s')
            );
        $this->db->insert('tbl_work_order_notification',$noti);
        $wonid = $this->db->insert_id();
        $assigndep = array('super_admin','sales_manager','production_manager','accounts');
        $this->assign_notification_rights($wonid,$assigndep,$single_user = false,$woid['otw_work_ord_id']);



    }

    public function get_notifications($data)
    {
        $result = array();
        $result['status'] = false;
        $result['data'] = array();
        $result['no_of_notification'] = 0;
        $data['last_auto_id'] = isset($data['last_auto_id']) && ($data['last_auto_id'] != '') ? $data['last_auto_id'] : 0;
        $this->db->select('wo_noti_msg as msg,wo_noti_id auto_id');
        $this->db->from('tbl_work_order_notification');
        $this->db->join('tbl_wo_noti_assign','tbl_wo_noti_assign.wna_wo_noti_id = tbl_work_order_notification.wo_noti_id');
        $this->db->where('wo_noti_id >',$data['last_auto_id']);
        $this->db->where('wna_urgent','1');
        $this->db->where('wna_toid',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
        $this->db->order_by('wo_noti_id','DESC');
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            $result['status'] = true;
            $result['no_of_notification'] = $query->num_rows();
        }

        $this->db->select('wo_noti_msg as msg,wo_noti_id auto_id');
        $this->db->from('tbl_work_order_notification');
        $this->db->join('tbl_wo_noti_assign','tbl_wo_noti_assign.wna_wo_noti_id = tbl_work_order_notification.wo_noti_id');
        $this->db->where('wna_toid',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
        $this->db->limit('1000');
        $this->db->order_by('wo_noti_id','DESC');
        $query = $this->db->get();
        $result['data'] = $query->result_array();
        return $result;
    }

    public function insert_demo_add_details($data)
    {

        //echo '<pre>';print_r($this->input->get('die_id'));die;
        if($this->input->get('die_id') != 0)
        {
            $item = array(
                'dis_docket_no' => $data['docket_no'],
                'dis_docket_date' => date("Y-m-d", strtotime($data['docket_date'])),
                'dis_challan_no' => $data['challan_no'],
                'dis_challan_date' => date("Y-m-d", strtotime($data['challan_date'])),
                'dis_wodemo_note' => $data['remark'],
                'dis_collected_by' => $data['dis_collected_by'],
                );
                //echo '<pre>';print_r($item);die;
                $this->db->where('dis_id',$this->input->get('die_id'));
                $this->db->update('tbl_dispatch',$item);
                $lid = $this->input->get('die_id');
        }else{
                $wo_id = $this->encrypt_decrypt('decrypt',$this->input->get()['wo_id']);
           // echo '<pre>';print_r($wo_id);die;
                $this->db->select('*');
                $this->db->from('tbl_outward');
                $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_outward.otw_work_ord_id');
                $this->db->join('tbl_master_party','tbl_master_party.master_party_id = tbl_outward.otw_customer_id','left');
                $this->db->where('wo_id',$wo_id);
                $query = $this->db->get();
                $otwdata = $query->row_array();
               // echo '<pre>';print_r($data);die;


                $this->db->select('dis_id');
                $this->db->from('tbl_dispatch');
                $this->db->order_by('dis_id','DESC');
                $this->db->limit(1);
                $query = $this->db->get();
                $autoid = $query->row_array();

                if(date("m") < 4)
                {
                    $last_year = date('y', strtotime('-1 year'));
                    $this_year = date('y');
                    $year_string = $last_year.''.$this_year.'-'.strtoupper(date('M'));
                }else{
                    $next_year = date('y', strtotime('+1 year'));
                    $this_year = date('y');
                    $year_string = $this_year.''.$next_year.'-'.strtoupper(date('M'));
                }

                $autoid['dis_id'] = isset($autoid['dis_id']) ? $autoid['dis_id'] : '';
                $disno = 'DIS-'.$year_string.'-'.($autoid['dis_id']+1);



            $item = array(
                'dis_no' => $disno,
                'dis_po_no' => $otwdata['wo_po_no'],
                'dis_po_date' => $otwdata['wo_po_date'],
                'dis_wo_no' => $otwdata['wo_wo_no'],
                'dis_wo_date' => $otwdata['wo_wo_date'],
                'dis_woid' => $otwdata['otw_work_ord_id'],
                'dis_otwid' => $otwdata['otw_id'],
                'dis_vendor' => $otwdata['otw_customer_name'],
                'dis_courier_name' => $otwdata['wo_couriername'],
                'dis_cust_address' => $otwdata['wo_address'],
                'dis_vendorid' => $otwdata['otw_customer_id'],
                'dis_cust_name' => $otwdata['otw_customer_name'],

                'dis_docket_no' => $data['docket_no'],
                'dis_docket_date' => date("Y-m-d", strtotime($data['docket_date'])),
                'dis_challan_no' => $data['challan_no'],
                'dis_challan_date' => date("Y-m-d", strtotime($data['challan_date'])),
                'dis_wodemo_note' => $data['remark'],
                'dis_collected_by' => $data['dis_collected_by'],
                'dis_wotype' => $otwdata['wo_type'],

                //'dis_cust_email' => $otwdata['master_party_email_address'],
                'dis_cid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
                'dis_cdate' => date('Y-m-d H:i:s'),
                'dis_udate' => date('Y-m-d H:i:s'),
                'dis_docket_date' => date('Y-m-d H:i:s')
                );
                //echo '<pre>';print_r($item);die;
                $this->db->insert('tbl_dispatch',$item);
                $lid = $this->db->insert_id();

                $this->db->select('*');
                $this->db->from('tbl_outward_item');
                $this->db->where('otwi_owt_id',$otwdata['otw_id']);
                $this->db->where('otwi_isdelete',0);
                $query = $this->db->get();
                //echo'<pre>';print_r($query->result_array());die;
                $data['inqitm'] = $query->result_array();
                if(isset($data['inqitm']) && !empty($data['inqitm']) && $data['inqitm'] != '')
                {
                    foreach($data['inqitm'] as $key => $itm)
                    {
                        //echo'<pre>';print_r($itm['otwi_itm_name']);die;
                    $item = array(
                            'disi_dispatch_id' => $lid,
                            'disi_woid' => $itm['otwi_woid'],
                            'disi_woitmid' => $itm['otwi_woitemid'],
                            'disi_otwid' => $itm['otwi_owt_id'],
                            'disi_otwitm' => $itm['otwi_id'],
                            'disi_itm_name' => $itm['otwi_itm_name'],
                            'disi_itm_code' => $itm['otwi_itm_code'],
                            'disi_itm_title' => $itm['otwi_itm_title'],
                            'disi_partno'=> isset($itm['otwi_part_no']) ? $itm['otwi_part_no'] : '',
                            'disi_qty'=> $itm['otwi_qty'],
                            'disi_unit'=> $itm['otwi_unit'],
                            'disi_itm_price'=> $itm['otwi_price'],
                            'disi_itm_total'=> $itm['otwi_total'],
                            'disi_itm_discount'=> $itm['otwi_discount'],
                            'disi_ftotal'=> $itm['otwi_ftotal'],
                            'disi_udate' => date('Y-m-d H:i:s')
                            );
                        //echo'<pre>';print_r($item);die;
                        $this->db->insert('tbl_dispatch_item',$item);
                        }
                        // $updatear = array('woi_account_approve' => '1','woi_account_approve_date' => date("Y-m-d H:i:s"));
                        // $this->db->where('woi_id',$itm['otwi_woitemid']);
                        // $this->db->update('tbl_work_order_item',$updatear);
                }
                 if($this->input->get('wo_id'))
                {
                    $this->db->set('wo_iscompleted',1);
                    $this->db->set('wo_completed_date',date("Y-m-d H:i:s"));
                    $this->db->where('wo_id',$wo_id);
                    $this->db->update('tbl_work_order');
                }
                $updatear = array('otw_completed' => '2');
                $this->db->where('otw_id',$otwdata['otw_id']);
                $this->db->update('tbl_outward',$updatear);

        }
        return $lid;
    }
    public function get_demo_dis_details($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_dispatch');
        $this->db->where('dis_id',$id);
        $query = $this->db->get();
        //echo '<pre>';print_r($query->row_array());die;
        return $query->row_array();
    }
    public function get_wodemopdfdata($id)
    {

        $value = array();
        $this->db->select('*');
        $this->db->from('tbl_dispatch');
        $this->db->join('tbl_work_order','tbl_work_order.wo_id = tbl_dispatch.dis_woid');
        $this->db->join('tbl_outward','tbl_outward.otw_id = tbl_dispatch.dis_otwid','left');
        $this->db->where('tbl_dispatch.dis_id',$id);
        $query = $this->db->get();
        $value['inv'] = $query->row_array();


        $this->db->select('tbl_dispatch_item.*,(SELECT GROUP_CONCAT(tbl_outward_serail_key.outward_serial_keyname)  FROM tbl_outward_serail_key where tbl_outward_serail_key.outward_item_id = tbl_outward_item.otwi_id) as serialkey');
        $this->db->from('tbl_dispatch_item');
        //$this->db->join('tbl_outward','tbl_outward.otw_id = tbl_dispatch_item.disi_otwid','left');
        //$this->db->join('tbl_outward_item','tbl_outward_item.otwi_owt_id = tbl_dispatch_item.disi_otwid');
        $this->db->join('tbl_outward_item','tbl_outward_item.otwi_id = tbl_dispatch_item.disi_otwitm','left');
        $this->db->where('tbl_dispatch_item.disi_dispatch_id',$id);
        $this->db->where('tbl_dispatch_item.disi_isdelete',0);
        $query = $this->db->get();
        $value['items'] = $query->result_array();
        //echo $this-db->last_query();die;
        return $value;
    }
    public function get_demo_chaln_no()
    {
        $this->db->select('dis_challan_no');
        $this->db->from('tbl_dispatch');
        $this->db->where('dis_wotype',3);
        $this->db->order_by('dis_id','DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        

        $autoid = $query->row_array();
       // echo '<pre>';print_r($autoid['dis_challan_no']);die;
        $autoid = explode("DEMO-1920-AUG-",$autoid['dis_challan_no']);
        //echo '<pre>';print_r($autoid[1]+1);die;
        // $this->db->select('*');
        // $this->db->from('tbl_prefix');
        // //$this->db->where('pre_cid',$this->session->userdata['login']['aus_Id']);
        // $query = $this->db->get();
        // $code = $query->row_array();

        $autoid['dis_challan_no'] = isset($autoid['dis_challan_no']) ? $autoid['dis_challan_no'] : '';
        //return $code['pre_Work_order'].''.($autoid['wo_id']+1);
        //echo date("y");die;
        if(date("m") < 4)
        {
            $last_year = date('y', strtotime('-1 year'));
            $this_year = date('y');
            $year_string = $last_year.''.$this_year.'-'.strtoupper(date('M'));
        }else{
            $next_year = date('y', strtotime('+1 year'));
            $this_year = date('y');
            $year_string = $this_year.''.$next_year.'-'.strtoupper(date('M'));
        }
        return 'DEMO-'.$year_string.'-'.($autoid[1]+1);
    }
    public function complate_workorder_fainal()
    {
        $wo_id = $this->encrypt_decrypt('decrypt',$this->uri->segment(3));
        //$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
        //echo '<pre>';print_r($wo_id);die;
        $this->db->set('wo_iscompleted',1);
        $this->db->set('wo_completed_date',date("Y-m-d H:i:s"));
        $this->db->where('wo_id',$wo_id);
        $this->db->update('tbl_work_order');
    }
    
    public function delete_workorder_fainal()
    {
        $wo_id = $this->encrypt_decrypt('decrypt',$this->uri->segment(3));
        //$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),
        //echo '<pre>';print_r($wo_id);die;
        $this->db->set('wo_isdeleted',1);
        $this->db->where('wo_id',$wo_id);
        $this->db->update('tbl_work_order');
    }

    public function account_item_confirm($data,$postdata)
    {
        $updatear = array('otwi_account_cid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),'otwi_account_date' => date("Y-m-d H:i:s"),'otwi_account_qty' => $postdata['qty'],'otwi_account_remark' => $postdata['remark']);
        if($postdata['qty'] == $data['outqty'])
        {
            $updatear['otwi_account_cid'] = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']);
        }else{
            $updatear['otwi_account_cid'] = 0;
        }
        $this->db->where('otwi_id',$data['outitemid']);
        $this->db->update('tbl_outward_item',$updatear);
    }

    public function account_item_confirm_direct($data)
    {
        $updatear = array('otwi_account_cid' => $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),'otwi_account_date' => date("Y-m-d H:i:s"));
        $this->db->where('otwi_id',$data['outitemid']);
        $this->db->update('tbl_outward_item',$updatear);
    }
}
?>