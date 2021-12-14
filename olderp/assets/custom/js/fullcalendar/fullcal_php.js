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

		header:{
	     left:'prev,next today',
	     center:'title',
	     right:'month,agendaWeek,agendaDay'
	    },
		selectable: true,
		selectHelper: true,
		editable: true,

		select: function(start, end, allDay) {
			var start = moment(start, 'DD.MM.YYYY HH:mm:ss').format('YYYY-MM-DD');
			var showstart = moment(start, 'YYYY-MM-DD').format('DD-MM-YYYY');
			//alert(start);
			$("#createAppointmentForm").find("input[type=text], textarea, input[type=file]").val("");
			$('#createEventModal #apptDay').val(start);
			$('#createEventModal #apptEDay').val(end);
			$('#createEventModal #apptId').removeAttr('value');
			$('#createEventModal #apptEId').removeAttr('value');
			//$('#createEventModal').modal('show');

			// ajax call krvanu 
			$.ajax({
		      url:base_url+"Calendar/get_datewise_events",
		      type:"POST",
		      data:{start:start},
		      success:function(result, textStatus, jqXHR){
					//alert(result);
					result = $.parseJSON(result);
					$("#event_add").show();
					$("#sidebarheading").empty();
					$("#sidebarheading").append(showstart+' Task');
					$("#sidebarheading").append('<a href="'+base_url+'Calendar/load_pdf?start_date='+showstart+'" target="_BLANK" class="btn btn-success"> PDF for '+showstart+' </a>');
					$("#event_box").empty();
					var i=0;
					var str='';
					$.each(result, function(key,value) {
						//alert("hiii");
 					 //alert(value.wt_customer);
 					 i++;
 					 var comstr='';
 					 var bgcolor='';
 					 	if(value.wt_completed=='1'){
 					 	 	comstr="Completed"; 
 					 	 	bgcolor='style="background-color:#009900; color:#fff; padding:10px;"'; 
 					 	}else if(value.wt_completed=='2'){
 					 		comstr="Pending";
 					 		bgcolor='style="background-color:#e50000; color:#fff; padding:10px;"';
 					 	}else{
 					 		comstr="";
 					 		bgcolor=""; 
 					 	}
 					 str += '<h4 '+bgcolor+'>Task '+i+'</h4>';
 					// alert(i);
 					 //str += str += '<hr/>';
 					 str += '<div class="row" >';
 					 str += '<div class="col-md-12">';
 					 	str += '<label class="col-md-5 text-left"><b>Start Date:</b></label>';
 					 	str += '<label class="col-md-7 text-left">'+moment(value.wt_startdate, 'YYYY-MM-DD HH:mm:ss').format('DD-MM-YYYY HH:mm:ss');+'</label>';
 					str += '</div>';
 					str += '<div class="col-md-12">';
 					 	str += '<label class="col-md-5 text-left"><b>End Date:</b></label>';
 					 	str += '<label class="col-md-7 text-left">'+moment(value.wt_enddate, 'YYYY-MM-DD HH:mm:ss').format('DD-MM-YYYY HH:mm:ss');+'</label>';
 					 str += '</div>';
 					 str += '<div class="col-md-12">';
 					 	str += '<label class="col-md-5 text-left"><b>Assign To:</b></label>';
 					 	str += '<label class="col-md-7 text-left">'+value.assigntoname+'</label>';
 					 str += '</div>';
 					 str += '<div class="col-md-12">';
 					 	str += '<label class="col-md-5 text-left"><b>Assign By:</b></label>';
 					 	str += '<label class="col-md-7 text-left">'+value.assignfromname+'</label>';
 					 str += '</div>';
 					 str += '<div class="col-md-12">';
 					 	str += '<label class="col-md-5 text-left"><b>Priority:</b></label>';
 					 	var prioritys='';
 					 	if(value.wt_priority=='1'){
 					 	 	prioritys="High"; 
 					 	}else if(value.wt_priority=='2'){
 					 		prioritys="Medium";
 					 	}else if(value.wt_priority=='3'){
 					 		prioritys="Low";
 					 	}else{
 					 		prioritys="";
 					 	}
 					 	str += '<label class="col-md-7 text-left">'+prioritys+'</label>';
 					str += '</div>';
 					 str += '<div class="col-md-12">';
 					 	str += '<label class="col-md-5 text-left"><b>Task Type:</b></label>';
 					 	str += '<label class="col-md-7 text-left">'+value.task_name+'</label>';
 					 str += '</div>';
 					 str += '<div class="col-md-12">';
 					 	str += '<label class="col-md-5 text-left"><b>State:</b></label>';
 					 	str += '<label class="col-md-7 text-left">'+value.wt_place+'</label>';
 					 str += '</div>';
 					 str += '<div class="col-md-12">';
 					 	str += '<label class="col-md-5 text-left"><b>City:</b></label>';
 					 	str += '<label class="col-md-7 text-left">'+value.wt_city+'</label>';
 					 str += '</div>';
 					 str += '<div class="col-md-12">';
 					 	str += '<label class="col-md-5 text-left"><b>Accomplished By Date:</b></label>';
 					 	str += '<label class="col-md-7 text-left">'+moment(value.wt_acc_date, 'YYYY-MM-DD').format('DD-MM-YYYY');+'</label>';
 					 str += '</div>';
 					str += '<div class="col-md-12">';
 					 	str += '<label class="col-md-5 text-left"><b>Customer Name:</b></label>';
 					 	str += '<label class="col-md-7 text-left">'+value.wt_customer+'</label>';
 					 str += '</div>';
 					 str += '<div class="col-md-12">';
 					 	str += '<label class="col-md-5 text-left"><b>Task Description:</b></label>';
 					 	str += '<label class="col-md-7 text-left">'+value.wt_description+'</label>';
 					str += '</div>';
 					 str += '<div class="col-md-12">';
 					 	str += '<label class="col-md-5 text-left"><b>Remark:</b></label>';
 					 	str += '<label class="col-md-7 text-left">'+value.wt_remark+'</label>';
 					 str += '</div>';
 					 str += '<div class="col-md-12">';
 					 	str += '<label class="col-md-5 text-left"><b>Expense:</b></label>';
 					 	str += '<label class="col-md-7 text-left">'+value.wt_expense+'</label>';
 					 str += '</div>';
 					 str += '<div class="col-md-12">';
 					 	str += '<label class="col-md-5 text-left"><b>Followup Date:</b></label>';
 					 	str += '<label class="col-md-7 text-left">'+moment(value.wt_follow_date, 'YYYY-MM-DD').format('DD-MM-YYYY');+'</label>';
 					 str += '</div>';
 					 str += '<div class="col-md-12">';
 					 	str += '<label class="col-md-5 text-left"><b>Completed:</b></label>';
 					 	
 					 	str += '<label class="col-md-7 text-left">'+comstr+'</label>';
 					 str += '</div>';
 					str += '</div>';
 					str += '<hr>';
					}); 
					$("#event_box").append(str);
					//console.log(result);
					
					
				},
				error: function(jqXHR, textStatus, errorThrown){
				    alert('error');  
				}
		     });
			//alert('hiii');
		},
		events: base_url+"Calendar/get_all_slots?assignby="+assignby+"&assignto="+assignto+"&priority="+priority+"&completed="+completed+"&place="+place+"&city="+city+"&customer_name="+customer_name+"&text_desc="+text_desc+"&remark="+remark+"&follow_date="+follow_date,
		eventColor: '#378006',
		eventRender: function(event, element) {                                          
    		element.find('span.fc-title').html(element.find('span.fc-title').text());
    		element.find('div.fc-title').html(element.find('div.fc-title').text());
		},
		editable:true,
	    eventDrop:function(event)
    	{
    		var start = moment(event.start, 'DD.MM.YYYY HH:mm:ss').format('YYYY-MM-DD HH:mm:ss');
    		var end_dt = moment(event.end, 'DD.MM.YYYY HH:mm:ss').format('YYYY-MM-DD HH:mm:ss');
    		var id = event.id;
    		//var id = event.id;
//$('#calendar').fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
			$.ajax({
		      url:base_url+"Calendar/change_dates",
		      type:"POST",
		      data:{start:start, end:end_dt, id:id},
		      success:function()
		      {
		       calendar.fullCalendar('refetchEvents');
		       //alert("Event Updated");
		      }
		     });
    		//alert('Drop: '+id);
    	},
		eventClick: function(event) {
			//alert('hiii');
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
		var wt_assignby = $('#wt_assignby').val();
		var wt_assigndate = moment.utc($('#wt_assigndate').val()).format('YYYY-MM-DD');
	    var wt_assignto = $('#wt_assignto').val();
	    var wt_priority = $('#wt_priority').val();
	    var wt_task_type = $('#wt_task_type').val();
	    var wt_place = $('#wt_place').val();
	    var wt_acc_date = $('#wt_acc_date').val();
	    var wt_city = $('#wt_city').val();
	    var wt_remark = $('#wt_remark').val();
	    //alert($('#wt_follow_date').val());
	    var wt_follow_date = $('#wt_follow_date').val();
	    //alert(wt_follow_date);
		var wt_description = $('#wt_description').val();
		var wt_customer = $('#wt_customer').val();
		var wt_expense = $('#wt_expense').val();
		var wt_completed = $('#wt_completed').val();
		var wt_annoucements = $('#wt_annoucements').val();
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

		var form_data = new FormData();
        var ins = document.getElementById('wt_attch').files.length;
        for (var x = 0; x < ins; x++) {
            form_data.append("files[]", document.getElementById('wt_attch').files[x]);
        }
        form_data.append("start_dt", final_dt);
        form_data.append("end_date", final_dt_end);
        form_data.append("wt_assignby", wt_assignby);
        form_data.append("wt_assigndate", wt_assigndate);
        form_data.append("wt_assignto", wt_assignto);
        form_data.append("wt_priority", wt_priority);
        form_data.append("wt_task_type", wt_task_type);
        form_data.append("wt_place", wt_place);
        form_data.append("wt_acc_date", wt_acc_date);
        form_data.append("wt_city", wt_city);
        form_data.append("wt_remark", wt_remark);
        form_data.append("wt_customer", wt_customer);
        form_data.append("wt_expense", wt_expense);
        form_data.append("wt_completed", wt_completed);
        form_data.append("wt_annoucements", wt_annoucements);
        form_data.append("wt_follow_date", wt_follow_date);
        form_data.append("wt_description", wt_description);
        form_data.append("app_id", app_id);
//data : { wt_assignby: wt_assignby ,	wt_assigndate: wt_assigndate, wt_assignto: wt_assignto,	wt_priority: wt_priority,
	//wt_task_type: wt_task_type,	wt_place: wt_place,	wt_acc_date: 
//wt_acc_date, wt_city: wt_city,	wt_remark: wt_remark,wt_customer: wt_customer,wt_expense: wt_expense,
//wt_completed: wt_completed,wt_follow_date: wt_follow_date,	wt_description: wt_description,	app_id:app_id,form_data:form_data },	
		//alert(app_id+"\n"+final_dt+"\n"+user_doc_sess+"\n"+prac_detail_id);
		//alert(master_schedule_programme);
		//alert($_GET('prog'));

		$.ajax({
		    url : base_url+"Calendar/insert_slot",
		    type: "POST",
		    //data : { start_dt: final_dt, end_date: final_dt_end, wt_assignby: wt_assignby ,	wt_assigndate: wt_assigndate, wt_assignto: wt_assignto,	wt_priority: wt_priority,	wt_task_type: wt_task_type,	wt_place: wt_place,	wt_acc_date: wt_acc_date, wt_city: wt_city,	wt_remark: wt_remark,wt_customer: wt_customer,wt_expense: wt_expense,wt_completed: wt_completed,wt_follow_date: wt_follow_date,	wt_description: wt_description,	app_id:app_id,form_data:form_data },
		    data: form_data,
		    processData: false,
		    contentType: false,
		    success:function(result, textStatus, jqXHR){
		        $("#createEventModal").modal('hide');
				$('#calendar').fullCalendar('refetchEvents');
		    },
		    error: function(jqXHR, textStatus, errorThrown){
		        alert('error');  
		    }
		});
	}
	/******************************** Insert Section **************************************************/

	/******************************** Updpate Section **************************************************/
	$('#open_del_submit').on('click', function(e) {
		$('#ConfirmEventModal').modal('hide');
		$('#DelEventModal').modal('show');
	});

	$('#open_edit_submit').on('click', function(e) 
	{
		//alert("hiii");
		$('#ConfirmEventModal').modal('hide');
		$("#createAppointmentForm").find("input[type=file]").val("");
		var edit_evt_id = $('#evt_id').val();
		$.post(base_url+"Calendar/check_updation", {
				edit_id: edit_evt_id
			},
			function(result) {
				var assinged_flag = result;
				if (assinged_flag == 1) {
					$('#AlertEventModal').modal('show');
					return false;
				} else {
					//alert('hiii');
					var objh = jQuery.parseJSON( result );
					//alert(objh.event_group);

					$('#wt_assignby').val(objh.wt_assignby);
					//moment.utc(start_dt).format('DD-MM-YYYY')
					//moment.utc().format('DD-MM-YYYY');
					$('#wt_assigndate').val(moment.utc(objh.wt_assigndate).format('DD-MM-YYYY'))
				    $('#wt_assignto').val(objh.wt_assignto);
				    $('#wt_priority').val(objh.wt_priority);
				    $('#wt_task_type').val(objh.wt_task_type);
				    $('#wt_place').val(objh.wt_place);
				    //moment.utc($('#wt_acc_date').val(objh.wt_acc_date)).format('DD-MM-YYYY');
				    $('#wt_acc_date').val(moment.utc(objh.wt_acc_date).format('DD-MM-YYYY'));
				    $('#wt_city').val(objh.wt_city);
				    $('#wt_remark').val(objh.wt_remark);
				    //moment.utc($('#wt_follow_date').val(objh.wt_follow_date)).format('DD-MM-YYYY');
				    $('#wt_follow_date').val(moment.utc(objh.wt_follow_date).format('DD-MM-YYYY'));
					$('#wt_description').val(objh.wt_description);
					$('#wt_customer').val(objh.wt_customer);
					$('#wt_expense').val(objh.wt_expense);
					$('#wt_completed').val(objh.wt_completed);
					$('#wt_annoucements').val(objh.wt_annoucements);
					var set_time_val = moment.utc($('#evt_date').val()).format("hh:mm A");
					var set_time_val_end = moment.utc($('#evt_Edate').val()).format("hh:mm A");
					$('#timepicker4').timepicker('setTime', set_time_val);
					$('#end_time').timepicker('setTime', set_time_val_end);
					//attachement_show
					$("#attachement_show").empty();
					var j = 0;
					$.each( objh.files, function( key, value ) { j++;
						$("#attachement_show").append('<div id="filemain'+value.cf_id+'"><h5><a href="'+base_url+'uploads/task_file/'+value.cf_filename+'" target="_BLANK">File '+j+' <a class="btn btn-danger filedeleteclick" id="deletefile'+value.cf_id+'" ><i class="fa fa-trash"></i></a> </h5>');
						//onclick="return confirm('+"'Are you sure you want to Delete this record?'"+')"
					});
					$('#createEventModal').modal('show');
				}
			}
		);
	});
	/******************************** Updpate Section **************************************************/
	$(document).on('click', '.filedeleteclick', function(){
		//alert($(this).attr('id'));
		if (confirm('Do you want to delete this file?')) {
		var idstr = $(this).attr('id');
		var res = idstr.split('deletefile');
		var idval = res[1];
		$.ajax({
			type: "POST",
			url: base_url+"Calendar/del_files",
			data: "idval=" + idval,
            success: function(data) 
            {
            	$('#filemain'+idval).empty();
            }
		});
		}
		return false;
	});
	/******************************* Delete Section ********************************/

	$('#submitDelYes').on('click', function(e) {
		e.preventDefault();
		$('#DelEventModal').modal('show');
		var u_id=$('#user_id').val();
		//alert(u_id);
		var evt_id = $('#evt_id').val();
		var form_data = new FormData();
		form_data.append("appoint_id", evt_id);
		form_data.append("userid", u_id);
		//alert(form_data);
		$.ajax({
			type: "POST",
			url: base_url+"Calendar/del_slot",
			data: form_data,
			 processData: false,
		    contentType: false,
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

    $(document).on('click', '#event_add', function() {
    	$('#createEventModal').modal('show');
    });
});