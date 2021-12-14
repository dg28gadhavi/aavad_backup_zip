//
$(window).load(function() {
   add1_call(0,paction,suffix,encid);
   edu_call(0,paction,suffix,encid);
   lang_call(0,paction,suffix,encid);
   phist_call(0,paction,suffix,encid);
   whistry_call(0,paction,suffix,encid);
   mdetail_call(0,paction,suffix,encid);
   thist_call(0,paction,suffix,encid);
   ufedul_call(0,paction,suffix,encid);
   ufrefu_call(0,paction,suffix,encid);
   ufplclive_call(0,paction,suffix,encid);
   ufchild_call(0,paction,suffix,encid);
   uffamcomp_call(0,paction,suffix,encid);
   $(".loader").hide().delay(20000);
});
//
//
$( document ).ready(function() {
   $(document).on('click', '.ajaxaddmorebtn', function(){
	  var add1 = ($(this).attr('id')).split('uffcompaddid');
      if($(this).attr('id') == add1[0]+'uffcompaddid')
      {
         var hidid = parseInt($('#'+add1[0]+'uffcomphid').val()) + 1;
         uffamcomp_call(hidid,'add','["'+add1[0]+'"]',encid);
      }
      var add1 = ($(this).attr('id')).split('ufchldaddid');
      if($(this).attr('id') == add1[0]+'ufchldaddid')
      {
         var hidid = parseInt($('#'+add1[0]+'ufchldhid').val()) + 1;
         ufchild_call(hidid,'add','["'+add1[0]+'"]',encid);
      }
      var add1 = ($(this).attr('id')).split('plcliveaddid');
      if($(this).attr('id') == add1[0]+'plcliveaddid')
      {
         var hidid = parseInt($('#'+add1[0]+'plclivehid').val()) + 1;
         ufplclive_call(hidid,'add','["'+add1[0]+'"]',encid);
      }
      var add1 = ($(this).attr('id')).split('ufrefuaddid');
      if($(this).attr('id') == add1[0]+'ufrefuaddid')
      {
         var hidid = parseInt($('#'+add1[0]+'ufrefuhid').val()) + 1;
         ufrefu_call(hidid,'add','["'+add1[0]+'"]',encid);
      }
      var add1 = ($(this).attr('id')).split('add1addid');
      if($(this).attr('id') == add1[0]+'add1addid')
      {
         var hidid = parseInt($('#'+add1[0]+'add1hid').val()) + 1;
         add1_call(hidid,'add','["'+add1[0]+'"]',encid);
      }
      var res = ($(this).attr('id')).split('eduaddid');
      if($(this).attr('id') == res[0]+'eduaddid')
      {
         var hidid = parseInt($('#'+res[0]+'eduhid').val()) + 1;
         edu_call(hidid,'add','["'+res[0]+'"]',encid);
      }
      var lres = ($(this).attr('id')).split('langaddid');
      if($(this).attr('id') == lres[0]+'langaddid')
      {
         var hidid = parseInt($('#'+lres[0]+'langhid').val()) + 1;
         lang_call(hidid,'add','["'+lres[0]+'"]',encid);
      }
      var lres = ($(this).attr('id')).split('phistaddid');
      if($(this).attr('id') == lres[0]+'phistaddid')
      {
         var hidid = parseInt($('#'+lres[0]+'phisthid').val()) + 1;
         phist_call(hidid,'add','["'+lres[0]+'"]',encid);
      }
      var whistry = ($(this).attr('id')).split('whistaddid');
      if($(this).attr('id') == whistry[0]+'whistaddid')
      {
         var hidid = parseInt($('#'+whistry[0]+'whisthid').val()) + 1;
         whistry_call(hidid,'add','["'+whistry[0]+'"]',encid);
      }
      var lres = ($(this).attr('id')).split('memberaddid');
      if($(this).attr('id') == lres[0]+'memberaddid')
      {
         var hidid = parseInt($('#'+lres[0]+'memberhid').val()) + 1;
         mdetail_call(hidid,'add','["'+lres[0]+'"]',encid);
      }
      var lres = ($(this).attr('id')).split('thistaddid');
      if($(this).attr('id') == lres[0]+'thistaddid')
      {
         var hidid = parseInt($('#'+lres[0]+'thisthid').val()) + 1;
         thist_call(hidid,'add','["'+lres[0]+'"]',encid);
      }
      var lres = ($(this).attr('id')).split('ufedulngaddid');
      if($(this).attr('id') == lres[0]+'ufedulngaddid')
      {
         var hidid = parseInt($('#'+lres[0]+'ufedulnghid').val()) + 1;
         ufedul_call(hidid,'add','["'+lres[0]+'"]',encid);
      }
   });
});

