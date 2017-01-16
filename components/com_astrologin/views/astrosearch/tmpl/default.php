<?php
defined('_JEXEC') or die('Restricted access');
$astro      = $this->astro;
//print_r($astro);exit;
?>
<div class="mt-1"></div>
<?php
     foreach($astro as $data)
     {

?>      
<div class="card" id="<?php echo "astro_".$data->number ?>">
    <div class="card-block">
        <h3 class="card-title"><?php echo $data->name; ?></h3>
        <?php
         if($data->membership == "Paid")
         {
      ?>
        <p class="float-xs-right"><a class="btn btn-primary" href="<?php echo JUri::base() ?>ask-question"><i class="fa fa-globe"></i> Ask Online</a></p>
      <?php
         }
      ?>
        <div class="row">
            <div class="col-md-2"><img src="<?php echo JURI::base() ?>images/blank-profile.png" title="<?php echo $this->img_1 ?>" class="img-fluid" /></div>
            <div class="col-md-10"><strong>Location:</strong> <?php echo $data->city.", ",$data->state.", ".$data->country;  ?><br/>
              <strong>Little About Me:</strong><br/> <?php echo $data->info; ?>
              <form role="form" enctype="application/x-www-form-urlencoded" method="post" 
                    action="<?php echo JRoute::_('index.php?option=com_astrologin&task=astrosearch.getDetails'); ?>">
               <input type="hidden" value="<?php $uri = JUri::getInstance();echo  $uri->toString(); ?>" name="current_url" />
               <input type="hidden" value="<?php echo $data->username; ?>" name="astro_getuser" />
               <button type="submit" class="btn btn-primary" name="profile_full"><i class="fa fa-address-card-o"></i> Get Full Details</button>
              </form>
              
            </div>
        </div>
    </div>
</div>
<?php
     }
?>
<div class="mb-1"></div>

