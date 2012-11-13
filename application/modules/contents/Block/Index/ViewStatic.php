<?php

class Contents_Block_Index_ViewStatic extends Core_Block_View
{
	protected $_post;
	public function getPost()
	{
		if (null === $this->_post) {
			$this->_post = Core::getMapper('contents/posts')->getStaticPost($this->getRequest()->getParam('alias'));
			if (!$this->_post->getId()) {
				throw new Exception('Page not found');
			}
		}
		
		return $this->_post;
	}
}