function uffamcomp_call(id,type,suffix,encid)
{
   suffix = $.parseJSON(suffix);
   var urlprms = '';
   $.each(suffix, function(i, item) {
      if(i == 0)
      {
         urlprms += '?suffix[]='
      }else{
         urlprms += '&suffix[]='
      }
      urlprms += item;
   });
   $.ajax({
      url: base_url+'Ajax_add_more/uf_fam_comp_add_more/'+id+''+urlprms,
      cache: false,
      type: "POST",
      data: {'mtype' : type,'id' : 1 , 'suffix' : suffix  , 'inqid' : encid},
      dataType: "json",
      success: function(result){
         for (inc = 0; inc < result.no_of_result; inc++) {
            if(id == 0)
            {
               $('#'+result.result[inc].ajax_main_id+'').html(result.result[inc].string);
               var hidid = parseInt($('#'+result.result[inc].hidinputid).val());
               $('#'+result.result[inc].hidinputid).val(hidid);
            }else{
               $('#'+result.result[inc].ajax_addmore_id+'').append(result.result[inc].string);
               var hidid = parseInt($('#'+result.result[inc].hidinputid).val()) + 1;
               $('#'+result.result[inc].hidinputid).val(hidid);
            }
         }
        $( ".date-picker" ).datepicker("refresh");
        $('.bs-select').selectpicker('refresh');
      }
   });
}

function ufchild_call(id,type,suffix,encid)
{
   suffix = $.parseJSON(suffix);
   var urlprms = '';
   $.each(suffix, function(i, item) {
      if(i == 0)
      {
         urlprms += '?suffix[]='
      }else{
         urlprms += '&suffix[]='
      }
      urlprms += item;
   });
   $.ajax({
      url: base_url+'Ajax_add_more/uf_child_add_more/'+id+''+urlprms,
      cache: false,
      type: "POST",
      data: {'mtype' : type,'id' : 1 , 'suffix' : suffix  , 'inqid' : encid},
      dataType: "json",
      success: function(result){
         for (inc = 0; inc < result.no_of_result; inc++) {
            if(id == 0)
            {
               $('#'+result.result[inc].ajax_main_id+'').html(result.result[inc].string);
               var hidid = parseInt($('#'+result.result[inc].hidinputid).val());
               $('#'+result.result[inc].hidinputid).val(hidid);
            }else{
               $('#'+result.result[inc].ajax_addmore_id+'').append(result.result[inc].string);
               var hidid = parseInt($('#'+result.result[inc].hidinputid).val()) + 1;
               $('#'+result.result[inc].hidinputid).val(hidid);
            }
         }
        $( ".date-picker" ).datepicker("refresh");
        $('.bs-select').selectpicker('refresh');
      }
   });
}

function ufplclive_call(id,type,suffix,encid)
{
   suffix = $.parseJSON(suffix);
   var urlprms = '';
   $.each(suffix, function(i, item) {
      if(i == 0)
      {
         urlprms += '?suffix[]='
      }else{
         urlprms += '&suffix[]='
      }
      urlprms += item;
   });
   $.ajax({
      url: base_url+'Ajax_add_more/uf_plclive_add_more/'+id+''+urlprms,
      cache: false,
      type: "POST",
      data: {'mtype' : type,'id' : 1 , 'suffix' : suffix  , 'inqid' : encid},
      dataType: "json",
      success: function(result){
         for (inc = 0; inc < result.no_of_result; inc++) {
            if(id == 0)
            {
               $('#'+result.result[inc].ajax_main_id+'').html(result.result[inc].string);
               var hidid = parseInt($('#'+result.result[inc].hidinputid).val());
               $('#'+result.result[inc].hidinputid).val(hidid);
            }else{
               $('#'+result.result[inc].ajax_addmore_id+'').append(result.result[inc].string);
               var hidid = parseInt($('#'+result.result[inc].hidinputid).val()) + 1;
               $('#'+result.result[inc].hidinputid).val(hidid);
            }
         }
        $( ".date-picker" ).datepicker("refresh");
        $('.bs-select').selectpicker('refresh');
      }
   });
}

