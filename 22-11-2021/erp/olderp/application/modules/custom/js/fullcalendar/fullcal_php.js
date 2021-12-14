$(function() {
	/****************************** Default Calendar Load Section **************************************/
	//$('.selectpicker').selectpicker();
	function $_GET(param) {
	var vars = {};
	window.location.href.replace( location.hash, '' ).replace( 
		/[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
		function( m, key, value ) { // callback
			vars[key] = value !== undefined ? value : '';
		}
	);

	if ( param ) {
		return vars[param] ? vars[param] : null;	
	}
	return vars;
}
	$('#createEventModal .modal-body').css('height','150px');
	$(document).on('click', '.bootstrap-timepicker', function() {
		$('.bootstrap-timepicker-widget').css('z-index', '9999')
	});
	$('#timepicker4').timepicker({
		minuteStep: 5,
		showMeridian: true,
		defaultTime: false
	}).on('changeTime.timepicker', function(e) {
		$('#createEventModal #apptTime').val(e.time.value);
	});

	$('#end_time').timepicker({
		minuteStep: 5,
		showMeridian: true,
		defaultTime: false
	}).on('changeTime.timepicker', function(e) {
		$('#createEventModal #apptETime').val(e.time.value);
	});

	var calendar = $('#calendar').fullCalendar({

		header: {
			left: 'prev,next',
			center: 'title',
			right: false
		},
		selectable: true,
		selectHelper: true,
		editable: true,

		select: function(start, end, allDay) {
			$('#createEventModal #apptDay').val(start);
			$('#createEventModal #apptEDay').val(start);
			$('#createEventModal #apptId').removeAttr('value');
			$('#createEventModal #apptEId').removeAttr('value');
			$('#createEventModal').modal('show');
			//alert('hiii');
		},
		events: base_url+"admin/weeklytour/get_all_slots",

		eventClick: function(event) {
			$('#evt_id').val(event.id);
			$('#createEventModal #apptDay').val(event.start);
			$('#createEventModal #apptEDay').val(event.end_dt);
			$('#evt_date').val(event.start);
			$('#evt_Edate').val(event.end_dt);
			//alert(event.start);
			$('#createEventModal #apptId').val(event.id);
			$('#createEventModal #apptEId').val(event.id);
			//$('#practice_id').val(event.practice_id);
			//$('#group_name').val(event.group_name);
			//alert(event.programme_type);
			// $('#programme_type').find('option').each(function(i,e){
		 //        if($(e).val() == event.programme_type){
		 //            $('#programme_type').prop('selectedIndex',i);
		 //        }
		 //    });

			var action_header = 'Time Slot [' + moment.utc($('#evt_date').val()).format("DD MMM hh:mm A") + '] Choose Action';
			$('#ConfirmEventModal h4.modal-title').html(action_header);
			$('#ConfirmEventModal').modal('show');
		}

	});

	/****************************** Default Calendar Load Section **************************************/

	/******************************** Insert Section **************************************************/

	$('#submitButton').on('click', function(e) {
		e.preventDefault();
		var time = $('#apptTime').val();
			doSubmit();
	});

	function doSubmit() {

		var day = $('#apptDay').val();
		var time = $('#apptTime').val();
		var district = $('#district').val();
		var city = $('#city').val();
		var customer = $('#customer').val();
		var remark = $('#remark').val();
		
		var dayend = $('#apptEDay').val();
		var timeend = $('#apptETime').val();
		 //alert(time);
		var res = time.split(":");
		var resend = timeend.split(":");
		var hr = parseInt(res[0]);
		var hrend = parseInt(resend[0]);
		var res_other = res[1];
		var res_other_end = resend[1];
		var res_time = res_other.split(" ");
		var res_time_end = res_other_end.split(" ");
		var mins = res_time[0];
		var mins_end = res_time_end[0];

		if (res_time[1] == "PM" && hr != 12) {
			hr += 12;
		}
		if (res_time[1] == "AM" && hr == 12) {
			hr = 0;
		}

		if (res_time_end[1] == "PM" && hrend != 12) {
			hrend += 12;
		}
		if (res_time_end[1] == "AM" && hrend == 12) {
			hrend = 0;
		}
		var m = moment.utc(day);

		m.set('hour', hr);
		m.set('minute', mins);
		var start_dt = new Date(m);

		var m_end = moment.utc(dayend);

		m_end.set('hour', hrend);
		m_end.set('minute', mins_end);
		var start_dt_end = new Date(m_end);

		var final_dt = moment.utc(start_dt).format('YYYY-MM-DD HH:mm:ss');
		var final_dt_end = moment.utc(start_dt_end).format('YYYY-MM-DD HH:mm:ss');
		var app_id = $('#createEventModal #apptId').val();
		//alert(app_id+"\n"+final_dt+"\n"+user_doc_sess+"\n"+prac_detail_id);
		//alert(master_schedule_programme);
		//alert($_GET('prog'));
		$.post(base_url+"admin/weeklytour/insert_slot", {
				start_dt: final_dt,
				end_date: final_dt_end,
				district: district,
				city: city,
				customer: customer,
				remark: remark,
				app_id:app_id
			},
			function(result) {
				
					$("#createEventModal").modal('hide');
					$('#calendar').fullCalendar('refetchEvents');

			}
		);
	}
	/******************************** Insert Section **************************************************/

	/******************************** Updpate Section **************************************************/
	$('#open_del_submit').on('click', function(e) {
		$('#ConfirmEventModal').modal('hide');
		$('#DelEventModal').modal('show');
	});

	$('#open_edit_submit').on('click', function(e) {
		$('#ConfirmEventModal').modal('hide');
		var edit_evt_id = $('#evt_id').val();
		$.post(base_url+"admin/weeklytour/check_updation", {
				edit_id: edit_evt_id
			},
			function(result) {
				var assinged_flag = result;
				if (assinged_flag == 1) {
					$('#AlertEventModal').modal('show');
					return false;
				} else {
					alert('hiii');
					var objh = jQuery.parseJSON( result );
					//alert(objh.event_group);
					$('#district').val(objh.wt_district);
					$('#city').val(objh.wt_city);
					$('#customer').val(objh.wt_customer);
					$('#remark').val(objh.wt_remark);
					var set_time_val = moment.utc($('#evt_date').val()).format("hh:mm A");
					var set_time_val_end = moment.utc($('#evt_Edate').val()).format("hh:mm A");
					$('#timepicker4').timepicker('setTime', set_time_val);
					$('#end_time').timepicker('setTime', set_time_val_end);
					$('#createEventModal').modal('show');
				}
			}
		);
	});
	/******************************** Updpate Section **************************************************/
	
	/******************************* Delete Section ********************************/

	$('#submitDelYes').on('click', function(e) {
		e.preventDefault();
		$('#DelEventModal').modal('show');
		var evt_id = $('#evt_id').val();
		$.ajax({
			type: "POST",
			url: base_url+"admin/weeklytour/del_slot",
			data: "appoint_id=" + evt_id,
            success: function(data) 
            {
            	alert('Deleted Successfully');
            }
		});
		$('#calendar').fullCalendar('removeEvents', evt_id);
		$('#DelEventModal').modal('hide');
	});

	/******************************* Delete Section ********************************/

	/******************************* onchange **********************************/

});

$( document ).ready(function() {
    $(document).on('change', '#master_schedule_programme', function() {
//$('#master_schedule_programme').on('change', function(e) {
        //alert("?city="+$('#master_programme_city_id').val()+"&pro="+$('#master_schedule_programme').val());
        window.location.href = base_url+"admin/master_schedule/add?city="+$('#master_programme_city_id').val()+"&prog="+$('#master_schedule_programme').val();
    });
});