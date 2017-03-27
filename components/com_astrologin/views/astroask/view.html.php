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
    public function display($tpl = null)
    {
        // Assign data to the view
        $this->msg = $this->get('Data');
        // Check for errors.
        if (count($errors = $this->get('Errors')))
        {
            JError::raiseError(500, implode('<br />', $errors));
            return false;
        }
        if(!empty($this->msg))
        {
            $tpl        = null;
        }
        parent::display($tpl);
    }
}
?>