function ufrefu_call(id,type,suffix,encid)
{
   suffix = $.parseJSON(suffix);
   var urlprms = '';
   $.each(suffix, function(i, item) {
      if(i == 0)
      {
         urlprms += '?suffix[]='
      }else{
         urlprms += '&suffix[]='
      }
      urlprms += item;
   });
   $.ajax({
      url: base_url+'Ajax_add_more/uf_refudet_add_more/'+id+''+urlprms,
      cache: false,
      type: "POST",
      data: {'mtype' : type,'id' : 1 , 'suffix' : suffix  , 'inqid' : encid},
      dataType: "json",
      success: function(result){
         for (inc = 0; inc < result.no_of_result; inc++) {
            if(id == 0)
            {
               $('#'+result.result[inc].ajax_main_id+'').html(result.result[inc].string);
               var hidid = parseInt($('#'+result.result[inc].hidinputid).val());
               $('#'+result.result[inc].hidinputid).val(hidid);
            }else{
               $('#'+result.result[inc].ajax_addmore_id+'').append(result.result[inc].string);
               var hidid = parseInt($('#'+result.result[inc].hidinputid).val()) + 1;
               $('#'+result.result[inc].hidinputid).val(hidid);
            }
         }
        $( ".date-picker" ).datepicker("refresh");
        $('.bs-select').selectpicker('refresh');
      }
   });
}

function ufedul_call(id,type,suffix,encid)
{
   suffix = $.parseJSON(suffix);
   var urlprms = '';
   $.each(suffix, function(i, item) {
      if(i == 0)
      {
         urlprms += '?suffix[]='
      }else{
         urlprms += '&suffix[]='
      }
      urlprms += item;
   });
   $.ajax({
      url: base_url+'Ajax_add_more/uf_edulang_add_more/'+id+''+urlprms,
      cache: false,
      type: "POST",
      data: {'mtype' : type,'id' : 1 , 'suffix' : suffix  , 'inqid' : encid},
      dataType: "json",
      success: function(result){
         for (inc = 0; inc < result.no_of_result; inc++) {
            if(id == 0)
            {
               $('#'+result.result[inc].ajax_main_id+'').html(result.result[inc].string);
               var hidid = parseInt($('#'+result.result[inc].hidinputid).val());
               $('#'+result.result[inc].hidinputid).val(hidid);
            }else{
               $('#'+result.result[inc].ajax_addmore_id+'').append(result.result[inc].string);
               var hidid = parseInt($('#'+result.result[inc].hidinputid).val()) + 1;
               $('#'+result.result[inc].hidinputid).val(hidid);
            }
         }
        $( ".date-picker" ).datepicker("refresh");
        $('.bs-select').selectpicker('refresh');
      }
   });
}

function thist_call(id,type,suffix,encid)
{
   suffix = $.parseJSON(suffix);
   var urlprms = '';
   $.each(suffix, function(i, item) {
      if(i == 0)
      {
         urlprms += '?suffix[]='
      }else{
         urlprms += '&suffix[]='
      }
      urlprms += item;
   });
   $.ajax({
      url: base_url+'Ajax_add_more/uf_travhistory_add_more/'+id+''+urlprms,
      cache: false,
      type: "POST",
      data: {'mtype' : type,'id' : 1 , 'suffix' : suffix  , 'inqid' : encid},
      dataType: "json",
      success: function(result){
         for (inc = 0; inc < result.no_of_result; inc++) {
            if(id == 0)
            {
               $('#'+result.result[inc].ajax_main_id+'').html(result.result[inc].string);
               var hidid = parseInt($('#'+result.result[inc].hidinputid).val());
               $('#'+result.result[inc].hidinputid).val(hidid);
            }else{
               $('#'+result.result[inc].ajax_addmore_id+'').append(result.result[inc].string);
               var hidid = parseInt($('#'+result.result[inc].hidinputid).val()) + 1;
               $('#'+result.result[inc].hidinputid).val(hidid);
            }
         }
        $( ".date-picker" ).datepicker("refresh");
        $('.bs-select').selectpicker('refresh');
      }
   });
}

