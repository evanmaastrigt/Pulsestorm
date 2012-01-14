<?php
class Alanstormdotcom_Developermanual_Alanstormdotcom_Developermanual_ModelController
    extends Alanstormdotcom_Developermanual_Controller_Abstract
{
    public function modelReferenceAction()
    {
		$this->loadLayout();			
		$this->_initJsBlock();
        $this->_initCssBlock();
		$block = $this->getLayout()->createBlock('alanstormdotcom_developermanual/template')
								   ->setTemplate('form_helper_action.phtml')
                                   ->setReferenceTitle('Model Methods Reference')
                                   ->setClassTitle('Model');
		$this->_addContent($block);
        $this->_setActiveMenu('developermanual');
		$this->renderLayout();
    }
    
    public function modelsAction()
	{
		$params = $this->getRequest()->getParams();
		$module = $params['module'];
		
		echo Mage::getModel('alanstormdotcom_developermanual/source_helper')->getClasses($module, 'Model');
	}
    
    protected function _initJsBlock()
	{
		$js = $this->getLayout()->createBlock('alanstormdotcom_developermanual/template')
				   ->setTemplate('drilldown_js.phtml')
                   ->setChild('js_observer_modules', $this->getLayout()
                                                          ->createBlock('alanstormdotcom_developermanual/template')
                                                          ->setTemplate('js/observer/model_modules.phtml'))
                   ->setChild('js_observer_namespaces', $this->getLayout()
                                                          ->createBlock('alanstormdotcom_developermanual/template')
                                                          ->setTemplate('js/observer/model_namespaces.phtml'))
                   ->setChild('js_observer_classes', $this->getLayout()
                                                          ->createBlock('alanstormdotcom_developermanual/template')
                                                          ->setTemplate('js/observer/model_classes.phtml'));			
		
        $this->_addJs($js);	
	}
}