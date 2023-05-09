<?php

/**
 * 
 */
class Block_Core_Layout extends Block_Core_Template
{
	
   public function __construct()
	{
		parent::__construct();
		$this->prepareChildren();
		$this->setTemplate('core/layout/3column.phtml');
	}

   public function prepareChildren()
	{
		$header = $this->createBlock('Html_Header');
		$this->addChild('header',$header);
		// $message = $this->createBlock('Html_Message');
		// $this->addChild('message',$message);
		$content = $this->createBlock('Html_Content');
		$this->addChild('content',$content);
		$footer = $this->createBlock('Html_Footer');
		$this->addChild('footer',$footer);
	}

	public function createBlock($className)
    {
       $className = 'Block_'.$className;
        $block= new $className();
        $block->setLayout($this);
        return $block;
    }


}

?>