$(window).load(function() {
  pa_billaddrs_call(0,paction,suffix,encid);
  pa_shipaddrs_call(0,paction,suffix,encid);
  pa_contact_add(0,paction,suffix,encid);
   $(".loader").hide().delay(5000);
});
//
//
$( document ).ready(function() {
    //$(".loader").fadeout("slow");
   $(document).on('click', '.ajaxaddmorebtn', function(){
      var res = ($(this).attr('id')).split('addrsaddid');
      if($(this).attr('id') == res[0]+'addrsaddid')
      {
         var hidid = parseInt($('#'+res[0]+'addrshid').val()) + 1;
         pa_billaddrs_call(hidid,'add','["'+res[0]+'"]',encid);
      }
      var res = ($(this).attr('id')).split('addrshipaddid');
      if($(this).attr('id') == res[0]+'addrshipaddid')
      {
         var hidid = parseInt($('#'+res[0]+'addrshiphid').val()) + 1;
         pa_shipaddrs_call(hidid,'add','["'+res[0]+'"]',encid);
      }
	    var res = ($(this).attr('id')).split('contactid');
      if($(this).attr('id') == res[0]+'contactid')
      {
         var hidid = parseInt($('#'+res[0]+'contacthid').val()) + 1;
         pa_contact_add(hidid,'add','["'+res[0]+'"]',encid);
      }
      
   });
});



function pa_billaddrs_call(id,type,suffix,encid)
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
      url: base_url+'Ajax_add_more/party_billaddr_more/'+id+''+urlprms,
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
        //  $( ".date-picker" ).datepicker("refresh");
        $('.bs-select').selectpicker('refresh');
        return true;
      }
   });
}

function pa_shipaddrs_call(id,type,suffix,encid)
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
      url: base_url+'Ajax_add_more/party_shipaddr_more/'+id+''+urlprms,
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
        //  $( ".date-picker" ).datepicker("refresh");
        $('.bs-select').selectpicker('refresh');
        return true;
      }
   });
}

function pa_contact_add(id,type,suffix,encid)
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
      url: base_url+'Ajax_add_more/party_contact_add_more/'+id+''+urlprms,
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
        //  $( ".date-picker" ).datepicker("refresh");
        $('.bs-select').selectpicker('refresh');
        return true;
      }
   });
}



 $(document).ready(function () {
                $('#product').change(function () {
                        var prdID = $(this).val();
                        //alert(prdID);
                        if(prdID){
                        $.ajax({
                        type:'POST',
                        datatype: 'JSON',
                        url:base_url+"Inquiry/get_ptype",
                        data:'prod_id='+prdID,
                        success: function(data) {
                          $('#pro_type').empty();
                            var opts = $.parseJSON(data);
                        //alert(data.cus_addrs);
                            $.each(opts, function(i, d){
                              $('#pro_type').append('<option value="'+ d.prot_id +'">'+ d.prot_name +'</option>');
                              $('.bs-select').selectpicker('refresh');
                            });   
                        }
                        });
                    }
                });

               $('#pro_type').change(function () {
                  //alert('hieeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee');
                        var type_id = $(this).val();
                        //alert(type_id);
                        var prdID = $('#product').val();
                        //alert(prdID);
                        if(type_id){
                        $.ajax({
                        type:'POST',
                        datatype: 'JSON',
                        url:base_url+"Inquiry/get_pcate",
                        data:{'type_id' : type_id,'prdID' : prdID },
                        success: function(data) {
                          $('#pro_category').empty();
                            var opts = $.parseJSON(data);
                        //alert(data.cus_addrs);
                            $.each(opts, function(i, d){
                              $('#pro_category').append('<option value="'+ d.procat_id +'">'+ d.procat_name +'</option>');
                              $('.bs-select').selectpicker('refresh');
                            });   
                        }
                        });
                    }
                });

            });

            $('#product_type').change(function () {
               //alert('hieeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee');
                        var type_id = $(this).val();
                        //alert(type_id);
                        if(type_id){
                        $.ajax({
                        type:'POST',
                        datatype: 'JSON',
                        url:base_url+"Inquiry/get_prcate",
                        data:'type_id='+type_id,
                        success: function(data) {
                          $('#Product_Category').empty();
                            var opts = $.parseJSON(data);
                        //alert(data.cus_addrs);
                            $.each(opts, function(i, d){
                              $('#Product_Category').append('<option value="'+ d.procat_id +'">'+ d.procat_name +'</option>');
                              $('.bs-select').selectpicker('refresh');
                            });   
                        }
                        });
                    }
                });

            
			

 $(document).ready(function () {
                $('#inq_source').change(function () {
                        var srcID = $(this).val();
                        //alert(prdID);
                        if(srcID){
                        $.ajax({
                        type:'POST',
                        datatype: 'JSON',
                        url:base_url+"Inquiry/get_srctype",
                        data:'src_id='+srcID,
                        success: function(data) {
                          $('#inq_ssource').empty();
                            var opts = $.parseJSON(data);
                        //alert(data.cus_addrs);
                        
                    $.each(opts, function(i, d){
                            $('#inq_ssource').append('<option value="'+ d.source_cat_id +'">'+ d.source_cat_name +'</option>');
							 $('#inq_ssource').selectpicker('refresh');  
                         }); 
                        
                        }
                        });
                    }
                })
            });

   $(document).ready(function () {
                $('#au_country').change(function () {
                        var srcID = $(this).val();
                        //alert(prdID);
                        if(srcID){
                        $.ajax({
                        type:'POST',
                        datatype: 'JSON',
                        url:base_url+"Inquiry/get_srctype",
                        data:'src_id='+srcID,
                        success: function(data) {
                          $('#inq_ssource').empty();
                            var opts = $.parseJSON(data);
                        //alert(data.cus_addrs);
                        
                    $.each(opts, function(i, d){
                            $('#inq_ssource').append('<option value="'+ d.source_main_cat +'">'+ d.source_cat_name +'</option>');
                         }); 
                         $('.bs-select').selectpicker('refresh');  
                        }
                        });
                    }
                })
            });

			$('.date-picker').datepicker({
					format: 'dd-mm-yyyy',
				});