function mdetail_call(id,type,suffix,encid)
{
   suffix = $.parseJSON(suffix);
   var urlprms = '';
   $.each(suffix, function(i, item) {
      if(i == 0)
      {
         urlprms += '?suffix[]='
      }else{
         urlprms += '&suffix[]='
      }
      urlprms += item;
   });
   $.ajax({
      url: base_url+'Ajax_add_more/uf_member_add_more/'+id+''+urlprms,
      cache: false,
      type: "POST",
      data: {'mtype' : type,'id' : 1 , 'suffix' : suffix  , 'inqid' : encid},
      dataType: "json",
      success: function(result){
         for (inc = 0; inc < result.no_of_result; inc++) {
            if(id == 0)
            {
               $('#'+result.result[inc].ajax_main_id+'').html(result.result[inc].string);
               var hidid = parseInt($('#'+result.result[inc].hidinputid).val());
               $('#'+result.result[inc].hidinputid).val(hidid);
            }else{
               $('#'+result.result[inc].ajax_addmore_id+'').append(result.result[inc].string);
               var hidid = parseInt($('#'+result.result[inc].hidinputid).val()) + 1;
               $('#'+result.result[inc].hidinputid).val(hidid);
            }
         }
        $( ".date-picker" ).datepicker("refresh");
        $('.bs-select').selectpicker('refresh');
      }
   });
}

function phist_call(id,type,suffix,encid)
{
   suffix = $.parseJSON(suffix);
   var urlprms = '';
   $.each(suffix, function(i, item) {
      if(i == 0)
      {
         urlprms += '?suffix[]='
      }else{
         urlprms += '&suffix[]='
      }
      urlprms += item;
   });
   $.ajax({
      url: base_url+'Ajax_add_more/uf_phistory_add_more/'+id+''+urlprms,
      cache: false,
      type: "POST",
      data: {'mtype' : type,'id' : 1 , 'suffix' : suffix  , 'inqid' : encid},
      dataType: "json",
      success: function(result){
         for (inc = 0; inc < result.no_of_result; inc++) {
            if(id == 0)
            {
               $('#'+result.result[inc].ajax_main_id+'').html(result.result[inc].string);
               var hidid = parseInt($('#'+result.result[inc].hidinputid).val());
               $('#'+result.result[inc].hidinputid).val(hidid);
            }else{
               $('#'+result.result[inc].ajax_addmore_id+'').append(result.result[inc].string);
               var hidid = parseInt($('#'+result.result[inc].hidinputid).val()) + 1;
               $('#'+result.result[inc].hidinputid).val(hidid);
            }
         }
        $( ".date-picker" ).datepicker("refresh");
        $('.bs-select').selectpicker('refresh');
      }
   });
}

function whistry_call(id,type,suffix,encid)
{
   suffix = $.parseJSON(suffix);
   var urlprms = '';
   $.each(suffix, function(i, item) {
      if(i == 0)
      {
         urlprms += '?suffix[]='
      }else{
         urlprms += '&suffix[]='
      }
      urlprms += item;
   });
   $.ajax({
      url: base_url+'Ajax_add_more/uf_whist_add_more/'+id+''+urlprms,
      cache: false,
      type: "POST",
      data: {'mtype' : type,'id' : 1 , 'suffix' : suffix  , 'inqid' : encid},
      dataType: "json",
      success: function(result){
         for (inc = 0; inc < result.no_of_result; inc++) {
            if(id == 0)
            {
               $('#'+result.result[inc].ajax_main_id+'').html(result.result[inc].string);
               var hidid = parseInt($('#'+result.result[inc].hidinputid).val());
               $('#'+result.result[inc].hidinputid).val(hidid);
            }else{
               $('#'+result.result[inc].ajax_addmore_id+'').append(result.result[inc].string);
               var hidid = parseInt($('#'+result.result[inc].hidinputid).val()) + 1;
               $('#'+result.result[inc].hidinputid).val(hidid);
            }
         }
        $( ".date-picker" ).datepicker("refresh");
        $('.bs-select').selectpicker('refresh');
      }
   });
}

