//
$(window).load(function() {
   achiev_call(0,paction,suffix,encid);
});
//
//
$( document ).ready(function() {
   $(document).on('click', '.ajaxaddmorebtn', function(){
      var res = ($(this).attr('id')).split('achievementaddid');
      if($(this).attr('id') == res[0]+'achievementaddid')
      {
         var hidid = parseInt($('#'+res[0]+'achievementhid').val()) + 1;
         achiev_call(hidid,'add','["'+res[0]+'"]',encid);
      }
   });
});

function achiev_call(id,type,suffix,encid)
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
      url: base_url+'Ajax_add_more/achievement_add_more/'+id+''+urlprms,
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
        // $( ".date-picker" ).datepicker("refresh");
        // $('.bs-select').selectpicker('refresh');
      }
   });
}
   $(document).ready(function () {
                $('#au_country').change(function () {
                        var srcID = $(this).val();
                        //alert(srcID);
                        if(srcID){
                        $.ajax({
                        type:'POST',
                        datatype: 'JSON',
                        url:base_url+"Admin_users/get_states",
                        data:'country_id='+srcID,
                        success: function(data) {
                          $('#au_state').empty();
                            var opts = $.parseJSON(data);
                        //alert(data.cus_addrs);
                        
                    $.each(opts, function(i, d){
                            $('#au_state').append('<option value="'+ d.state_id +'">'+ d.state_name +'</option>');
                         }); 
                         $('.bs-select').selectpicker('refresh');  
                        }
                        });
                    }
                })
            });
			
			$(document).ready(function () {
                $('#au_state').change(function () {
                        var srcID = $(this).val();
                        //alert(srcID);
                        if(srcID){
                        $.ajax({
                        type:'POST',
                        datatype: 'JSON',
                        url:base_url+"Admin_users/get_cities",
                        data:'state_id='+srcID,
                        success: function(data) {
                          $('#au_city').empty();
                            var opts = $.parseJSON(data);
                        //alert(data.cus_addrs);
                        
                    $.each(opts, function(i, d){
                            $('#au_city').append('<option value="'+ d.city_id +'">'+ d.city_name +'</option>');
                         }); 
                         $('.bs-select').selectpicker('refresh');  
                        }
                        });
                    }else{
						  $('#au_city').append('<option value=""> Select states </option>');
					}
                })
            });

$(document).ready(function () {
                $('#au_city').change(function () {
                        var srcID = $(this).val();
                        //alert(srcID);
                        if(srcID){
                        $.ajax({
                        type:'POST',
                        datatype: 'JSON',
                        url:base_url+"Admin_users/get_areas",
                        data:'city_id='+srcID,
                        success: function(data) {
                          $('#au_area').empty();
                            var opts = $.parseJSON(data);
                        //alert(data.cus_addrs);
                        
                    $.each(opts, function(i, d){
                            $('#au_area').append('<option value="'+ d.area_id +'">'+ d.area_name +'</option>');
                         }); 
                         $('.bs-select').selectpicker('refresh');  
                        }
                        });
                    }else{
              $('#au_area').append('<option value=""> Select states </option>');
          }
                })
            });

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
				$('#btn_continues').click(function () {
					//alert('dsdsadsdsadsa');
				   $('#mytabs a[href="#tab_1_1_2"]').tab('show');
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
       
});