$(document).ready(function () {
                $('#inq_dbirth').change(function () {
					 var datee = $(this).val();
					 var res = datee.split('-');
					 var year = res[2];//datee.getFullYear();
					 var month = res[1];//datee.getMonth();
					 var day = res[0];//datee.getDate();
					 $('#inq_age').val(getAge(new Date(year, month, day)));
					})
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


function savestatus(id)
{ 
   $('#me').val(id);
   $('#inquiry_form').submit();
}

$(document).ready(function () {
				$('#continue-btn').click(function () {
					//alert('dsdsadsdsadsa');
				   $('#mytabs a[href="#tab_1_1_2"]').tab('show');
				});
                $('#continue_basic').click(function () {
                      $('#mytabs a[href="#tab_1_1_3"]').tab('show');
                 });
			  $('#continue_basic_back').click(function () {
				  $('#mytabs a[href="#tab_1_1_1"]').tab('show');
			 	});
				$('#continue_applicant_back').click(function () {
				  $('#mytabs a[href="#tab_1_1_2"]').tab('show');
			 	});
				$('#continue_applicant').click(function () {
				  $('#mytabs a[href="#tab_1_1_4"]').tab('show');
			 	});
				$('#continue_spouse_back').click(function () {
				  $('#mytabs a[href="#tab_1_1_3"]').tab('show');
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

        $(document).on('change', '.area', function() {
          if($(this).attr('id') != '' && $(this).attr('id') != undefined)
          {
            var oriid = $(this).attr('id');
            var orival = $(this).val();
            var res = oriid.split('add1_area');
            var country_id = $('#'+res[0]+'add1_country'+res[1]).val();
            var state_id = $('#'+res[0]+'add1_state'+res[1]).val();
            var city_id = $('#'+res[0]+'add1_city'+res[1]).val();
            $.ajax({
                        type:'POST',
                        datatype: 'HTML',
                        url:base_url+"Ajax_add_more/get_pincode",
                        data:{'state_id' : state_id,'country_id' : country_id,'city_id' : city_id,'area_id' : orival},
                        success: function(data) {
                          $('#'+res[0]+'add1_pin'+res[1]).empty().append(data);
                          $('.bs-select').selectpicker('refresh');
                        }
                        });
          }
        });
});
// function days()
// {
// 	alert('dfdf');
//     var a = document.getElementById('eee').getDate.value;
//     var b = document.getElementById('eee').getMonth.value;
//     var c = document.getElementById('eee').getFullYear.value;

//     //var aa= document.getElementById('eee').(this).('getDate').value;
//     var e= y - c;
//     {
//       document.write("Ans="+e);
//     }
// alret(e);
// }

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


$(document).on('change', '.dobchange', function(){
  var day = n_convert($('#dobdays').val());
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
