<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
defined('_JEXEC') or die;
if($this->msg['approval_status'] == 'pending')
{        
?>
<div class="alert alert-success" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
    <strong>Authentication Pending!!</strong> Details would be published once information is authenticated.</div>
<?php
}
?>
<h3>Astrologer: Free Account</h3>
<div class="float-xs-right"><span class="glyphicon glyphicon-user"></span> Profile  |  <a href="<?php echo JURI::base() ?>details" title="Edit Details"><span class="glyphicon glyphicon-pencil"></span> Details</a></div>
<div class="mt-3"></div>
<div id="dashboard_free">
<h3>Basic Details</h3>
<div>
    <div class="row">
        <div class="col-md-3">
          <?php if(empty($this->msg['img_1_id'])){ ?>
          <img src="<?php echo JURI::base() ?>images/blank-profile.png" alt="blank photo" 
               class="img-fluid img-thumbnail" title="Please Upload Your Photo..." />
          <?php
          }
          else
          {
          ?>
          <img src="<?php echo JURI::base() ?>images/profiles/<?php echo $this->msg['img_1_id'] ?>" alt="<?php echo $this->msg['name'] ?> image" 
               class="img-fluid img-thumbnail" title="<?php echo $this->msg['name']; ?>" /><?php } ?>
      </div>
      <div class="col-md-5">
          <div class="table-responsive">
          <table class="table table-bordered table-hover ">
              <tr><th>Username: </th><td><?php echo $this->msg['username']; ?></td></tr>
              <tr><th>Name: </th><td><?php echo $this->msg['name']; ?></td></tr>
              <tr><th>Profile Status: </th><td><?php echo ucfirst($this->msg['profile_status']); ?></td></tr>
          </table>
          </div>
      </div>
    </div>
    <div class="mt-1"></div>
    <p class="lead">Little About Me:</p>
        <p class="text-left"><?php echo $this->msg['info']; ?></p>
</div>
<h3>Location Details</h3>
<div>
    <table class="table table-bordered table-hover ">
      <tr><th><span class="glyphicon glyphicon-home"></span> Address Line 1: </th><td><?php if(empty($this->msg['addr_1'])){echo "Not Provided"; }else{ echo $this->msg['addr_1'];} ?></td></tr>
      <tr><th><span class="glyphicon glyphicon-road"></span> Address Line 2: </th><td><?php if(empty($this->msg['addr_2'])){echo "Not Provided"; }else{ echo $this->msg['addr_2'];} ?></td></tr>
      <tr><th>City: </th><td><?php echo $this->msg['city']; ?></td></tr>
      <tr><th>State: </th><td><?php if(empty($this->msg['state'])){echo "Not Provided"; }else{ echo $this->msg['state'];} ?></td></tr>
      <tr><th>Country: </th><td><?php echo $this->msg['country']; ?></td></tr>
      <tr><th>Postcode: </th><td><?php echo $this->msg['postcode']; ?></td></tr>
    </table>
</div>
<h3>Contact Details</h3>
<div>
    <table class="table table-hover table-bordered">
      <tr><th><span class="glyphicon glyphicon-envelope"></span> Email: </th><td><?php echo $this->msg['email']; ?></td></tr>
      <tr><th><span class="glyphicon glyphicon-phone-alt"></span> Phone: </th><td><?php if(empty($this->msg['phone'])){echo "Not Provided"; }else{ echo $this->msg['phone'];} ?></td></tr>
      <tr><th><span class="glyphicon glyphicon-phone"></span> Mobile: </th><td><?php if(empty($this->msg['mobile'])){echo "Not Provided"; }else{ echo $this->msg['mobile'];} ?></td></tr>
      <tr><th><img src="<?php echo JURI::base() ?>images/whatsapp.png" alt="whatsapp logo" title="Whether Astrologer Uses Whatsapp" height="25px" width="25px" /> Available On Whatsapp: </th><td><?php echo ucfirst($this->msg['whatsapp']); ?></td></tr>
      <tr><th><span class="glyphicon glyphicon-globe"></span> Website/Blog: </th><td><?php if(empty($this->msg['website'])){echo 'Not Provided'; }else{ echo $this->msg['website']; } ?></td></tr>
    </table>
</div>
</div>
<div class="mb-1"></div>