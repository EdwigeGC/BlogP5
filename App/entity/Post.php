<?php

namespace App\entity;

class Post
{

    private $id;
    private $title;
    private $author;
    private $chapo;
    private $content;
    private $displayDate;
    private $published;

    public function __construct($param)
    {

        $this->setId($param['id']);
        $this->setTitle($param['title']);
        $this->setAuthor($param['author']);
        $this->setChapo($param['chapo']);
        $this->setContent($param['content']);
        $this->setDisplayDate($param['creation_date'], $param['modification_date']);
        $this->setPublished($param['published']);
    }

    //SETTER
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setTitle($title)
    {
        if(is_string($title) || !empty($title))
        {
        $this->title = $title;
        }
    }

    public function setAuthor($author)
    {
        if(is_string($author) || !empty($author))
        {
        $this->author = $author;
        }
       
    }

    public function setChapo($chapo)
    {
        if(is_string($chapo) || !empty($chapo))
        {
        $this->chapo = $chapo;
        }
    }

    public function setContent($content)
    {
        if(is_string($content) || !empty($content))
        {
        $this->content = $content;
        }
    }

    public function setDisplayDate($creationDate, $modificationDate)
    {
        if (!empty($modificationDate)) {
            $this->displayDate = $modificationDate;
        } else {
            $this->displayDate = $creationDate;
        }
        $dateFr = new \Datetime($this->displayDate);
        $this->displayDate = $dateFr->format('d/m/Y');
    }

    public function setPublished($published)
    {
        $this->published = $published;
    }


    //GETTER
    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getChapo()
    {
        return $this->chapo;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getDisplayDate()
    {
        return $this->displayDate;
    }

    public function getPublished()
    {
        return $this->published;
    }
}
