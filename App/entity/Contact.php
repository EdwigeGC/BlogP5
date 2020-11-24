<?php

namespace App\entity; 

class Contact{
    private $senderName,
            $senderEmail,
            $senderMessage;


    //SETTERS
    public function setSenderName(){
        //maxlenght + case non vide
    }

    public function setSenderEmail(){
        //regex? + case non vide
    }

    public function setSenderMessage(){
        //maxlenght? + case non vide
    }

    //GETTERS

    public function SenderName()
  {
    return $this->senderName;
  }
  
  public function SenderEmail()
  {
    return $this->senderEmail;
  }
  
  public function SenderMessage()
  {
    return $this->senderMessage;
  }
        
}