<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
function getIP() {
  foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
     if (array_key_exists($key, $_SERVER) === true) {
        foreach (explode(',', $_SERVER[$key]) as $ip) {
           if (filter_var($ip, FILTER_VALIDATE_IP) !== false) {
              return $ip;
           }
        }
     }
  }
    //$ip = '117.196.1.11';
  //$ip = '212.58.244.20';
  //$ip   = '223.223.146.119';
  //$ip   = '208.91.198.52';
 //$ip = '66.249.73.190';
  //$ip    = '176.102.49.192'; // uk ip
  //$ip = '122.175.21.127';
  //$ip = '157.55.39.123';
  return $ip;
}
   
$json = file_get_contents('http://getcitydetails.geobytes.com/GetCityDetails?fqcn='. getIP()); 
$data = json_decode($json);
if($data->geobytesinternet == 'IN')
{
?>
<h3>Payment and Refunds</h3>
<div class="mb-1"></div>
<div id="payments-accordion">
<h3>Authorization And Payment</h3>
<div>
          <p>&nbsp;&nbsp;Clients can place an Order for a Jyotishi(Vedic Astrology) based reading
              on <a href="http://www.astroisha.com/ask-question" target="_blank">Ask An Expert</a> Page. On submission of Question Form, client would be redirected to a third party Payment Gateway: <a href="http://www.ccavenue.com/" target="_blank" title="CCAvenue Home Page">CCAvenue</a>. There the client can pay using 
          one of the payment options provided to complete the Order. On successful completion of order a confirmation email would be provided 
          with Payment Details and Details Of Question/Questions. Clients are requested to keep the Confirmation Email until Order is Completed to avoid issues later.</p>
          <p>&nbsp;&nbsp;The money debited from Clients Bank Account is safe with Third Party Payment Gateway. Astro Isha does not 
          press for Remittance of Client Payment until the Client Query has been resolved.</p>
      </div>
    <h3>Order Cancellation And Refunds</h3>
<div>
          <p>&nbsp;&nbsp;If the Client has a change of mind and wishes to Cancel the Order he has 24 Working Hours to do so. Kindly notify us at <?php echo JHtml::_('email.cloak', 'admin@astroisha.com'); ?> 
              and also mention the token number or Unique Tracking ID or Bank Reference Number provided in the confirmation email. Astro Isha would Cancel the Order and money would be credited back to your account. 
              A confirmation of Cancellation of Order would be provided to Client. As money is still with Third Party Payment Gateway during this time it is 
              advised that the Client asks the concerned Payment Gateway about the duration of time before money is credited back into his/her account.
          </p>
          <p>&nbsp;&nbsp;After 24 Hours since order has been confirmed, Astro Isha reserves the right to proceed with the Order and Client Requests for Cancellation of Order 
          cannot be entertained.</p>
      </div>
  <h3>Order Processing and Confirmation</h3>
  <div>
          <p>&nbsp;&nbsp;After 24 Hours Astro Isha would start processing the Order. The client query would be provided with a logical answer 
          and the answer would be provided as attachment in the email. Astro Isha would only ask for Remittance of Payment once 
          the client query has been resolved with a logical answer.</p>
      </div>
   <h3>Order Failure and Refunds</h3>
   <div>
          <p>&nbsp;&nbsp;As mentioned earlier Astro Isha would only ask for Remittance once the Client is emailed 
          with Answer and Logical Solution to his Questions. This Order would likely be processed in 7-10 Working Days.</p>
          <p>&nbsp;&nbsp;In case there is a failure to give answer to clients query after 12 Days of Order Placement, the money is credited 
          directly back into the Account of Client.</p>
      </div>
 </div>
<?php
}
else
{
?>
<h3>Payment and Refunds</h3>
<div class="mb-1"></div>
<div id="payments-accordion1">
<h3>Authorization And Payments</h3>
<div>
          <p>&nbsp;&nbsp;Clients can place an Order on <a href="http://www.astroisha.com/ask-question" target="_blank">Ask An Expert</a> Page. On successful 
          completion of the Question Form, client would be redirected to <a href="http://www.paypal.com" targe="_blank" title="Paypal Home Page">Paypal</a> which is one of the most preferred and safe 
          payment gateway for International Transactions. There the client can pay using 
          one of the payment options provided by Paypal to complete the Order. On successful completion of order a confirmation email would be provided 
          with Payment Details and Question Details. Clients are requested to keep the Confirmation Email until Order is Completed to avoid issues later.</p>
          <p>&nbsp;&nbsp;The money debited from Clients Bank Account is safe with Paypal. Astro Isha does not 
          press for Remittance of Client Payment until the Client Query has been resolved.</p>
      </div>
<h3>Currencies Accepted</h3>
 <div>
          <table class="table table-condensed table-bordered">
              <tr>
              <th>Location</th>
              <th>Currency</th>
              <th>Symbol</th>
              </tr>
              <tr>
                  <td>United States</td>
                  <td>US Dollars</td>
                  <td>US &#36;</td>
              </tr>
              <tr>
                  <td>United Kingdom</td>
                  <td>British Sterling Pound</td>
                  <td>GBP &#8356;</td>
              </tr>
              <tr>
                  <td>Europe</td>
                  <td>Euro</td>
                  <td>&#8364;</td>
              </tr>
              <tr>
                  <td>Canada</td>
                  <td>Canadian Dollars</td>
                  <td>CAD &#36;</td>
              </tr>
              <tr>
                  <td>Australia</td>
                  <td>Australian Dollars</td>
                  <td>AUD &#36;</td>
              </tr>
              <tr>
                  <td>Singapore</td>
                  <td>Singapore Dollars</td>
                  <td>SGD &#36;</td>
              </tr>
              <tr>
                  <td>New Zealand</td>
                  <td>New Zealand Dollars</td>
                  <td>NZD &#36;</td>
              </tr>
              <tr>
                  <td>Rest Of The World</td>
                  <td>US Dollars</td>
                  <td>US &#36;</td>
              </tr>
          </table>
      </div>
<h3>Order Cancellation And Refunds</h3>
<div>
          <p>&nbsp;&nbsp;If the Client has a change of mind and wishes to Cancel the Order he has 24 Working Hours to do so. Kindly notify us at <?php echo JHtml::_('email.cloak', 'admin@astroisha.com'); ?> 
              and also mention the token number or Paypal Transaction ID or Paypal Order ID provided in the confirmation email. Astro Isha would Cancel the Order and money would be credited back to your account. 
              A confirmation of Cancellation of Order would be provided to Client. As money is still with Paypal during this time it is 
              advised that the Client asks Paypal about the duration of time before money is credited back into his/her account.
          </p>
          <p>&nbsp;&nbsp;After 24 Hours since order has been confirmed, Astro Isha reserves the right to proceed with the Order and Client Requests for Cancellation of Order 
          cannot be entertained.</p>
      </div>
  <h3>Order Processing and Confirmation</h3>
 <div>
          <p>&nbsp;&nbsp;After 24 Hours Astro Isha would start processing the Order. The client query would be provided with a logical answer 
          and the answer would be provided as attachment in the email. Astro Isha would only ask for Remittance of Payment once 
          the client query has been resolved with a logical answer.</p>
      </div>
<h3>Order Failure and Refunds</h3>
<div>
          <p>&nbsp;&nbsp;As mentioned earlier Astro Isha would only ask for Remittance once the Client is emailed 
          with Answer and Logical Solution to his Questions. This Order would likely be processed in 7-10 Working Days.</p>
          <p>&nbsp;&nbsp;In case there is a failure to give answer to clients query after 29 Days of Order Placement, the money is credited 
          directly back into the Account of Client.</p>
      </div>
</div>
<?php
}
?>
