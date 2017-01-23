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
        $user   = $this->get('User');
        //print_r($user);exit;
        if(empty($user))
        {
            $this->astro = $this->get('Data');
            $this->pagination = $this->get('Pagination'); 
            parent::display($tpl);
        }
        else
        {
            
            $this->astro    = $user;
            //print_r($this->astro);exit;
            parent::display("user");
        }
       // print_r($this->pagination);exit;
       
    }
    function showDetails($data)
    {
       $this->astro     = $data;
       parent::display('info');
    }
    
}
