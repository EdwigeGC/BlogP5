<?php

namespace App\entity; 

class Comment
{
    private $id,
            $date,
            $author,
            $content,
            $status;

    public function validateComment()
    {
        ;
    }

    // SETTERS //
  
    public function setId($id)
    {
        $this->id = (int) $id;
    }
  
    public function setDate($date)
    {
        $this->date = $date;
    }

    public function setAuthor($author)
    {
        $this->author= (string) $author;
    }

    public function setContent($content)
    {
        $this->content = $content;
        //limiter le nombre de caractères à 1000 mots
    }

    public function setStatus($status)
    {
        $this->status = $status;
        //limiter le nombre de caractères à 20
    }
    

    //GETTERS//
    public function id()
  {
    return $this->_id;
  }
      
  public function date()
  {
    return $this->_date;
  }

  public function author()
  {
    return $this->_author;
  }

  public function content()
  {
    return $this->_content;
  }
  
  public function status()
  {
    return $this->_status;
  }
}