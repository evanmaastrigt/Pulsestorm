<?php
class Alanstormdotcom_Developermanual_Controller_Abstract extends Mage_Adminhtml_Controller_Action
{
    public function namespacesAction()
	{
		$params = $this->getRequest()->getParams();
		$codepool = $params['codepool'];
		
		echo Mage::getModel('alanstormdotcom_developermanual/source_helper')->getNamespaces($codepool);
	}
    
    public function modulesAction()
	{
		$params = $this->getRequest()->getParams();
		$namespace = $params['namespace'];
        $type = $params['type'];
		
		echo Mage::getModel('alanstormdotcom_developermanual/source_helper')->getModules($namespace, $type);
	}
    
    public function classinfoAction()
	{
        $sort = $this->getRequest()->getParam('sort');
        $type = $this->getRequest()->getParam('type');
		$param = $this->getRequest()->getParam('class');
		$parts = explode('=>', $param);
		$class = $parts[0];
		$classAlias = $parts[1];
		
		$classInfo = Mage::getModel('alanstormdotcom_developermanual/helper')->getClassinfo($class, $classAlias, $sort);

		$block = $this->getLayout()->createBlock('alanstormdotcom_developermanual/Renderer_Reflection_Helper')
								   ->setTemplate('ajax_helper_methods.phtml')
								   ->setClass($classInfo);
        if($type == 'Helper') {
            $block->setFactoryMethod('helper');
        } elseif($type == 'Model') {
            $block->setFactoryMethod('getModel');
        }
        
		echo $block->toHtml();
		
	}
    
    protected function _initCssBlock()
	{
		$css = $this->getLayout()->createBlock('alanstormdotcom_developermanual/template')
					->setTemplate('drilldown_css.phtml');			
		$this->_addJs($css);	
	}
}