<?php
class Alanstormdotcom_Developermanual_Alanstormdotcom_Developermanual_HelperController
    extends Alanstormdotcom_Developermanual_Controller_Abstract
{
    public function helperReferenceAction()
    {
		$this->loadLayout();			
		$this->_initJsBlock();
        $this->_initCssBlock();
		$block = $this->getLayout()->createBlock('alanstormdotcom_developermanual/template')
								   ->setTemplate('form_helper_action.phtml')
                                   ->setReferenceTitle('Helper Methods Reference')
                                   ->setClassTitle('Helper');
		$this->_addContent($block);
        $this->_setActiveMenu('developermanual');
		$this->renderLayout();
    }
	
	public function helpersAction()
	{
		$params = $this->getRequest()->getParams();
		$module = $params['module'];
		
		echo Mage::getModel('alanstormdotcom_developermanual/source_helper')->getClasses($module, 'Helper');
	}
	
    protected function _initJsBlock()
	{
		$js = $this->getLayout()->createBlock('alanstormdotcom_developermanual/template')
				   ->setTemplate('drilldown_js.phtml')
                   ->setChild('js_observer_modules', $this->getLayout()
                                                          ->createBlock('alanstormdotcom_developermanual/template')
                                                          ->setTemplate('js/observer/helper_modules.phtml'))
                   ->setChild('js_observer_namespaces', $this->getLayout()
                                                          ->createBlock('alanstormdotcom_developermanual/template')
                                                          ->setTemplate('js/observer/helper_namespaces.phtml'))
                   ->setChild('js_observer_classes', $this->getLayout()
                                                          ->createBlock('alanstormdotcom_developermanual/template')
                                                          ->setTemplate('js/observer/helper_classes.phtml'));			
		
        $this->_addJs($js);	
	}
}