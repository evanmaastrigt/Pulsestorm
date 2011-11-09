<?php
class Alanstormdotcom_Developermanual_HelperController extends Mage_Adminhtml_Controller_Action
{
    public function helperReferenceAction()
    {
		$this->loadLayout();			
		//$this->_initCssBlock();
		$block = $this->getLayout()->createBlock('alanstormdotcom_developermanual/template')
								   ->setTemplate('form_helper_action.phtml');
		$this->_addContent($block);
		$this->renderLayout();
    }
	
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
		
		echo Mage::getModel('alanstormdotcom_developermanual/source_helper')->getModules($namespace);
	}
	
	public function helpersAction()
	{
		$params = $this->getRequest()->getParams();
		$module = $params['module'];
		
		echo Mage::getModel('alanstormdotcom_developermanual/source_helper')->getHelpers($module);
	}
	
	public function classinfoAction()
	{
		$param = $this->getRequest()->getParam('class');
		$parts = explode('=>', $param);
		$class = $parts[0];
		$classAlias = $parts[1];
		
		$classInfo = Mage::getModel('alanstormdotcom_developermanual/helper')->getClassinfo($class, $classAlias);
		
		//Zend_Debug::dump($classInfo['methods']);
		
		
		$block = $this->getLayout()->createBlock('alanstormdotcom_developermanual/Renderer_Reflection_Helper')
								   ->setTemplate('ajax_helper_methods.phtml')
								   ->setClass($classInfo);
								   
		echo $block->toHtml();
		
		
	}
}