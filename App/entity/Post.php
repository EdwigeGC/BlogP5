<?php

namespace App\entity; 

class Post
{
    private $id,
            $date,
            $author,
            $title,
            $chapo,
            $content,
            $numberComment,
            $status;

    public function published()
    {
       //modifictaion du status de brouillon à publié ;
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
  
    public function setTitle($title)
    {
        $this->title = (string) $title;
        //max string 200 
    }
  
    public function setChapo($chapo)
    {
        $this->chapo = (string) $chapo;
        //max caractères 1500
    }

    public function setContent($content)
    {
        $this->content= (string) $content;
        //max string 1000 mots
    }

    public function setNumberComment($numberComment)
    {
        $this->numberComment = (int) $numberComment;
         //max string 1000 
    }

    public function setStatus($status)
    {
        $this->status= (string) $status;
        //max string 20 
    }
 

    //GETTERS
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

    public function title()
    {
      return $this->_title;
    }

    public function chapo()
    {
      return $this->_chapo;
    }

    public function content()
    {
      return $this->_content;
    }

    public function numberComent()
    {
      return $this->_numberComment;
    }

    public function status()
    {
      return $this->_status;
    }
}
