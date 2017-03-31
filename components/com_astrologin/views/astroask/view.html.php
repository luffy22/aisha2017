<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of view
 *
 * @author luffy
 */
class AstroLoginViewAstroAsk extends JViewLegacy
{
    public $msg;
    public $data;
    public function display($tpl = null)
    {
     
        $this->msg = $this->get('Data');
        
        // Check for errors.
        if (count($errors = $this->get('Errors')))
        {
            JError::raiseError(500, implode('<br />', $errors));
            return false;
        }
        if(!empty($this->msg)&&(!isset($_GET['uname']))&&(!isset($_GET['ques']))&&(!isset($_GET['type'])))
        {
            $tpl        = null;
        }
        else if(!empty($this->msg)&&isset($_GET['uname'])&&isset($_GET['ques'])&&isset($_GET['type']))
        {
             $tpl       = 'details';
        }
        parent::display($tpl);
    }
    public function page2($tpl=null)
    {
        //print_r($this->data);exit;
        if (count($errors = $this->get('Errors')))
        {
            JError::raiseError(500, implode('<br />', $errors));
            return false;
        }
        if(!empty($this->data))
        {
            $tpl        = 'details';
        }
        else
        {
            $tpl        = null;
        }
        parent::display($tpl);
    }
}
?>
