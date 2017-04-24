<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
//include_once "/home/astroxou/php/Net/GeoIP.php";
//$geoip                  = Net_GeoIP::getInstance("/home/astroxou/php/Net/GeoLiteCity.dat");
//$ip                         = '117.196.1.11';
$ip                         = '157.55.39.123';  // ip address
//$ip                       = $_SERVER['REMOTE_ADDR'];        // uncomment this ip on server

$info                       = geoip_country_code_by_name($ip);
$country                    = geoip_country_name_by_name($ip);
//$location                 = $geoip->lookupLocation($ip);
//$info                     = $location->countryCode;
//$country                  = $location->countryName;
//print_r($this->msg);exit;
?>
<style>#info_expert{visibility: hidden;}</style>
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
<form name="ask_expert" method="post" enctype="application/x-www-form-urlencoded" action="<?php echo JRoute::_('?option=com_astrologin&task=astroask.chooseExpert'); ?>">
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

<div class="form-group">
<label for="select_expert">Choose Number Of Questions</label>
<select class="form-control" name="select_ques" id="select_ques"></select>
</div>
<div class="form-control" id="order_type"></div>
<div class="mb-2"></div>
<div class="form-control"><label>Fees:</label> <div id='fees_id'></div></div>
<div class="mb-2"></div>
<div class="form-control">
    <label for='expert_choice' class='control-label'>Payment Type: </label>
    <div id="payment_type"></div>
</div>
<div class="mb-2"></div>
<div class="form-group">
    <button type="submit" name="ask_submit" class="btn btn-primary" onclick="checkValues();return false;">Next <i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
    <button type="reset" name="ask_reset" id="ask_reset" class="btn btn-danger">Reset</button>
</div>
</form>

