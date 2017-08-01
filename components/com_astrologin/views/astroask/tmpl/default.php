<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
//include_once "/home/astroxou/php/Net/GeoIP.php";
//$geoip                  = Net_GeoIP::getInstance("/home/astroxou/php/Net/GeoLiteCity.dat");
$ip                         = '117.196.1.11';
//$ip                         = '157.55.39.123';  // ip address
//$ip                       = $_SERVER['REMOTE_ADDR'];        // uncomment this ip on server

//$info                       = geoip_country_code_by_name($ip);
//$country                    = geoip_country_name_by_name($ip);
$location                 = $geoip->lookupLocation($ip);
$info                     = $location->countryCode;
$country                  = $location->countryName;
//print_r($this->msg);exit;
?>
<style type="text/css">#info_expert,#choose_ques,#order_type,#fees_type,#pay_id,#btn_grp,#ajax_load{ display: none; }</style>
<div id="ajax_load"><img src="<?php echo JUri::base(); ?>images/ajaxloader.gif" title="Loading... Please Wait" /><h3>Data Loading. Please Wait a Moment...</h3></div>
<div class='card card-outline-info text-center' id="info_expert">
<div class='card-block'>
<p><a title='Click to get more info' href='#' data-toggle='modal' data-target='#astroinfo'>Click For More Information</a></p>
<div class='modal fade' id='astroinfo' tabindex='-1' role='dialog' aria-hidden='true' aria-labelledby='astrolabel'>
<div class='modal-dialog' role='document'>
<div class='modal-content'>
    <div class='modal-header'><h5 class='modal-title' id='astrolabel'>Expert Info</h5>
    <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>
    <div class='modal-body' id="modal_body">
    </div>
<div class='modal-footer'>
    <button type='button' class='btn btn-secondary btn-danger' data-dismiss='modal'>Close</button></div>
</div></div></div>
</div></div>
<h3>Ask An Expert</h3>
<form name="ask_expert" method="post" enctype="application/x-www-form-urlencoded" action="<?php echo JRoute::_('?option=com_astrologin&task=astroask.askExpert') ?>">
<div class="form-group">
    <div id="expert_alert"></div>
<label for="select_expert">Choose Expert</label>
<select class="form-control" name="select_expert" id="select_expert" onchange="javascript:getExpertDetails('<?php echo $info; ?>');">
    <option value="default_select" selected>List Of Experts</option>
<?php
    foreach($this->msg as $data)
    {
?>
    <option value="<?php echo "expert_10".$data->id; ?>"><?php echo $data->name; ?></option>
<?php
    }
?>
</select>
</div>
<input type='hidden' name='expert_uname' id="expert_uname" />
<div class="form-group" id="choose_ques">
<label for="select_expert">Choose Number Of Questions</label>
<select class="form-control" name="expert_max_ques" id="select_ques" onchange="javascript:changefees2();"></select>
</div>
<div class="form-control" id="order_type"></div>
<input type="hidden" name="expert_fees" id="expert_fees"  />
<input type="hidden" name="expert_curr_code" id="expert_curr_code"  />
<input type="hidden" name="expert_currency" id="expert_currency"  />
<input type="hidden" name="expert_curr_full" id="expert_curr_full" />
<input type="hidden" name="expert_final_fees" id="expert_final_fees" />
<div class="mb-2"></div>
<div class="form-control" id="fees_type"><label>Fees:</label> <div id='fees_id'></div></div>
<div class="mb-2"></div>
<div class="form-control" id="pay_id">
    <label for='expert_choice' class='control-label'>Payment Type: </label>
    <div id="payment_type"></div>
</div>
<div class="mb-2"></div>
<div class="form-group" id="btn_grp">
    <button type="submit" name="expert_submit" id="ask_submit" class="btn btn-primary" >Next <i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
    <button type="reset" name="ask_reset" id="ask_reset" class="btn btn-danger">Reset</button>
</div>
</form>

