<?php
defined('_JEXEC') or die('Restricted access');
$data      = $this->astro;
//print_r($data->name);exit;
?>
<div class="mt-2"></div>

<div class="mb-1"></div>
<div class="card" id="<?php echo "astro_".$data->number; ?>">
    <div class="card-block">
        <?php
         if($data->membership == "Paid")
         {
      ?>
        <div class="float-xs-right"><a class="btn btn-primary" href="<?php echo JUri::base() ?>ask-question"><i class="fa fa-globe"></i> Ask Online</a></div>
      <?php
         }
      ?>
          <img src="<?php echo JURI::base() ?>images/blank-profile.png" title="<?php echo $this->img_1 ?>" class="img-fluid" />
          <div class="mt-1"></div>
          <p class="text-lead"><?php echo $data->info; ?></p>
                <table class="table table-borderd table-hover">
                    <tr><th>Name</th><td class="col-md-10"><?php echo $data->name; ?></td></tr>
                    <tr><th><i class="fa fa-envelope-o"></i> Email</th><td><?php echo $data->email; ?></td></tr>
                    <tr><th><i class="fa fa-street-view"></i> Address Line 1</th><td><?php echo $data->addr_1; ?></td></tr>
                    <tr><th><i class="fa fa-street-view"></i> Address Line 2</th><td><?php echo $data->addr_2; ?></td></tr>
                    <tr><th><i class="fa fa-map-marker"></i> City</th><td><?php echo $data->city; ?></td></tr>
                    <tr><th>State</th><td><?php echo $data->state; ?></td></tr>
                    <tr><th>Country</th><td><?php echo $data->country; ?></td></tr>
                    <tr><th>Postcode</th><td><?php echo $data->postcode; ?></td></tr>
                    <tr><th><i class="fa fa-phone"></i> Phone</th><td><?php echo $data->phone; ?></td></tr>
                    <tr><th><i class="fa fa-mobile"></i> Mobile</th><td><?php echo $data->mobile; ?></td></tr>
                    <tr><th><i class="fa fa-whatsapp"></i> Available On WhatsApp</th><td><?php if(!empty($data->mobile)){echo ucfirst($data->whatsapp);}else{echo "No"; } ?></td></tr>
                </table>
    </div>
</div>
<div class="mb-2"></div>