function lang_call(id,type,suffix,encid)
{
   suffix = $.parseJSON(suffix);
   var urlprms = '';
   $.each(suffix, function(i, item) {
      if(i == 0)
      {
         urlprms += '?suffix[]='
      }else{
         urlprms += '&suffix[]='
      }
      urlprms += item;
   });
   $.ajax({
      url: base_url+'Ajax_add_more/uf_language_add_more/'+id+''+urlprms,
      cache: false,
      type: "POST",
      data: {'mtype' : type,'id' : 1 , 'suffix' : suffix  , 'inqid' : encid},
      dataType: "json",
      success: function(result){
         for (inc = 0; inc < result.no_of_result; inc++) {
            if(id == 0)
            {
               $('#'+result.result[inc].ajax_main_id+'').html(result.result[inc].string);
               var hidid = parseInt($('#'+result.result[inc].hidinputid).val());
               $('#'+result.result[inc].hidinputid).val(hidid);
            }else{
               $('#'+result.result[inc].ajax_addmore_id+'').append(result.result[inc].string);
               var hidid = parseInt($('#'+result.result[inc].hidinputid).val()) + 1;
               $('#'+result.result[inc].hidinputid).val(hidid);
            }
         }
        $( ".date-picker" ).datepicker("refresh");
        $('.bs-select').selectpicker('refresh');
      }
   });
}

function edu_call(id,type,suffix,encid)
{
   suffix = $.parseJSON(suffix);
   var urlprms = '';
   $.each(suffix, function(i, item) {
      if(i == 0)
      {
         urlprms += '?suffix[]='
      }else{
         urlprms += '&suffix[]='
      }
      urlprms += item;
   });
   $.ajax({
      url: base_url+'Ajax_add_more/uf_education_add_more/'+id+''+urlprms,
      cache: false,
      type: "POST",
      data: {'mtype' : type,'id' : 1 , 'suffix' : suffix , 'inqid' : encid},
      dataType: "json",
      success: function(result){
         for (inc = 0; inc < result.no_of_result; inc++) {
            if(id == 0)
            {
               $('#'+result.result[inc].ajax_main_id+'').html(result.result[inc].string);
               var hidid = parseInt($('#'+result.result[inc].hidinputid).val());
               $('#'+result.result[inc].hidinputid).val(hidid);
            }else{
               $('#'+result.result[inc].ajax_addmore_id+'').append(result.result[inc].string);
               var hidid = parseInt($('#'+result.result[inc].hidinputid).val()) + 1;
               $('#'+result.result[inc].hidinputid).val(hidid);
            }
         }
        $( ".date-picker" ).datepicker("refresh");
        $('.bs-select').selectpicker('refresh');
      }
   });
}

function add1_call(id,type,suffix,encid)
{
   suffix = $.parseJSON(suffix);
   var urlprms = '';
   $.each(suffix, function(i, item) {
      if(i == 0)
      {
         urlprms += '?suffix[]='
      }else{
         urlprms += '&suffix[]='
      }
      urlprms += item;
   });
   $.ajax({
      url: base_url+'Ajax_add_more/bd_address_add_more/'+id+''+urlprms,
      cache: false,
      type: "POST",
      data: {'mtype' : type,'id' : 1 , 'suffix' : suffix , 'inqid' : encid},
      dataType: "json",
      success: function(result){
         for (inc = 0; inc < result.no_of_result; inc++) {
            if(id == 0)
            {
               $('#'+result.result[inc].ajax_main_id+'').html(result.result[inc].string);
               var hidid = parseInt($('#'+result.result[inc].hidinputid).val());
               $('#'+result.result[inc].hidinputid).val(hidid);
            }else{
               $('#'+result.result[inc].ajax_addmore_id+'').append(result.result[inc].string);
               var hidid = parseInt($('#'+result.result[inc].hidinputid).val()) + 1;
               $('#'+result.result[inc].hidinputid).val(hidid);
            }
         }
        $( ".date-picker" ).datepicker("refresh");
        $('.bs-select').selectpicker('refresh');
      }
   });
}
   
			$('.date-picker').datepicker({
					format: 'dd-mm-yyyy',
				});

				
function getAge(d1, d2){  
    d2 = d2 || new Date();
    var diff = d2.getTime() - d1.getTime();
    return Math.floor(diff / (1000 * 60 * 60 * 24 * 365.25));
}
console.log( getAge(new Date(1991, 11, 13)) );

function showDiv(elem){
   if(elem.value == 1)
   {
      document.getElementById('spouse_detailsall').style.display = "none";
   }
   else
   {
	   document.getElementById('spouse_detailsall').style.display = "";
   }
	  
}

$(document).ready(function () {
                    $(document).on('change', '#fam_pmarital', function() {
                  //alert('dsdsadsdsadsa');
                  var orival = $(this).val();
                  //alert(orival);
                  if(orival == 1){
                     $('#hide_pm_dt').hide('fast');
                  }else{
                      $('#hide_pm_dt').show('fast');
                  }
                       
                });
               
               });

