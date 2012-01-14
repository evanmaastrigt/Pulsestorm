<?php
class Alanstormdotcom_Developermanual_Model_Source_Helper extends Mage_Core_Model_Abstract
{
	public function getCodePools()
	{
		return $this->_getDirs('app/code');
	}
	
	public function getNamespaces($codepool)
	{
		return $this->_getDirs($codepool);
	}
	
	public function getModules($namespace, $type)
	{
		return $this->_getDirsContainingTypeDir($namespace, $type);
	}
	
	public function getClasses($module, $type)
	{
		try {
			$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($module . '/' . $type));
		} catch (UnexpectedValueException $e) {
			return '';
		}
		
		$options = array();
		while($it->valid()) {
			if (! $it->isDot()) {
				$label = strtolower(str_replace('.php', '', str_replace('/', '_', $it->getSubPathName())));
				$options[$it->key() . '=>' . $label] = $label;
			}
			$it->next();
		}
		return $this->_toOptionsFromHash($options);
	}
	
	protected function _getDirs($base)
	{
		try {
			$it = new DirectoryIterator($base);
		} catch (UnexpectedValueException $e) {
			return '';
		}
		
		$dirs = array();
		foreach ($it as $fileinfo) {
			if(! $fileinfo->isDot() && $fileinfo->isDir()) {
				$dirs[] = $fileinfo->getFilename();
			}
		}
		
		return $this->_toOptionsFromArray($dirs, $base);
	}
	
	protected function _getDirsContainingTypeDir($base, $type)
	{
		try {
			$it = new DirectoryIterator($base);
		} catch (UnexpectedValueException $e) {
			return '';
		}
		
		$dirs = array();
		foreach ($it as $fileinfo) {
			if(! $fileinfo->isDot() && $fileinfo->isDir()) {
				try {
					$tmp = new DirectoryIterator($fileinfo->getPathName() . '/' . $type);
				} catch(UnexpectedValueException $e) {
					continue;
				}
				$dirs[] = $fileinfo->getFilename();
			}
		}
		
		return $this->_toOptionsFromArray($dirs, $base);
	}
	
	protected function _toOptionsFromArray(array $labels, $base, $addEmpty = true)
	{
		sort($labels);
		
		$options = '';
		if($addEmpty) {
			$options .= '<option value="">Select...</option>';
		}
		foreach($labels as $label) {
			$options .= '<option value="' . $base . '/' . $label . '">' . $label . '</option>';
		}
		
		return $options;
	}
	
	protected function _toOptionsFromHash($options)
	{
		ksort($options);
		
		$return = '<option value="">Select...</option>';
		foreach($options as $key => $value) {
			$return .= '<option value="' . $key . '">' . $value . '</option>';
		}
		
		return $return;
	}
}