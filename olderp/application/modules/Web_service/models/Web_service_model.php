<?php 
class Web_service_model extends CI_Model {

	
	public function login($email,$pass)
	{
		$this->db->select('*');
		$this->db->from('tbl_admin_users');
		$this->db->where('au_email',$email);
        $this->db->where('au_password',$pass);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->row_array();
	}

	
	public function dashboard($userid,$tid)
	{
		$value = array();
        $i = 0;

        $this->db->select('COUNT(fu_id) as count');
        $this->db->from('tbl_sales_inq_followup');
        $this->db->join('tbl_sales_enq','tbl_sales_inq_followup.fu_inq_id=tbl_sales_enq.sq_id','left');
        if(isset($tid) && $tid != 3)
                {
          $this->db->where('sq_cid',$userid);
        }
        $this->db->where('fu_isdelete',0);
        $this->db->where('fu_followupst',5);
        $query = $this->db->get();
        $value[$i] = $query->row_array();
        $value[$i]['title'] = 'Followup Active Inq';
        $value[$i]['subtitle'] = 'fai';
        
        $i++;
        $this->db->select('COUNT(fu_id) as count');
        $this->db->from('tbl_sales_inq_followup');
        $this->db->join('tbl_sales_enq','tbl_sales_inq_followup.fu_inq_id=tbl_sales_enq.sq_id','left');
        if(isset($tid) && $tid != 3)
		{
        	$this->db->where('sq_cid',$userid);
        }
        $this->db->where('fu_isdelete',0);
        $this->db->where('fu_followupst',6);
        $query = $this->db->get();
        $value[$i] = $query->row_array();
        $value[$i]['title'] = 'Followup Deactive Inq';
        $value[$i]['subtitle'] = 'fdi';

        $i++;
        $this->db->select('COUNT(fu_id) as count');
        $this->db->from('tbl_sale_quotation_followup');
        $this->db->join('tbl_sale_quotation','tbl_sale_quotation_followup.fu_inq_id=tbl_sale_quotation.sa_id');
        if(isset($tid) && $tid != 3)
        {
            $this->db->where('sa_cid',$userid);
        }
        $this->db->where('fu_isdelete',0);
        $this->db->where('fu_followupst',5);
        $query = $this->db->get();
        $value[$i] = $query->row_array();
        $value[$i]['title'] = 'Followup Active Quo';
        $value[$i]['subtitle'] = 'faq';

        $i++;
        $this->db->select('COUNT(fu_id) as count');
        $this->db->from('tbl_sale_quotation_followup');
        $this->db->join('tbl_sale_quotation','tbl_sale_quotation_followup.fu_inq_id=tbl_sale_quotation.sa_id');
        if(isset($tid) && $tid != 3)
		{
        	$this->db->where('sa_cid',$userid);
        }
        $this->db->where('fu_isdelete',0);
        $this->db->where('fu_followupst',6);
        $query = $this->db->get();
        $value[$i] = $query->row_array();
        $value[$i]['title'] = 'Followup Deactive Quo';
        $value[$i]['subtitle'] = 'fdq';

        $i++;
        $this->db->select('COUNT(sq_id) as count');
        $this->db->from('tbl_sales_enq');
        if(isset($tid) && $tid != 3)
		{
        	$this->db->where('sq_cid', $userid);
        }
        $this->db->where('sq_isdeleted','0');
        $query = $this->db->get();
        $value[$i] = $query->row_array();
        $value[$i]['title'] = 'Total Inq';
        $value[$i]['subtitle'] = 'inq_list';
        $i++;

        $this->db->select('COUNT(sa_id) as count');
        $this->db->from('tbl_sale_quotation');
        if(isset($tid) && $tid != 3)
		{
        	$this->db->where('sa_cid', $userid);
        }
        $this->db->where('sa_isdeleted','0');
        $query = $this->db->get();
        $value[$i] = $query->row_array();
        $value[$i]['title'] = 'Total Quo';
        $value[$i]['subtitle'] = 'quo_list';
        $i++;

        $this->db->select('COUNT(oa_id) as count');
        $this->db->from('tbl_oa');
        if(isset($tid) && $tid != 3)
		{
        	$this->db->where('oa_cid',$userid);
        }
        $this->db->where('oa_isdeleted',0);
        $query = $this->db->get();
        $value[$i] = $query->row_array();
        $value[$i]['title'] = 'Total Oa';
        $value[$i]['subtitle'] = 'oa_list';
        $i++;

        $this->db->select('COUNT(pi_id) as count');
        $this->db->from('tbl_pi');
        if(isset($tid) && $tid != 3)
		{
        	$this->db->where('pi_cid', $userid);
        }
        $this->db->where('pi_isdeleted',0);
        $query = $this->db->get();
        $value[$i] = $query->row_array();
        $value[$i]['title'] = 'Total Pi';
        $value[$i]['subtitle'] = 'pi_list';
        $i++;

        $this->db->select('SUM(sqi_itm_ftotal) as count');
        $this->db->from('tbl_sales_enq_item');
        $this->db->join('tbl_sales_enq', 'tbl_sales_enq_item.sqi_sales_enq_id = tbl_sales_enq.sq_id','left');
        if(isset($tid) && $tid != 3)
		{
        	$this->db->where('sq_cid', $userid);
        }
        $this->db->where('sq_isdeleted',0);
        $this->db->where('sqi_item_isdelete',0);
        $query = $this->db->get();
        $value[$i] = $query->row_array();
        $value[$i]['title'] = 'Total Inq Amount';
        $value[$i]['subtitle'] = 'inq_list';
        $i++;

        $this->db->select('SUM(sai_itm_total) as count');
        $this->db->from('tbl_sale_quotation_item');
        $this->db->join('tbl_sale_quotation', 'tbl_sale_quotation_item.sai_sale_quotation_id = tbl_sale_quotation.sa_id','left');
        if(isset($tid) && $tid != 3)
		{
        	$this->db->where('sa_cid', $userid);
        }
         $this->db->where('sai_isdeleted','0');
         $this->db->where('sa_isdeleted','0');
        $query = $this->db->get();
        //echo "<pre>"; print_r($query->row_array()); die;
        $value[$i] = $query->row_array();
        $value[$i]['title'] = 'Total Quo Amount';
        $value[$i]['subtitle'] = 'quo_list';
        $i++;

        $this->db->select('SUM(oai_itm_total) as count');
        $this->db->from('tbl_oa_item');
        $this->db->join('tbl_oa','tbl_oa_item.oai_oale_quotation_id = tbl_oa.oa_id','left');
        if(isset($tid) && $tid != 3)
		{
        	$this->db->where('oa_cid', $userid);
        }
        $this->db->where('oai_isdeleted',0);
        $this->db->where('oa_isdeleted',0);
        $query = $this->db->get();
        $value[$i] = $query->row_array();
        $value[$i]['title'] = 'Total Oa Amount';
        $value[$i]['subtitle'] = 'oa_list';
        $i++;
        /***********************************************************/

         $this->db->select('SUM(pii_itm_total) as count');
        $this->db->from('tbl_pi_item');
        $this->db->join('tbl_pi','tbl_pi_item.pii_oale_quotation_id = tbl_pi.pi_id','left');
        if(isset($tid) && $tid != 3)
		{
        	$this->db->where('pi_cid', $userid);
        }
        $this->db->where('pii_isdeleted',0);
        $this->db->where('pi_isdeleted',0);
        $query = $this->db->get();
        $value[$i] = $query->row_array();
        $value[$i]['title'] = 'Total Pi Amount';
        $value[$i]['subtitle'] = 'pi_list';
        $i++;
        
        return $value;

	}
	public function inq_list($uid,$tid,$values)
	{
		$this->db->select('*');
		$this->db->from('tbl_sales_enq');
        //$this->db->where('sq_cid',$uid);
        if(isset($tid) && $tid != 3)
		{
		$this->db->where('tbl_sales_enq.sq_cid', $uid);
		}
        $this->db->where('sq_isdeleted','0');
		$this->db->limit($values['limit'],$values['start']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}

	public function inq_totalrows($uid,$tid)
	{
		$this->db->select('*');
		$this->db->from('tbl_sales_enq');
        //$this->db->where('sq_cid',$uid);
        if(isset($tid) && $tid != 3)
		{
		$this->db->where('tbl_sales_enq.sq_cid', $uid);
		}
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->num_rows();
	}

	public function quo_list($uid,$tid,$values)
	{
		$this->db->select('*');
		$this->db->from('tbl_sale_quotation');
		if(isset($tid) && $tid != 3)
		{
        	$this->db->where('sa_cid',$uid);
        }
        $this->db->where('sa_isdeleted','0');
        $this->db->limit($values['limit'],$values['start']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	public function quo_totalrows($uid,$tid)
	{
		$this->db->select('*');
		$this->db->from('tbl_sale_quotation');
		if(isset($tid) && $tid != 3)
		{
        	$this->db->where('sa_cid',$uid);
        }
        $this->db->where('sa_isdeleted','0');
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->num_rows();
	}
	public function oa_list($uid,$tid,$values)
	{
		$this->db->select('*');
		$this->db->from('tbl_oa');
		if(isset($tid) && $tid != 3)
		{
        	$this->db->where('oa_cid',$uid);
        }
        $this->db->where('oa_isdeleted','0');
        $this->db->limit($values['limit'],$values['start']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	public function oa_totalrows($uid,$tid)
	{
		$this->db->select('*');
		$this->db->from('tbl_oa');
		if(isset($tid) && $tid != 3)
		{
        	$this->db->where('oa_cid',$uid);
        }
        $this->db->where('oa_isdeleted','0');
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->num_rows();
	}
	public function pi_list($uid,$tid,$values)
	{
		$this->db->select('*');
		$this->db->from('tbl_pi');
		if(isset($tid) && $tid != 3)
		{
        	$this->db->where('pi_cid',$uid);
        }
        $this->db->where('pi_isdeleted','0');
        $this->db->limit($values['limit'],$values['start']);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	public function pi_totalrows($uid,$tid)
	{
		$this->db->select('*');
		$this->db->from('tbl_pi');
		if(isset($tid) && $tid != 3)
		{
        	$this->db->where('pi_cid',$uid);
        }
        $this->db->where('pi_isdeleted','0');
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->num_rows();
	}
}?>