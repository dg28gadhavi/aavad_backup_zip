<?php //echo "<pre>";print_r($work_order);?>
<?php if(isset($work_order['outward_lists'][0]['item_lists']) && is_array($work_order['outward_lists'][0]['item_lists']) && !empty($work_order['outward_lists'][0]['item_lists'])) { ?>
<?php $j = 0; foreach ($work_order['outward_lists'] as $outkey => $outward_data) { $j++; ?>
	<h3>Outward : <?php echo $j; ?>  </h3>
<table class="table table-bordered">
	<?php  	//echo "<pre>";print_r($outward_data);die; ?>
										<tr>
										  	<th colspan="2" style="text-align: center;">MASPL/MS</th>
										  	<td colspan="4" class="wotb">No.: <?php echo $outward_data['otw_no']; ?></td>
										  	<td colspan="2" class="wotb">Date: <?php echo $outward_data['otw_cdate']; ?></td>
									 	</tr>
									 </table>
									 <table class="table table-bordered">
										<tr>
											<td class="wotdark">Name:</td>
										  	<td class="wotc" colspan="7"><strong><?php echo $outward_data['otw_customer_name']; ?></strong></td>
										</tr>
										<tr>
											<td class="wotldark">Address:</td>
										  	<td colspan="7"></strong><?php echo $outward_data['wo_address']; ?></td>
										</tr>
										<tr>
											<td class="wotldark">Billing Address:</td>
										  	<td colspan="7"></strong><?php echo $outward_data['wo_billing_address']; ?></td>
										</tr>
										<tr>
											<td class="wotldark">Shipping Address:</td>
										  	<td colspan="7"></strong><?php echo $outward_data['wo_shipping_address']; ?></td>
										</tr>
									</table>
									<table class="table table-bordered">
										<tr class="headtb">
											<th style="text-align: center;">SR. No.</th>
											<th colspan="2" style="text-align: center;">Item Description</th>
											<th style="text-align: center;">Qty</th>
											<th style="text-align: center;">PF</th>
											<th style="text-align: center;">Fright</th>
											<th style="text-align: center;">Rate</th>
										</tr>
									 	<?php $show_approve = 1; $counter = 0; foreach ($outward_data['item_lists'] as $itemkey => $items) { $counter++; ?>
									 	<tr data-toggle="collapse" data-target="#idemo<?php echo $items['otwi_id']; ?>">
									 		<?php if(isset($items['woi_production_approve']) && ($items['woi_production_approve'] != '3')){
									 			$show_approve = 0;
									 		} ?>
											  <td><?php echo $counter; ?></td>
											  <td colspan="2"><?php echo $items['otwi_part_no']." ".$items['otwi_itm_title']." ".$items['otwi_itm_desc']; ?></td>
											  <td><?php echo $items['otwi_qty']; ?></td>
											   <td><?php echo $items['otwi_qty']; ?></td>
											    <td><?php echo $items['otwi_qty']; ?></td>
											  <td><?php echo $items['otwi_price']; ?></td>
										</tr>
									 <?php } ?>
									 <?php if($show_approve == 1){ ?>
									 	<tr>
									 		<td colspan="7">
												 <h3><a href="<?php echo base_url(); ?>Dashboard_workorder_final/outward_confirm?otw_id=<?php echo $outward_data['otw_id']; ?>&wo_id=<?php echo $outward_data['wo_id']  ?>" class="btn btn-success"><i class="fa fa-check"></i></a>
														</h3>
											</td>
										</tr>
										<?php } ?>
											<tr>
										 		<td colspan="7" style="text-align:right;">
												<a href="<?php echo base_url(); ?>Dashboard_workorder_final/account_delete_otw?otw_id=<?php echo $outward_data['otw_id']; ?>" onclick="return confirm('Are you sure want to delete this?');" class="btn btn-sm btn-danger btn-left"><i class="fa fa-trash"></i> Outward Delete Option</a>
												</td>
											</tr>
										</table>
									<?php /* <table class="table table-bordered">
									<tr>
										<td class="wotdark">Prepared By:</td>
										<td colspan="2" class="wotc"><strong> <?php echo $outward_data['au_fname']." ".$outward_data['au_lname']; ?></strong></td>
										<td class="wotdark">Remarks:</td>
										<td colspan="4" class="wotc"><strong><?php echo $outward_data['otw_remark']; ?></strong></td>
									</tr>
								</table> */ ?>
<?php } }  ?>