$(document).ready(function () {
                    $('#oi_mou_b').click(function () {
                  //alert('dsdsadsdsadsa');
                       $('#hide_mou_dt').hide('fast');
                });
                $('#oi_mou_a').click(function () {
                      $('#hide_mou_dt').show('fast');
                 });
               });
//*******************************************************mou
$(document).ready(function () {
                    $('#oi_hun_b').click(function () {
                  //alert('dsdsadsdsadsa');
                       $('#hide_hun_dt').hide('fast');
                });
                $('#oi_hun_a').click(function () {
                      $('#hide_hun_dt').show('fast');
                 });
               });
//*******************************************************hun
$(document).ready(function () {
                    $('#oi_nodue_b').click(function () {
                  //alert('dsdsadsdsadsa');
                       $('#hide_nodue_dt').hide('fast');
                });
                $('#oi_nodue_a').click(function () {
                      $('#hide_nodue_dt').show('fast');
                 });
               });
//*******************************************************nodue
$(document).ready(function () {
                    $('#inq_refno').click(function () {
						//alert('dsdsadsdsadsa');
                       $('#reference_name').hide('fast');
                       $('#reference_no').hide('fast');
                });
                $('#inq_ref').click(function () {
                      $('#reference_name').show('fast');
                      $('#reference_no').show('fast');
                 });
               });

$(document).ready(function () {
                    $('#mrd_once_b').click(function () {
                  //alert('dsdsadsdsadsa');
                       $('#hide_mto_dt').hide('fast');
                });
                $('#mrd_once_a').click(function () {
                      $('#hide_mto_dt').show('fast');
                 });
               });

$(document).ready(function () {
                    $('#spo_pmarried_b').click(function () {
                  //alert('dsdsadsdsadsa');
                       $('#spo_dmarriage_hide').hide('fast');
                });
                $('#spo_pmarried_a').click(function () {
                      $('#spo_dmarriage_hide').show('fast');
                 });
               });
//************************************************spouse

function savestatus(id)
{ 
   $('#me').val(id);
   $('#inquiry_form').submit();
}

