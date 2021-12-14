<?php 
if(isset($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && (!isset($this->session->userdata['miconlogin']['base_url_sess']) || ($this->session->userdata['miconlogin']['base_url_sess'] != base_url()))){
	$this->session->sess_destroy();
	redirect(base_url()."Login");
}
$this->load->model('Global_model');
$notificationsdata['data'] = $this->Global_model->get_notifications();

$notificationsdata['tagline_data'] =$this->Global_model->get_tagline_data();
$notificationsdata['anniversary'] =$this->Global_model->get_anniv_data();
$notificationsdata['joining'] =$this->Global_model->get_join_data();
$notificationsdata['admin_data'] =$this->Global_model->get_admin_data();
 ?>
<?php $this->load->view('includes/header',$notificationsdata); ?>

<?php $this->load->view($main_content); ?>

<?php $this->load->view('includes/footer'); ?>