/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
// Dropdown menu is closed & opened using this function.

$(document).ready(function()
  {
      //var id = $('.accordion-id').attr('id');
      $('#topcontent-1, #top-1, #top-2, #topcontent-2').accordion({
            heightStyle : "content",
            collapsible : true,
            active      : false
        });
    });
$(document).ready(function()
  {
      //var id = $('.accordion-id').attr('id');
      $('#about-us, #paid_dash, #free_dash, #dashboard_free, #ques_accordion').accordion({
            heightStyle : "content",
            collapsible : true
        });
    });

/*     
 *     var location = window.location.protocol + "//" + window.location.host;
*/
$(function() 
{
   var result       = "";
   $( "#lagna_pob" ).add("#pob_profile").autocomplete({
      source: 
       function(request, response) {
        $.ajax({
          url: "ajaxcalls/autocomplete.php",
          dataType: "json",
          data: {
            term: request.term
          },
          success: function( data ) {
          response(data);
          
          }
        
        });
      },
      minLength: 3,
      select: function(request, response)
      {
            var lat           = response.item.lat;
            var lon           = response.item.lon;
            var tmz           = response.item.tmz;
            var lat_dir       = lat.substring(0,1);
            var lat_deg       = lat.split(".")[0];
            var lat_min       = lat.split(".")[1].substr(0,2);
            var lon_dir       = lon.substring(0,1);
            var lon_deg       = lon.split(".")[0];
            var lon_min       = lon.split(".")[1].substr(0,2);
            document.getElementById("lagna_timezone").value = tmz;
            if(lon_dir == "-")
            {
                document.getElementById("lagna_long_direction").value = "W";
                document.getElementById("lagna_long_1").value = lon_deg.slice(1);
                document.getElementById("lagna_long_2").value = lon_min;
            }
            else
            {
                document.getElementById("lagna_long_direction").value = "E";
                document.getElementById("lagna_long_1").value = lon_deg;
                document.getElementById("lagna_long_2").value = lon_min;
            }
                
            if(lat_dir == "-")
            {
                document.getElementById("lagna_lat_direction").value = "S";
                document.getElementById("lagna_lat_1").value = lat_deg.slice(1);
                document.getElementById("lagna_lat_2").value = lat_min;
            }
            else
            {
                document.getElementById("lagna_lat_direction").value = "N";
                document.getElementById("lagna_lat_1").value = lat_deg;
                document.getElementById("lagna_lat_2").value = lat_min;
            }
      },
      open: function() {
        $('#lagna_pob').add("#pob_profile").removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
         $(".ui-autocomplete").css("z-index", 1000);
      },
      close: function() {
        $('#lagna_pob').add("#pob_profile").removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
      }   
    });
});
 /*success: function(data) {
           
            
            alert(result);
          }*/

 $(function() {
    $( "#oppos-rashi" ).accordion({
      heightStyle: "content",
      collapsible: true
    });
  });
  
  $(document).ready(function()
  {
      var id = $('.accordion-id').attr('id');
      $('#accordion-'+id).accordion({
            heightStyle: "content",
            collapsible: true,
            active : false
        });
    });
 $(document).ready(function()
  {
      var id = $('.lagna_find').attr('id');
      $('#accordion-'+id).accordion({
            heightStyle: "content",
            collapsible: true,
            active      : false
        });
    });
    
$(function() 
{

   var result       = "";
   $("#ques_pob").autocomplete({
      source: 
       function(request, response) {
        $.ajax({
          url: "ajaxcalls/autocomplete.php",
          dataType: "json",
          data: {
            term: request.term
          },
          success: function( data ) {
          response(data);
          
          }
        
        });
      },
      minLength: 3,
     
      open: function() {
        $('#ques_pob').removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
         $(".ui-autocomplete").css("z-index", 1000);
      },
      close: function() {
        $('#ques_pob').removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
      }
   })
   
});
$(function() 
{
   var result       = "";
   $("#astro_city").autocomplete({
      source: 
       function(request, response) {
        $.ajax({
          url: "ajaxcalls/autocomplete1.php",
          dataType: "json",
          data: {
            term: request.term
          },
          success: function( data ) {
          response(data);
          
          }
        });
      },
      minLength: 3,
      select: function(request, response)
      {
            var state           = response.item.state;
            var country         = response.item.country;
            document.getElementById("astro_state").value    = state;
            document.getElementById("astro_country").value  = country;
      },
      open: function() {
        $('#astro_city').removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
         $(".ui-autocomplete").css("z-index", 1000);
      },
      close: function() {
        $('#astro_city').removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
      }   
    });
});
$(function() {
$( "#ques_dob" ).datepicker({yearRange: "1900:2050",changeMonth: true,
  changeYear: true, dateFormat: "yy-mm-dd"});
});

function addSubscriptionFees()
{
  var newamount;
  if(document.getElementById("yearly_subscribe").checked == true)
    {
        newamount         = parseFloat(document.getElementById("pay_amount").value)+parseFloat(document.getElementById("pay_subscribe").value);
        document.getElementById("amount_label").innerHTML       = parseFloat(newamount).toFixed(2)+" "+
        document.getElementById("pay_currccode").value+" ("+document.getElementById("pay_currency").value+"-"+document.getElementById("pay_currfull").value+")";  
    }
    else
    {
        document.getElementById("amount_label").innerHTML       = document.getElementById("pay_amount").value+" "+
        document.getElementById("pay_currccode").value+" ("+document.getElementById("pay_currency").value+"-"+document.getElementById("pay_currfull").value+")"; 
   }
  
}
function changefees()
{
    var fees            = document.getElementById("expert_fees").value;
    var no_of_ques      = document.getElementById("max_ques").value;
    var curr_code       = document.getElementById("expert_curr_code").value;
    var currency        = document.getElementById("expert_currency").value;
    var curr_full       = document.getElementById("expert_curr_full").value;
    var new_fees        = parseFloat(fees)*parseFloat(no_of_ques);
    document.getElementById("fees_id").innerHTML    = new_fees+"<html>&nbsp;</html>"+curr_code+"("+currency+"-"+curr_full+")"
    document.getElementById("expert_final_fees").value    = new_fees.toFixed(2);
}