$(document).ready(function () {
				$('#basic_detials').click(function () {
					//alert('dsdsadsdsadsa');
				  $('#mytabs a[href="#tab_1_1_3"]').tab('show');
				});
				$('#family_back').click(function () {
				  $('#mytabs a[href="#tab_1_1_2"]').tab('show');
				});
				$('#family_con').click(function () {
				  $('#mytabs a[href="#tab_1_1_4"]').tab('show');
				});
				$('#edu_back').click(function () {
				  $('#mytabs a[href="#tab_1_1_3"]').tab('show');
				});
				$('#edu_con').click(function () {
				  $('#mytabs a[href="#tab_1_1_5"]').tab('show');
				});
				$('#spouse_back').click(function () {
				  $('#mytabs a[href="#tab_1_1_4"]').tab('show');
				});
				$('#spouse_con').click(function () {
				  $('#mytabs a[href="#tab_1_1_6"]').tab('show');
				});
				$('#child_back').click(function () {
				  $('#mytabs a[href="#tab_1_1_5"]').tab('show');
				});
				$('#child_con').click(function () {
				  $('#mytabs a[href="#tab_1_1_7"]').tab('show');
				});
				$('#immi_back').click(function () {
				  $('#mytabs a[href="#tab_1_1_6"]').tab('show');
				});
				$('#immi_con').click(function () {
				  $('#mytabs a[href="#tab_1_1_8"]').tab('show');
				});
				$('#staff_back').click(function () {
				  $('#mytabs a[href="#tab_1_1_7"]').tab('show');
				});
				$('#staff_con').click(function () {
				  $('#mytabs a[href="#tab_1_1_9"]').tab('show');
				});
				$('#status_back').click(function () {
				  $('#mytabs a[href="#tab_1_1_8"]').tab('show');
				});
				$('#status_con').click(function () {
				  $('#mytabs a[href="#tab_1_1_10"]').tab('show');
				});
				$('#other_back').click(function () {
				  $('#mytabs a[href="#tab_1_1_9"]').tab('show');
				});				

       
});

   $(document).on('change', '.country', function() {
          if($(this).attr('id') != '' && $(this).attr('id') != undefined)
          {
            var oriid = $(this).attr('id');
            var orival = $(this).val();
            var res = oriid.split('add1_country');
            $.ajax({
                        type:'POST',
                        datatype: 'HTML',
                        url:base_url+"Ajax_add_more/get_state",
                        data:'country_id='+orival,
                        success: function(data) {
                          $('#'+res[0]+'add1_state'+res[1]).empty().append(data);
                          $('#'+res[0]+'add1_city'+res[1]).empty();
                          $('#'+res[0]+'add1_area'+res[1]).empty();
                          $('.bs-select').selectpicker('refresh');
                        }
                        });
          }
        });

         $(document).on('change', '.country', function() {
          if($(this).attr('id') != '' && $(this).attr('id') != undefined)
          {
            var oriid = $(this).attr('id');
            var orival = $(this).val();
            var res = oriid.split('add1_country');
            $.ajax({
                        type:'POST',
                        datatype: 'HTML',
                        url:base_url+"Ajax_add_more/get_ctocity",
                        data:'country_id='+orival,
                        success: function(data) {
                          $('#'+res[0]+'add1_city'+res[1]).empty().append(data);
                          $('.bs-select').selectpicker('refresh');
                        }
                        });
          }
        });

        $(document).on('change', '.state', function() {
          if($(this).attr('id') != '' && $(this).attr('id') != undefined)
          {
            var oriid = $(this).attr('id');
            var orival = $(this).val();
            var res = oriid.split('add1_state');
            var country_id = $('#'+res[0]+'add1_country'+res[1]).val();
            $.ajax({
                        type:'POST',
                        datatype: 'HTML',
                        url:base_url+"Ajax_add_more/get_city",
                        data:{'state_id' : orival,'country_id' : country_id},
                        success: function(data) {
                          $('#'+res[0]+'add1_city'+res[1]).empty().append(data);
                          $('#'+res[0]+'add1_area'+res[1]).empty();
                          $('.bs-select').selectpicker('refresh');
                        }
                        });
          }
        });

        $(document).on('change', '.city', function() {
          if($(this).attr('id') != '' && $(this).attr('id') != undefined)
          {
            var oriid = $(this).attr('id');
            var orival = $(this).val();
            var res = oriid.split('add1_city');
            var country_id = $('#'+res[0]+'add1_country'+res[1]).val();
            var state_id = $('#'+res[0]+'add1_state'+res[1]).val();
            $.ajax({
                        type:'POST',
                        datatype: 'HTML',
                        url:base_url+"Ajax_add_more/get_area",
                        data:{'state_id' : state_id,'country_id' : country_id,'city_id' : orival},
                        success: function(data) {
                          $('#'+res[0]+'add1_area'+res[1]).empty().append(data);
                          $('.bs-select').selectpicker('refresh');
                        }
                        });
          }
        });

        $(document).ready(function () {
                $('#product_visa').change(function () {
                        var prdID = $(this).val();
                       // alert(prdID);
                        if(prdID){
                        $.ajax({
                        type:'POST',
                        datatype: 'JSON',
                        url:base_url+"user/get_ptype",
                        data:'prod_id='+prdID,
                        success: function(data) {
                          $('#pro_type_visa').empty();
                            var opts = $.parseJSON(data);
                        //alert(data.cus_addrs);
                            $.each(opts, function(i, d){
                              $('#pro_type_visa').append('<option value="'+ d.prot_id +'">'+ d.prot_name +'</option>');
                              $('.bs-select').selectpicker('refresh');
                            });   
                        }
                        });
                    }
                });
               });

               // $('#pro_type').change(function () {
               //          var type_id = $(this).val();
               //          //alert(type_id);
               //          //var prdID = $('.product').val();
               //          if(type_id){
               //          $.ajax({
               //          type:'POST',
               //          datatype: 'JSON',
               //          url:base_url+"User/get_pcate",
               //          data:'type_id='+type_id,
               //          success: function(data) {
               //            $('#pro_category').empty();
               //              var opts = $.parseJSON(data);
               //          //alert(data.cus_addrs);
               //              $.each(opts, function(i, d){
               //                $('#pro_category').append('<option value="'+ d.procat_id +'">'+ d.procat_name +'</option>');
               //                $('.bs-select').selectpicker('refresh');
               //              });   
               //          }
               //          });
               //      }
               //  });

            

            $('#immi_type').change(function () {
                        var type_id = $(this).val();
                        //alert(type_id);
                        //var prdID = $('.product').val();
                        if(type_id){
                        $.ajax({
                        type:'POST',
                        datatype: 'JSON',
                        url:base_url+"User/get_pcate",
                        data:'type_id='+type_id,
                        success: function(data) {
                          $('#immi_category').empty();
                            var opts = $.parseJSON(data);
                        //alert(data.cus_addrs);
                            $.each(opts, function(i, d){
                              $('#immi_category').append('<option value="'+ d.procat_id +'">'+ d.procat_name +'</option>');
                              $('#immi_category').selectpicker('refresh');
                            });   
                        }
                        });
                    }
                });

            

