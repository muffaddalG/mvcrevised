<?php

class Model_Core_Message
{
    protected $session = null;
    const SUCCESS = 'success';
    const FAILURE = 'failure';
    const NOTICE = 'notice';

    public function __construct()
    {
        return $this->getSession();
    }

    public function setSession(Model_Core_Session $session)
    {
        $this->session = $session;
        return $this;
    }

    public function getSession()
    {
        if ($this->session) 
        {
            return $this->session;
        }
        $session = new Model_Core_Session();
        $this->setSession($session);
        return $session;
    }

    public function addMessage($message , $type = null)
    {
        if (!$type) 
        {
            $type = self::SUCCESS;
        }
        $session = $this->getSession();
        if (!$this->getSession()->has('message')) 
        {
            $this->getSession()->set('message',[]);
        }
        $messages = $this->getMessage();
        $messages[$type] = $message;
        $this->getSession()->set('message',$messages);
        return $this;
    }

    public function getMessage()
    {
        if (!$this->getSession()->has('message')) 
        {
            return null;
        }
        if (!array_key_exists('message', $_SESSION)) 
        {
            return null;
        }
        return $this->getSession()->get('message');
    }

    public function clearMessage()
    {
        if (!$this->getSession()->has('message'))
            {
                return null;
            }
            $this->getSession()->unset('message');
        return $this;
    }   
}
?>