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
    public function display($tpl = null)
    {
        // Check for errors.
        if (count($errors = $this->get('Errors')))
        {
            JError::raiseError(500, implode('<br />', $errors));
            return false;
        }
        
        parent::display($tpl);
    }
}
?>