function getAge(dateString) {
  var now = new Date();
  var today = new Date(now.getYear(),now.getMonth(),now.getDate());

  var yearNow = now.getYear();
  var monthNow = now.getMonth();
  var dateNow = now.getDate();

  var dob = new Date(dateString.toString().substring(6,10),
                     dateString.toString().substring(0,2)-1,                   
                     dateString.toString().substring(3,5)                  
                     );

  var yearDob = dob.getYear();
  var monthDob = dob.getMonth();
  var dateDob = dob.getDate();
  var age = {};
  var ageString = "";
  var yearString = "";
  var monthString = "";
  var dayString = "";


  yearAge = yearNow - yearDob;

  if (monthNow >= monthDob)
    var monthAge = monthNow - monthDob;
  else {
    yearAge--;
    var monthAge = 12 + monthNow -monthDob;
  }

  if (dateNow >= dateDob)
    var dateAge = dateNow - dateDob;
  else {
    monthAge--;
    var dateAge = 31 + dateNow - dateDob;

    if (monthAge < 0) {
      monthAge = 11;
      yearAge--;
    }
  }

  age = {
      years: yearAge,
      months: monthAge,
      days: dateAge
      };

  if ( age.years > 1 ) yearString = " years";
  else yearString = " year";
  if ( age.months> 1 ) monthString = " months";
  else monthString = " month";
  if ( age.days > 1 ) dayString = " days";
  else dayString = " day";


  if ( (age.years > 0) && (age.months > 0) && (age.days > 0) )
    ageString = age.years + yearString + ", " + age.months + monthString + ", and " + age.days + dayString + " old.";
  else if ( (age.years == 0) && (age.months == 0) && (age.days > 0) )
    ageString = "Only " + age.days + dayString + " old!";
  else if ( (age.years > 0) && (age.months == 0) && (age.days == 0) )
    ageString = age.years + yearString + " old. Happy Birthday!!";
  else if ( (age.years > 0) && (age.months > 0) && (age.days == 0) )
    ageString = age.years + yearString + " and " + age.months + monthString + " old.";
  else if ( (age.years == 0) && (age.months > 0) && (age.days > 0) )
    ageString = age.months + monthString + " and " + age.days + dayString + " old.";
  else if ( (age.years > 0) && (age.months == 0) && (age.days > 0) )
    ageString = age.years + yearString + " and " + age.days + dayString + " old.";
  else if ( (age.years == 0) && (age.months > 0) && (age.days == 0) )
    ageString = age.months + monthString + " old.";
  else ageString = "Oops! Could not calculate age!";

  return ageString;
}

function n_convert(n){
    return n > 9 ? "" + n: "0" + n;
}

var result = $('#dobdays :selected').val();
//alert(result);
   var day = n_convert($('#dobdays :selected').val());
  //alert('day');
  var months = n_convert($('#dobmonths :selected').val());
  var years = $('#dobyears :selected').val();
  //alert(years);
  var age = getAge(''+months+'/'+day+'/'+years+'');
  if(age == 'Oops! Could not calculate age!')
  {
    age = '';
  }
  $('#inq_age').val(age);

$(document).on('change', '.dobchange', function(){
  var day = n_convert($('#dobdays').val());
  //alert('day');
  var months = n_convert($('#dobmonths').val());
  var years = $('#dobyears').val();
  var age = getAge(''+months+'/'+day+'/'+years+'');
  if(age == 'Oops! Could not calculate age!')
  {
    age = '';
  }
  $('#inq_age').val(age);
});
	
$(document).on('change', '.spo_dobchange', function(){
	//alert('dfdsfds');
  var day = n_convert($('#spo_dobdays').val());
  var months = n_convert($('#spo_dobmonths').val());
  var years = $('#spo_dobyears').val();
  var age = getAge(''+months+'/'+day+'/'+years+'');
  if(age == 'Oops! Could not calculate age!')
  {
    age = '';
  }
  $('#spo_age').val(age);
});
   
