<?php
defined('_JEXEC') or die('Restricted access');

class AstroLoginViewAstroSearch extends JViewLegacy
{
    /*
    * Display the extended profile view
    */
    var $astro;
    var $pagination;
    function display($tpl = null)
    {
        $user        = $_GET['user'];
       // print_r($this->pagination);exit;
        if(isset($user))
        {
            $this->astro    = $this->get('User');
            //print_r($this->astro);exit;
            parent::display("user");
        }
        else
        {
            $this->astro = $this->get('Data');
            $this->pagination = $this->get('Pagination'); 
            parent::display($tpl);
        }
    }
    function showDetails($data)
    {
       $this->astro     = $data;
       parent::display('info');
    }
    
}
