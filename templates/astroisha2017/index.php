<?php
//error_reporting(0);       // uncomment on server
defined('_JEXEC') or die;
$app             = JFactory::getApplication();
$doc             = JFactory::getDocument();
$user            = JFactory::getUser();
$this->language  = $doc->language;
$this->direction = $doc->direction;
// Output as HTML5
$doc->setHtml5(true);
// Add Stylesheets
$doc->addStyleSheetVersion($this->baseurl . '/templates/' . $this->template . '/css/template.css');
$sitename = $app->get('sitename');
unset($doc->_scripts[JURI::root(true) . '/media/jui/js/jquery.min.js']);
unset($doc->_scripts[JURI::root(true) . '/media/jui/js/jquery-noconflict.js']);
unset($doc->_scripts[JURI::root(true) . '/media/jui/js/jquery-migrate.min.js']);
$doc->setGenerator("Astro Isha Inc.");
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
<title><?php echo trim($sitename); ?></title>
<meta name="robots" content="index, follow" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="<?php echo $this->baseurl ?>/favicon.ico" type="image/x-icon" />
<link rel="icon" href="<?php echo $this->baseurl ?>/logo.png" type="image/x-icon">
<meta name="msvalidate.01" content="E689BB58897C0A89BDC88E5DF8800B2F" />
<jdoc:include type="head" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/template.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/bootstrap-grid.min.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/jquery-ui.min.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/jquery-ui.structure.min.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/jquery-ui.theme.min.css" type="text/css" />
<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/jquery.min.js" type="text/javascript" language="javascript"></script>
<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/bootstrap.min.js" type="text/javascript" language="javascript"></script>
<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/jquery-ui.min.js" type="text/javascript" language="javascript"></script>
</head>
<body>
    <?php
 // Get option and view
$option = JRequest::getVar('option');
$view = JRequest::getVar('view');
// Make sure it is a single article
if ($option == 'com_content' && $view == 'article'):
  $id = JRequest::getInt('id');
?>
<div id="<?php echo $id; ?>" class="accordion-id"></div>
<?php
endif;
?>
<div id="fb-root"></div>
<jdoc:include type="modules" name="topmenu" style="none" />
<div class="spacer"></div>
<jdoc:include type="modules" name="jbanner" style="none" />
<div class="mb-1"></div>
<div class="container-fluid">
    <div class="row">
    <div class="col-md-8">
    <jdoc:include type="modules" name="breadcrumb" style="none" />
    <div class="mb-1"></div>
    <jdoc:include type="message" />
    <div class="mb-1"></div>
     <jdoc:include type="modules" name="articleslider" style="none" />
     <div class="mb-1"></div>
    <jdoc:include type="component" />   
    <div class="mb-1"></div>
    <jdoc:include type="modules" name="relatedarticles" style="none" />
    <div class="mb-1"></div>
    </div>
    </div>
</div>
<jdoc:include type="modules" name="footer" style="none" />
<?php
include_once (JPATH_ROOT.DS.'analyticstracking.php');
?>
<script>
  window.fbAsyncInit = function() {FB.init({appId      : '220390744824296',xfbml      : true,version    : 'v2.4'});};
  (function(d, s, id){var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));
</script>
<script>
  (function() {
    var cx = '006812877761787834600:vf6wtd5lcuk';var gcse = document.createElement('script');
    gcse.type = 'text/javascript';gcse.async = true;
    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//cse.google.com/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(gcse, s);
  })();
</script>
<script src="https://apis.google.com/js/platform.js" async defer></script>
</body>