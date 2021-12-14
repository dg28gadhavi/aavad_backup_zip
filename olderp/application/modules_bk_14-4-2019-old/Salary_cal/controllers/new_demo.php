public function add()
	{		
		$right_status = $this->check_rights('add');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Salary_cal Add functionality");
			redirect(base_url());
		}		
		$success = true;
		
		if($success == TRUE)
		{
			if($this->input->get(NULL,FALSE))
			{	
				//print_r($this->input->get('sal_month_name')); die;
				
				$value = array();
				$value = $this->input->get(NULL,FALSE);
				$value = $this->security->xss_clean($value);				
				$value['salary_month_udate'] = date('Y-m-d H:i:s');		
				$value['sal_month_name'] = $this->input->get('sal_month_name');
				
				//$lid = $this->Salary_cal_model->add($value);
				
				$idenc = $this->encrypt_decrypt('encrypt',$value['sal_month_name']);
				$month =$this->encrypt_decrypt('decrypt', $idenc);
				$lid = $this->Salary_cal_model->add($value, $month);	

				//print_r($lid); die;
				if(isset($idenc) && $idenc != ''){
					$this->data['Sal_cals'] = $this->Salary_cal_model->get_Salary_calculation($month);
					//echo "<pre>"; print_r($this->data['Sal_cals']); die;
					if(!empty($this->data['Sal_cals']))
					{
						//echo "hi"; die;
						$this->data['action'] = "Salary_cal/add".$idenc;
						$this->data['main_content'] = 'Salary_cal_form_view';
						$this->load->view('includes/template',$this->data);

						//parent::load_view('admin/master/Salary_cal/Salary_cal_form_view',$this->data);
						$this->session->set_flashdata('success', 'Salary_cal added successfully.');
					redirect(base_url("Salary_cal/add?".$idenc), 'refresh'); 
					}
					else
					{
						 $this->session->set_flashdata('error', 'Salary_cal not Available!!');
						 redirect(base_url('Salary_cal'), 'refresh'); 
					}
				}
				redirect(base_url("Salary_cal"), 'refresh');
			 
			}
				
				
				
		}
		if($success == FALSE)
		{	
		//echo "gggg"; die;		
			$this->get_form();
		}
	}



	if($lid)
				{
					$this->session->set_flashdata('success', 'Inquiry added successfully.');
					redirect(base_url('Salary_cal/add?sal_month_name='.$month), 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Inquiry  not added successfully!!');
					redirect(base_url('Salary_cal/add?sal_month_name='.$month), 'refresh');
				}
			 	redirect(base_url('Salary_cal/'), 'refresh');



			 	<input type="text" tabindex="2" name="sal_cal_work_days" id="sal_cal_work_days" value="<?php echo isset($Sal_cal['sal_cal_work_days']) ? $Sal_cal['sal_cal_work_days'] : ""; ?>">