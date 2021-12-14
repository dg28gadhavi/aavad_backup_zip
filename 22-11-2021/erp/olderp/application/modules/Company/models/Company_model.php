<?php 

class Company_model extends CI_Model {
	
	
	public function add($data)
	{
		$item = array(
			'co_inst_id' => $data['co_inst'],
			'co_study_id' => $data['co_study'],
			'co_degree_id' => $data['co_degree'],
			'co_course_id' => $data['co_course'],
			'co_duration' => $data['co_duration'],
			'co_intakes' => $data['co_intakes'],
			'co_campus' => $data['co_campus'],
			'co_fees' => $data['co_fees'],
			'co_criteria' => $data['co_criteria'],
			'co_link' => $data['co_link'],
			'co_website' => $data['co_website'],
			'co_speci' => $data['co_speci'],
			'co_ielts' => $data['co_ielts'],
			'co_pte' => $data['co_pte'],
			'co_toefl' => $data['co_toefl'],
			'co_scho_avail' => $data['co_scho_avail'],
			'co_work_exp' => $data['co_work_exp'],
			'Company_cdate' => date('Y-m-d')
			);
			//echo '<pre>'; print_r($item);die;
		$this->db->insert('tbl_Company',$item);
		$lid = $this->db->insert_id();
		return $lid;
	}
	
