<?php 

class Dashboard_model extends CI_Model {
	
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

    public function get_reminder_task()
    {
        $this->db->select('tbl_task.*,tbl_task.task_id as auto_id,tbl_task.task_subject as subject,task_location as location,tr_ticket_no as ticketno,task_tackenby as given_by_userid,task_details as details,task_prodetails as prodetails,task_attendedby as alloted_to_id,task_status as status_id,task_expense as expence,alloted_to_user.au_fname as allot_first_name,alloted_to_user.au_lname as allot_last_name,CONCAT("'.base_url().'uploads/au_photo/","'.'", alloted_to_user.au_photo) as alloted_to_photo,given_by_to_user.au_fname as given_by_first_name,given_by_to_user.au_lname as given_by_last_name,CONCAT("'.base_url().'uploads/au_photo/","'.'", given_by_to_user.au_photo) as given_by_photo,tr_remind_date as due_date,tr_complete_date as completed_date,tbl_task_remainders.tr_id as reminder_auto_id,tr_details as reminder_details,tr_complete_date as complete_date,tr_complete_remark as complete_remark,tr_expense as expense,tr_is_completed as is_completed,tr_start_time as start_time,task_createdby,tbl_task_remainders.tr_expense as expense,task_vendor as customer_name,task_contactperson as conact_person,task_email as customer_email,task_mobile as customer_mobile,type_of_work_name');
        $this->db->from('tbl_task');
        $this->db->join('tbl_type_of_work','tbl_type_of_work.type_of_work_id = tbl_task.task_worktype','left');
        $this->db->join('tbl_task_remainders','tbl_task_remainders.tr_task_id = tbl_task.task_id','left');
        $this->db->join('tbl_admin_users as alloted_to_user','alloted_to_user.au_id = tbl_task.task_attendedby','left');
        $this->db->join('tbl_admin_users as given_by_to_user','given_by_to_user.au_id = tbl_task.task_tackenby','left');
        $this->db->where('task_status',1);
        $this->db->where('tr_is_completed !=',2);
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                //echo "<pre>";print_r($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));die;
                $this->db->where('(task_attendedby',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),false);
                $this->db->or_where('task_createdby',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']).')',false);
            }else{
                $this->db->where('task_attendedby',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        $this->db->order_by('tr_remind_date','ASC');
        
        $query = $this->db->get();
        //echo "<pre>";print_r($this->db->last_query());die;
        return $query->result_array();

    }
    public function get_task_done()
    {
        $this->db->select('tbl_task.*,tbl_task.task_id as auto_id,tbl_task.task_subject as subject,task_location as location,tr_ticket_no as ticketno,task_tackenby as given_by_userid,task_details as details,task_prodetails as prodetails,task_attendedby as alloted_to_id,task_status as status_id,task_expense as expence,alloted_to_user.au_fname as allot_first_name,alloted_to_user.au_lname as allot_last_name,CONCAT("'.base_url().'uploads/au_photo/","'.'", alloted_to_user.au_photo) as alloted_to_photo,given_by_to_user.au_fname as given_by_first_name,given_by_to_user.au_lname as given_by_last_name,CONCAT("'.base_url().'uploads/au_photo/","'.'", given_by_to_user.au_photo) as given_by_photo,tr_remind_date as due_date,tr_complete_date as completed_date,tbl_task_remainders.tr_id as reminder_auto_id,tr_details as reminder_details,tr_complete_date as complete_date,tr_complete_remark as complete_remark,tr_expense as expense,tr_is_completed as is_completed,tr_start_time as start_time,task_createdby,tbl_task_remainders.tr_expense as expense,task_vendor as customer_name,task_contactperson as conact_person,task_email as customer_email,task_mobile as customer_mobile,type_of_work_name');
        $this->db->from('tbl_task');
         $this->db->join('tbl_type_of_work','tbl_type_of_work.type_of_work_id = tbl_task.task_worktype','left');
        $this->db->join('tbl_task_remainders','tbl_task_remainders.tr_task_id = tbl_task.task_id','left');
        $this->db->join('tbl_admin_users as alloted_to_user','alloted_to_user.au_id = tbl_task.task_attendedby','left');
        $this->db->join('tbl_admin_users as given_by_to_user','given_by_to_user.au_id = tbl_task.task_tackenby','left');
        $this->db->order_by('task_id','DESC');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where('task_attendedby',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }else{
                $this->db->where('task_attendedby',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if($this->input->get('sq_attendto') && ($this->input->get('sq_attendto') != ''))
        {
            $this->db->where('task_attendedby', $this->input->get('sq_attendto'));
        }

        //$this->db->where('task_status',2);
        $this->db->where('tr_is_completed',2);
        //$this->db->where('task_due_date <=',date('Y-m-d', strtotime("+7 days")));
        $this->db->order_by('tr_complete_date','DESC');
        $this->db->limit(100);
        $query = $this->db->get();
        //echo "<pre>";print_r($query->result_array());die;
        return $query->result_array();

    }

    public function change_inqview_to($id)
    {
        $this->db->set('sq_viewed',1);
        $this->db->where('sq_id', $id);
        $this->db->update('tbl_sales_enq'); 
        return $id;
    }
    public function sales_inq_report()
    {
        $this->db->select('*');//sum(tbl_sales_enq.inv_grand_total) as grand_total_view
        $this->db->from('tbl_sales_enq');
        //$this->db->join('tbl_sales_enq_item','tbl_sales_enq.sq_id = tbl_sales_enq_item.sqi_sales_enq_id','left');
        $this->db->join('tbl_mode_inquiry','tbl_sales_enq.sq_mode_inq = tbl_mode_inquiry.mode_inquiry_id','left');
        $this->db->join('tbl_country','tbl_sales_enq.sq_country = tbl_country.country_id','left');
        $this->db->join('tbl_master_city','tbl_sales_enq.sq_city = tbl_master_city.city_id','left');
        $this->db->join('tbl_master_state','tbl_sales_enq.sq_state = tbl_master_state.state_id','left');
        //$this->db->join('tbl_item_heads as source','tbl_sales_enq.sq_source_cat = source.item_head_id','left');
        // $this->db->join('tbl_item_heads as subsource','tbl_sales_enq.sa_subsource_cat =  subsource.source_main_cat','left');
        //$this->db->join('tbl_sale_brand','tbl_sales_enq.sq_id = tbl_sale_brand.sqb_sqid','left');
        $this->db->join('tbl_admin_users','tbl_admin_users.au_id = tbl_sales_enq.sq_allotedto','left');
        $this->db->where('sq_isdeleted',0);
        $this->db->where('sq_viewed',0);
        $this->db->where('sq_inq_sts',1);

        //$this->db->where('sq_cid',$this->session->userdata['login']['aus_Id']);
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                //$this->db->where_in('tbl_sales_enq.sq_end_st', $this->session->userdata['miconlogin']['all_users']);
                $this->db->where('tbl_sales_enq.sq_allotedto',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                //$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }else{
                //$this->db->where('tbl_sales_enq.sq_end_st', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                $this->db->where('tbl_sales_enq.sq_allotedto',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
         $this->db->order_by('tbl_sales_enq.sq_id','DESC');
        
        $query = $this->db->get();
        //echo "<pre>";print_r($query->result_array());die;
        return $query->result_array();
    }
	
	public function get_inq_data()
    {
        //echo $this->input->get('executive'); die;
        $value = array();

        $this->db->select('COUNT(task_id) as count');
        $this->db->from('tbl_task');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('task_createdby', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('task_createdby', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("task_completed_date >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("task_completed_date <=",date("Y-m-d", strtotime(($end_date))));
        }
        $this->db->where('task_completed_date',date("Y-m-d"));
        $this->db->where('task_status',2);
        $query = $this->db->get();
        //echo $this->db->last_query(); die;
        $value['today_task'] = $query->row_array();

         $this->db->select('COUNT(task_id) as count');
        $this->db->from('tbl_task');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('task_createdby', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('task_createdby', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("task_completed_date >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("task_completed_date <=",date("Y-m-d", strtotime(($end_date))));
        }
        $this->db->where('task_completed_date',date('Y-m-d',strtotime("-1 days")));
        $this->db->where('task_status',2);
        $query = $this->db->get();
        //echo $this->db->last_query(); die;
        $value['yesterday_task'] = $query->row_array();

        $this->db->select('COUNT(task_id) as count');
        $this->db->from('tbl_task');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('task_createdby', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('task_createdby', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("task_completed_date >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("task_completed_date <=",date("Y-m-d", strtotime(($end_date))));
        }
        $this->db->where('task_completed_date',date('Y-m-d',strtotime("-7 days")));
        $this->db->where('task_status',2);
        $query = $this->db->get();
        //echo $this->db->last_query(); die;
        $value['weekly_task'] = $query->row_array();

        $this->db->select('COUNT(task_id) as count');
        $this->db->from('tbl_task');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('task_createdby', $this->session->userdata['miconlogin']['all_users']);
            }else{
                $this->db->where('task_createdby', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("task_completed_date >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("task_completed_date <=",date("Y-m-d", strtotime(($end_date))));
        }
        $this->db->where('task_completed_date',date('Y-m-d',strtotime("-30 days")));
        $this->db->where('task_status',2);
        $query = $this->db->get();
        //echo $this->db->last_query(); die;
        $value['monthly_task'] = $query->row_array();



        $this->db->select('COUNT(fu_id) as count');
        $this->db->from('tbl_sales_inq_followup');
        $this->db->join('tbl_sales_enq','tbl_sales_inq_followup.fu_inq_id=tbl_sales_enq.sq_id','left');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                $this->db->where('sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        $this->db->where('fu_isdelete',0);
        $this->db->where('fu_followupst',5);
        $query = $this->db->get();
        $value['act_fol'] = $query->row_array();

        $this->db->select('COUNT(fu_id) as count');
        $this->db->from('tbl_sales_inq_followup');
        $this->db->join('tbl_sales_enq','tbl_sales_inq_followup.fu_inq_id=tbl_sales_enq.sq_id','left');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('sq_cid', $this->session->userdata['miconlogin']['all_users']);
                //$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }else{
                $this->db->where('sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        $this->db->where('fu_isdelete',0);
        $this->db->where('fu_followupst',6);
        $query = $this->db->get();
        $value['dact_fol'] = $query->row_array();

        $this->db->select('COUNT(fu_id) as count');
        $this->db->from('tbl_sale_quotation_followup');
        $this->db->join('tbl_sale_quotation','tbl_sale_quotation_followup.fu_inq_id=tbl_sale_quotation.sa_id');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('sa_cid', $this->session->userdata['miconlogin']['all_users']);
                //$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }else{
                $this->db->where('sa_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        $this->db->where('fu_isdelete',0);
        $this->db->where('fu_followupst',5);
        $query = $this->db->get();
        $value['qout_act_fol'] = $query->row_array();

        $this->db->select('COUNT(fu_id) as count');
        $this->db->from('tbl_sale_quotation_followup');
        $this->db->join('tbl_sale_quotation','tbl_sale_quotation_followup.fu_inq_id=tbl_sale_quotation.sa_id');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('sa_cid', $this->session->userdata['miconlogin']['all_users']);
                //$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }else{
                $this->db->where('sa_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        $this->db->where('fu_isdelete',0);
        $this->db->where('fu_followupst',6);
        $query = $this->db->get();
        $value['qout_dact_fol'] = $query->row_array();

        // $this->db->select('*');
        // $this->db->from('tbl_sales_enq');
        // $this->db->where('sq_isdeleted','0');
        // $this->db->limit(10);
        // $this->db->order_by('sq_id','desc');
        // $query = $this->db->get();
        // $value['sales_inq'] = $query->result_array();

        $this->db->select('COUNT(sq_id) as count');
        $this->db->from('tbl_sales_enq');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('sq_cid', $this->session->userdata['miconlogin']['all_users']);
                //$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }else{
                $this->db->where('sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        $this->db->where('sq_isdeleted','0');
        if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("sq_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("sq_cdate <=",date("Y-m-d", strtotime(($end_date))));
        }
        $query = $this->db->get();
        //echo $this->db->last_query(); die;
        $value['totalinq'] = $query->row_array();


        // $this->db->select('*');
        // $this->db->from('tbl_sale_quotation');
        // $this->db->where('sa_isdeleted','0');
        // $this->db->limit(10);
        // $this->db->order_by('sa_id','desc');
        // $query = $this->db->get();
        // $value['sales_quotation'] = $query->result_array();

        $this->db->select('COUNT(sa_id) as count');
        $this->db->from('tbl_sale_quotation');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('sa_cid', $this->session->userdata['miconlogin']['all_users']);
                //$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }else{
                $this->db->where('sa_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        $this->db->where('sa_isdeleted','0');
        if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("sa_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("sa_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
        $value['totalquotation'] = $query->row_array();

        $this->db->select('COUNT(oa_id) as count');
        $this->db->from('tbl_oa');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('oa_cid', $this->session->userdata['miconlogin']['all_users']);
                //$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }else{
                $this->db->where('oa_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        $this->db->where('oa_isdeleted',0);
        if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("oa_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("oa_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
        $value['totaloa'] = $query->row_array();


         $this->db->select('COUNT(pi_id) as count');
        $this->db->from('tbl_pi');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('pi_cid', $this->session->userdata['miconlogin']['all_users']);
                //$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }else{
                $this->db->where('pi_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        $this->db->where('pi_isdeleted',0);
        if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("pi_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("pi_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
        $value['totalpi'] = $query->row_array();


        $this->db->select('SUM(sqi_itm_ftotal) as count');
        $this->db->from('tbl_sales_enq_item');
        $this->db->join('tbl_sales_enq', 'tbl_sales_enq_item.sqi_sales_enq_id = tbl_sales_enq.sq_id','left');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('sq_cid', $this->session->userdata['miconlogin']['all_users']);
                //$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }else{
                $this->db->where('sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
            $this->db->where('sq_isdeleted',0);
        $this->db->where('sqi_item_isdelete',0);
        if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("sq_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("sq_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
        $value['totalamontinq'] = $query->row_array();
        /****************************************************************/

            /***********************************************************/
        $this->db->select('SUM(sai_itm_total) as count');
        $this->db->from('tbl_sale_quotation_item');
        $this->db->join('tbl_sale_quotation', 'tbl_sale_quotation_item.sai_sale_quotation_id = tbl_sale_quotation.sa_id','left');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('sa_cid', $this->session->userdata['miconlogin']['all_users']);
                //$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }else{
                $this->db->where('sa_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
            $this->db->where('sai_isdeleted','0');
         $this->db->where('sa_isdeleted','0');
        if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("sa_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("sa_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
        //echo "<pre>"; print_r($query->row_array()); die;
        $value['totalamontqou'] = $query->row_array();
        /************************Inq. Status Stastics *****************/

        $this->db->select('SUM(oai_itm_total) as count');
        $this->db->from('tbl_oa_item');
        $this->db->join('tbl_oa','tbl_oa_item.oai_oale_quotation_id = tbl_oa.oa_id','left');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('oa_cid', $this->session->userdata['miconlogin']['all_users']);
                //$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }else{
                $this->db->where('oa_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("oa_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("oa_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $this->db->where('oai_isdeleted',0);
        $this->db->where('oa_isdeleted',0);
        $query = $this->db->get();
        $value['totalamontoa'] = $query->row_array();
        /***********************************************************/

         $this->db->select('SUM(pii_itm_total) as count');
        $this->db->from('tbl_pi_item');
        $this->db->join('tbl_pi','tbl_pi_item.pii_oale_quotation_id = tbl_pi.pi_id','left');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                $this->db->where_in('pi_cid', $this->session->userdata['miconlogin']['all_users']);
                //$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }else{
                $this->db->where('pi_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
            if($this->input->get('start_date') && $this->input->get('start_date') != "")
            {
                $start_date=$this->input->get('start_date');
                $this->db->where("pi_cdate >=",date("Y-m-d", strtotime(($start_date))));
            }
            if($this->input->get('end_date') && $this->input->get('end_date') != "")
            {
                    $end_date=$this->input->get('end_date');
                $this->db->where("pi_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
            }
        $this->db->where('pii_isdeleted',0);
        $this->db->where('pi_isdeleted',0);
        $query = $this->db->get();
        $value['totalamontpi'] = $query->row_array();


        //echo "<pre>"; print_r($query->result_array()); die;
        $this->db->select('sq_inq_sts as status,count((sq_inq_sts)) as count');
        $this->db->from('tbl_sales_enq');
        //$this->db->join('tbl_inquiry_status', 'tbl_inquiry_status.inquiry_status_id = tbl_inquiry.inq_inqstatus');
        $this->db->where('sq_isdeleted', 0);
        $this->db->where('sq_inq_sts !=', 0);
        $this->db->group_by('sq_inq_sts');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
                {
                    $this->db->where_in('sq_cid', $this->session->userdata['miconlogin']['all_users']);
                    //$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                }else{
                    $this->db->where('sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                }
            }
            if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("sq_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("sq_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
        $value['inq_status'] = $query->result_array();
        
        /**********************************************************/
        $this->db->select('sq_inq_sts as status,count((sq_inq_sts)) as count');
        $this->db->from('tbl_sales_enq');
        //$this->db->join('tbl_inquiry_status', 'tbl_inquiry_status.inquiry_status_id = tbl_inquiry.inq_inqstatus');
       $this->db->where('sq_isdeleted', 0);
       $this->db->where('sq_inq_sts', 0);
        //$this->db->group_by('sq_inq_sts');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
                {
                    $this->db->where_in('sq_cid', $this->session->userdata['miconlogin']['all_users']);
                    //$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                }else{
                    $this->db->where('sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                }
            }
            if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("sq_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("sq_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
        $value['inq_status_zero'] = $query->row_array();
        //*********************************************************
        //********************************************************
        $this->db->select('sq_inq_sts as status,count((sq_inq_sts)) as count');
        $this->db->from('tbl_sales_enq');
        //$this->db->join('tbl_inquiry_status', 'tbl_inquiry_status.inquiry_status_id = tbl_inquiry.inq_inqstatus');
        $this->db->where('sq_isdeleted', 0);
        //$this->db->group_by('sq_inq_sts');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
                {
                    $this->db->where_in('sq_cid', $this->session->userdata['miconlogin']['all_users']);
                    //$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                }else{
                    $this->db->where('sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                }
            }
            if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("sq_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("sq_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
        $value['inq_status_one'] = $query->row_array();
/****************************************************************/
            /***********************************************************/
        /************************brand Stastics *****************/
        /***********************************************************/
        //echo "<pre>"; print_r($query->result_array()); die;
        $this->db->select('sqb_bid as status,brand_name as name,count((sqb_bid)) as count');
        $this->db->from('tbl_sales_enq');
        $this->db->join('tbl_sale_brand', 'tbl_sale_brand.sqb_sqid = tbl_sales_enq.sq_id');
        $this->db->join('tbl_brand', 'tbl_brand.brand_id = tbl_sale_brand.sqb_bid');
        $this->db->where('sq_isdeleted', 0);
        $this->db->where('sqb_bid !=', 0);
        $this->db->group_by('sqb_bid');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
                {
                    $this->db->where_in('sq_cid', $this->session->userdata['miconlogin']['all_users']);
                    //$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                }else{
                    $this->db->where('sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                }
            }
        if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("sq_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("sq_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
        $value['inq_brand'] = $query->result_array();
        
        /**********************************************************/
        $this->db->select('sqb_bid as status,count((sqb_bid)) as count');
        $this->db->from('tbl_sales_enq');
        $this->db->join('tbl_sale_brand', 'tbl_sale_brand.sqb_sqid = tbl_sales_enq.sq_id');
        $this->db->where('sq_isdeleted', 0);
        $this->db->where('sqb_bid', 0);

        //$this->db->group_by('sq_inq_sts');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
                {
                    $this->db->where_in('sq_cid', $this->session->userdata['miconlogin']['all_users']);
                    //$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                }else{
                    $this->db->where('sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                }
            }
            if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("sq_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("sq_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
        $value['inq_brand_zero'] = $query->row_array();
        //*********************************************************
        //********************************************************
       $this->db->select('sqb_bid as status,count((sqb_bid)) as count');
        $this->db->from('tbl_sales_enq');
        $this->db->join('tbl_sale_brand', 'tbl_sale_brand.sqb_sqid = tbl_sales_enq.sq_id');
        $this->db->where('sq_isdeleted', 0);
        //$this->db->group_by('sq_inq_sts');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
                {
                    $this->db->where_in('sq_cid', $this->session->userdata['miconlogin']['all_users']);
                    //$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                }else{
                    $this->db->where('sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                }
            }
            if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("sq_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("sq_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
        $value['inq_brand_one'] = $query->row_array();
/****************************************************************/
            /***********************************************************/
        /************************source Stastics *****************/
        /***********************************************************/
        //echo "<pre>"; print_r($query->result_array()); die;
         $this->db->select('source_cat_name as name,sq_source_cat as status,count((sq_source_cat)) as count');
        $this->db->from('tbl_sales_enq');
       $this->db->join('tbl_source_cat', 'tbl_source_cat.source_cat_id = tbl_sales_enq.sq_source_cat');
        $this->db->where('sq_isdeleted', 0);
        $this->db->group_by('sq_source_cat');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
                {
                    $this->db->where_in('sq_cid', $this->session->userdata['miconlogin']['all_users']);
                    //$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                }else{
                    $this->db->where('sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                }
            }
        if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("sq_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("sq_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
        $value['inq_source'] = $query->result_array();
        
        /**********************************************************/
        $this->db->select('sq_source_cat as status,count((sq_source_cat)) as count');
        $this->db->from('tbl_sales_enq');
        //$this->db->join('tbl_inquiry_status', 'tbl_inquiry_status.inquiry_status_id = tbl_inquiry.inq_inqstatus');
       $this->db->where('sq_isdeleted', 0);
       $this->db->where('sq_source_cat', 0);
        //$this->db->group_by('sq_inq_sts');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
                {
                    $this->db->where_in('sq_cid', $this->session->userdata['miconlogin']['all_users']);
                    //$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                }else{
                    $this->db->where('sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                }
            }
        if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("sq_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("sq_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
        $value['inq_source_zero'] = $query->row_array();
        //*********************************************************
        //********************************************************
        $this->db->select('sq_source_cat as status,count((sq_source_cat)) as count');
        $this->db->from('tbl_sales_enq');
        //$this->db->join('tbl_inquiry_status', 'tbl_inquiry_status.inquiry_status_id = tbl_inquiry.inq_inqstatus');
        $this->db->where('sq_isdeleted', 0);
        //$this->db->group_by('sq_inq_sts');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
                {
                    $this->db->where_in('sq_cid', $this->session->userdata['miconlogin']['all_users']);
                    //$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                }else{
                    $this->db->where('sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                }
            }
        if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("sq_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("sq_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
        $value['inq_source_one'] = $query->row_array();
        /****************************************************************/
            /***********************************************************/
        /************************sub source Stastics *****************/
        /***********************************************************/
        //echo "<pre>"; print_r($query->result_array()); die;
        $this->db->select('source_cat_name as name,sq_subsource_cat as status,count((sq_subsource_cat)) as count');
        $this->db->from('tbl_sales_enq');
       $this->db->join('tbl_source_cat', 'tbl_source_cat.source_cat_id = tbl_sales_enq.sq_subsource_cat');
        $this->db->where('sq_isdeleted', 0);
        $this->db->group_by('sq_subsource_cat');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
                {
                    $this->db->where_in('sq_cid', $this->session->userdata['miconlogin']['all_users']);
                    //$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                }else{
                    $this->db->where('sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                }
            }
        if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("sq_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("sq_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
        $value['inq_subsource'] = $query->result_array();
        
        /**********************************************************/
        $this->db->select('sq_subsource_cat as status,count((sq_subsource_cat)) as count');
        $this->db->from('tbl_sales_enq');
        //$this->db->join('tbl_inquiry_status', 'tbl_inquiry_status.inquiry_status_id = tbl_inquiry.inq_inqstatus');
       $this->db->where('sq_isdeleted', 0);
       $this->db->where('sq_subsource_cat', 0);
        //$this->db->group_by('sq_inq_sts');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
                {
                    $this->db->where_in('sq_cid', $this->session->userdata['miconlogin']['all_users']);
                    //$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                }else{
                    $this->db->where('sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                }
            }
            if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("sq_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("sq_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
        $value['inq_subsource_zero'] = $query->row_array();
        //*********************************************************
        //********************************************************
        $this->db->select('sq_subsource_cat as status,count((sq_subsource_cat)) as count');
        $this->db->from('tbl_sales_enq');
        //$this->db->join('tbl_inquiry_status', 'tbl_inquiry_status.inquiry_status_id = tbl_inquiry.inq_inqstatus');
        $this->db->where('sq_isdeleted', 0);
        //$this->db->group_by('sq_inq_sts');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
                {
                    $this->db->where_in('sq_cid', $this->session->userdata['miconlogin']['all_users']);
                    //$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                }else{
                    $this->db->where('sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                }
            }
            if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("sq_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("sq_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
        $value['inq_subsource_one'] = $query->row_array();

/****************************************************************/
            /***********************************************************/
        /************************Executive Stastics *****************/
        /***********************************************************/
        //echo "<pre>"; print_r($query->result_array()); die;
        $this->db->select('au_fname as fname,au_lname as lname,sq_end_st as  status,count((sq_end_st)) as count');
        $this->db->from('tbl_sales_enq');
       $this->db->join('tbl_admin_users', 'tbl_admin_users.au_id = tbl_sales_enq.sq_end_st','left');
        $this->db->where('sq_isdeleted', 0);
        $this->db->group_by('sq_end_st');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
                {
                    $this->db->where_in('sq_cid', $this->session->userdata['miconlogin']['all_users']);
                    //$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                }else{
                    $this->db->where('sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                }
            }
        if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("sq_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("sq_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
        $value['inq_by'] = $query->result_array();
        /**********************************************************/
        $this->db->select('sq_end_st as status,count((sq_end_st)) as count');
        $this->db->from('tbl_sales_enq');
        //$this->db->join('tbl_inquiry_status', 'tbl_inquiry_status.inquiry_status_id = tbl_inquiry.inq_inqstatus');
       $this->db->where('sq_isdeleted', 0);
       $this->db->where('sq_end_st', 0);
        //$this->db->group_by('sq_inq_sts');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
                {
                    $this->db->where_in('sq_cid', $this->session->userdata['miconlogin']['all_users']);
                    //$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                }else{
                    $this->db->where('sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                }
            }
            if($this->input->get('start_date') && $this->input->get('start_date') != "")
            {
                $start_date=$this->input->get('start_date');
                $this->db->where("sq_cdate >=",date("Y-m-d", strtotime(($start_date))));
            }
            if($this->input->get('end_date') && $this->input->get('end_date') != "")
            {
                    $end_date=$this->input->get('end_date');
                $this->db->where("sq_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
            }
        $query = $this->db->get();
        $value['inq_by_zero'] = $query->row_array();
        //*********************************************************
        //********************************************************
        $this->db->select('sq_end_st as status,count((sq_end_st)) as count');
        $this->db->from('tbl_sales_enq');
        //$this->db->join('tbl_inquiry_status', 'tbl_inquiry_status.inquiry_status_id = tbl_inquiry.inq_inqstatus');
        $this->db->where('sq_isdeleted', 0);
        //$this->db->group_by('sq_inq_sts');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
                {
                    $this->db->where_in('sq_cid', $this->session->userdata['miconlogin']['all_users']);
                    //$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                }else{
                    $this->db->where('sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                }
            }
            if($this->input->get('start_date') && $this->input->get('start_date') != "")
            {
                $start_date=$this->input->get('start_date');
                $this->db->where("sq_cdate >=",date("Y-m-d", strtotime(($start_date))));
            }
            if($this->input->get('end_date') && $this->input->get('end_date') != "")
            {
                    $end_date=$this->input->get('end_date');
                $this->db->where("sq_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
            }
        $query = $this->db->get();
        $value['inq_by_one'] = $query->row_array();
        /****************************************************************/
            /***********************************************************/
        /************************Inq. Quote.Status Stastics *****************/
        /***********************************************************/
        //echo "<pre>"; print_r($query->result_array()); die;
        $this->db->select('sa_inq_st as status,count((sa_inq_st)) as count');
        $this->db->from('tbl_sale_quotation');
        //$this->db->join('tbl_inquiry_status', 'tbl_inquiry_status.inquiry_status_id = tbl_inquiry.inq_inqstatus');
        $this->db->where('sa_isdeleted', '0');
        $this->db->where('sa_inq_st !=', 0);
        $this->db->group_by('sa_inq_st');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
                {
                    $this->db->where_in('sa_cid', $this->session->userdata['miconlogin']['all_users']);
                    //$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                }else{
                    $this->db->where('sa_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                }
            }
        if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("sa_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("sa_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
       // echo "<pre>"; print_r($query->result_array()); die;
        $value['inq_quote_status'] = $query->result_array();
        
        /**********************************************************/
        $this->db->select('sa_inq_st as status,count((sa_inq_st)) as count');
        $this->db->from('tbl_sale_quotation');
        //$this->db->join('tbl_inquiry_status', 'tbl_inquiry_status.inquiry_status_id = tbl_inquiry.inq_inqstatus');
        $this->db->where('sa_isdeleted', '0');
        $this->db->where('sa_inq_st', 0);
        //$this->db->group_by('sa_inq_st');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
                {
                    $this->db->where_in('sa_cid', $this->session->userdata['miconlogin']['all_users']);
                    //$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                }else{
                    $this->db->where('sa_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                }
            }
            if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("sa_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("sa_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
        $value['inq_quote_status_zero'] = $query->row_array();
        //*********************************************************
        //********************************************************
        $this->db->select('sa_inq_st as status,count((sa_inq_st)) as count');
        $this->db->from('tbl_sale_quotation');
        //$this->db->join('tbl_inquiry_status', 'tbl_inquiry_status.inquiry_status_id = tbl_inquiry.inq_inqstatus');
        $this->db->where('sa_isdeleted', '0');
        //$this->db->group_by('sa_inq_st');
        //$this->db->order_by('tbl_inquiry_status.inquiry_status_name', 'ASC');
        
            if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
            {
                if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
                {
                    $this->db->where_in('sa_cid', $this->session->userdata['miconlogin']['all_users']);
                    //$this->db->where('tbl_sales_enq.sq_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                }else{
                    $this->db->where('sa_cid', $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
                }
            }
            if($this->input->get('start_date') && $this->input->get('start_date') != "")
        {
            $start_date=$this->input->get('start_date');
            $this->db->where("sa_cdate >=",date("Y-m-d", strtotime(($start_date))));
        }
        if($this->input->get('end_date') && $this->input->get('end_date') != "")
        {
                $end_date=$this->input->get('end_date');
            $this->db->where("sa_cdate <=",date("Y-m-d", strtotime(($end_date))),true);
        }
        $query = $this->db->get();
        $value['inq_quote_status_one'] = $query->row_array();



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
        $this->db->where('otw_completed','2');
        $query = $this->db->get();
        $value['total_year_sales'] = $query->row_array();

        // **************************************************************

        //echo '<pre>';print_r($value['yesterday_sale']);die;
        
        
        return $value;
    }

    public function get_statics()
    {
        $value = array();

        $this->db->select('attend_auid as admin_id,tbl_admin_users.au_fname as first_name,attend_pa_id as attend_type,COUNT(distinct attend_date_firstdate) as total_count,COUNT(case when attend_pa_id = 1 then 1 end) present_count,
    COUNT(case when attend_pa_id = 0 then 1 end) absent_count');
        $this->db->from('tbl_attendance');
        $this->db->join('tbl_admin_users','tbl_admin_users.au_id = tbl_attendance.attend_auid');
        $this->db->join('tbl_attend_date','tbl_attend_date.attend_date_id = tbl_attendance.attend_date_id');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 2) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                //echo "<pre>";print_r($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));die;
                $this->db->where('(attend_auid',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),false);
                $this->db->or_where('attend_auid',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']).')',false);
            }else{
                $this->db->where('attend_auid',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        $this->db->where('DATE_FORMAT(attend_date_firstdate,"%Y-%m")',date('Y-m'));
        //$this->db->where('attend_pa_id', 1);
        $this->db->group_by('attend_auid');
        $this->db->order_by('COUNT(case when attend_pa_id = 1 then 1 end)','DESC');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        $value['this_month_data'] = $query->result_array();

        $this->db->select('attend_auid as admin_id,tbl_admin_users.au_fname as first_name,attend_pa_id as attend_type,COUNT(distinct attend_date_firstdate) as total_count,COUNT(case when attend_pa_id = 1 then 1 end) present_count,
    COUNT(case when attend_pa_id = 0 then 1 end) absent_count');
        $this->db->from('tbl_attendance');
        $this->db->join('tbl_admin_users','tbl_admin_users.au_id = tbl_attendance.attend_auid');
        $this->db->join('tbl_attend_date','tbl_attend_date.attend_date_id = tbl_attendance.attend_date_id');
        if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3) && ($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 2) &&  isset($this->session->userdata['miconlogin']['userid']) && ($this->session->userdata['miconlogin']['userid'] != ''))
        {
            if(isset($this->session->userdata['miconlogin']['all_users']) && is_array($this->session->userdata['miconlogin']['all_users']) && !empty($this->session->userdata['miconlogin']['all_users']))
            {
                //echo "<pre>";print_r($this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));die;
                $this->db->where('(attend_auid',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']),false);
                $this->db->or_where('attend_auid',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']).')',false);
            }else{
                $this->db->where('attend_auid',$this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']));
            }
        }
        $this->db->where('DATE_FORMAT(attend_date_firstdate,"%Y-%m")',date('Y-m',strtotime("-1 month")));
        //$this->db->where('attend_pa_id', 1);
        $this->db->group_by('attend_auid');
        $this->db->order_by('COUNT(case when attend_pa_id = 1 then 1 end)','DESC');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        $value['last_month_data'] = $query->result_array();
        //echo '<pre>';print_r($value);die;
        return $value;
    }
	
}
?>