	public function edit($data,$id)
	{ 
		$item = array(
			'co_inst_id' => $data['co_inst'],
			'co_study_id' => $data['co_study'],
			'co_degree_id' => $data['co_degree'],
			'co_course_id' => $data['co_course'],
			'co_duration' => $data['co_duration'],
			'co_intakes' => $data['co_intakes'],
			'co_campus' => $data['co_campus'],
			'co_fees' => $data['co_fees'],
			'co_criteria' => $data['co_criteria'],
			'co_link' => $data['co_link'],
			'co_website' => $data['co_website'],
			'co_speci' => $data['co_speci'],
			'co_ielts' => $data['co_ielts'],
			'co_pte' => $data['co_pte'],
			'co_toefl' => $data['co_toefl'],
			'co_scho_avail' => $data['co_scho_avail'],
			'co_work_exp' => $data['co_work_exp'],
			'co_udate' => date('Y-m-d')
			);
		$this->db->where('co_id', $id);
		//echo "<pre>"; print_r($item); die;
		$this->db->update('tbl_Company', $item);
		return $id;	
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_Company');
		$this->db->where('co_id',$id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_Company()
	{
		$this->db->select('*');
		$this->db->from('tbl_Company');
		$this->db->order_by('co_id', 'asc');
		$this->db->where('co_isdelete', 0);
		
		if($this->input->post('Company_name') && ($this->input->post('Company_name') != ''))
        {
           $this->db->like('Company_name', $this->input->post('Company_name'));   
        }
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function delete($id)
	{
		$this->db->set('co_isdelete', 1);
		$this->db->where('co_id', $id);
		$this->db->update('tbl_Company');
		return $id;
	}
	
	
public function importcsv($data)
	{
		//echo '<pre>';print_r($data['Company']);die;
		$this->db->select('*');
        $this->db->from('tbl_institution');
        $this->db->where('inst_name',$data['Name of the Institution']);
        $query = $this->db->get();
        if($query->num_rows() == 0)
        {
            $item = array(
            'inst_name' => $data['Name of the Institution'],
            'inst_cdate' => date("Y-m-d"),
            );
            $this->db->insert('tbl_institution',$item);
            $inst_id = $this->db->insert_id();
        }else if($query->num_rows() > 0)
        {
            $inst_data = $query->row_array();
            $inst_id = $inst_data['inst_id'];
        }else{
            $inst_id = 0;
        }

	        $this->db->select('*');
	        $this->db->from('tbl_area_study');
	        $this->db->where('as_name',$data['Area of Study']);
	        $query = $this->db->get();
	        if($query->num_rows() == 0)
	        {
	            $item = array(
	            'as_name' => $data['Area of Study'],
	            'as_cdate' => date("Y-m-d"),
	            );
	            $this->db->insert('tbl_area_study',$item);
	            $as_id = $this->db->insert_id();
	        }else if($query->num_rows() > 0)
	        {
	            $as_data = $query->row_array();
	            $as_id = $as_data['as_id'];
	        }else{
	            $as_id = 0;
	        }

	        $this->db->select('*');
	        $this->db->from('tbl_course');
	        $this->db->where('course_name',$data['Name of the course']);
	        $query = $this->db->get();
	        if($query->num_rows() == 0)
	        {
	            $item = array(
	            'course_name' => $data['Name of the course'],
	            'course_cdate' => date("Y-m-d"),
	            );
	            $this->db->insert('tbl_course',$item);
	            $course_id = $this->db->insert_id();
	        }else if($query->num_rows() > 0)
	        {
	            $course_data = $query->row_array();
	            $course_id = $course_data['course_id'];
	        }else{
	            $course_id = 0;
	        }

	        $this->db->select('*');
	        $this->db->from('tbl_campus');
	        $this->db->where('campus_name',$data['Campus']);
	        $query = $this->db->get();
	        if($query->num_rows() == 0)
	        {
	            $item = array(
	            'campus_name' => $data['Campus'],
	            'campus_cdate' => date("Y-m-d"),
	            );
	            $this->db->insert('tbl_campus',$item);
	            $campus_id = $this->db->insert_id();
	        }else if($query->num_rows() > 0)
	        {
	            $campus_data = $query->row_array();
	            $campus_id = $campus_data['campus_id'];
	        }else{
	            $campus_id = 0;
	        }

          $item = array(
			'co_inst_id' => $inst_id,
			'co_study_id' => $as_id,
			'co_degree_id' => $data['Degree'],
			'co_course_id' => $course_id,
			'co_duration' => $data['Duration'],
			'co_intakes' => $data['Intakes'],
			'co_campus' => $campus_id,
			'co_fees' => $data['Fees in AUD $'],
			'co_criteria' => $data['Entry Criteria'],
			'co_link' => $data['Link'],
			'co_website' => $data['Website'],
			'co_speci' => $data['Specializations Available'],
			'co_ielts' => $data['IELTS'],
			'co_pte' => $data['PTE'],
			'co_toefl' => $data['TOEFL'],
			'co_scho_avail' => $data['Scholarship Available'],
			'co_work_exp' => $data['Work Experience'],
			'co_cdate' => date('Y-m-d'),
			'co_udate' => date('Y-m-d')
			);
			$this->db->insert('tbl_Company', $item);
            $cid = $this->db->insert_id();
		    return $cid;
    }

	
	/*public function addtCompany()
	{
		
		$this->db->select('Company as Company_name');
		$this->db->from('Company');
		$query = $this->db->get();
		foreach ($query->result_array() as $city) {
			  $this->db->insert('tbl_Company',$city);
		}
	}*/

	public function setbit_Company()
	{
		$this->db->set('Company_isdelete', 1);
		$update = array('Australia', 'Canada', 'Denmark', 'FIJI', 'France', 'Germany', 'Malaysia', 'Mauritius', 'New Zealand', 'Philippines', 'Poland', 'Russia', 'Singapore', 'Switzerland', 'UK', 'Ukraine', 'United Arab Emirates', 'Uganda', 'Thailand', 'Tanzania', 'Spain', 'Saudi Arabia', 'Saint Lucia', 'Norway', 'Netherlands', 'Kuwait', 'Italy', 'Ireland', 'Indonesia', 'Hong Kong', 'Georgia', 'Dubai', 'China');
		//$this->db->where_in('Company_name !=', $update);
		$this->db->where_not_in('LOWER(Company_name)', array_map('strtolower', $update));
		$this->db->update('tbl_Company');
	}

}
?>