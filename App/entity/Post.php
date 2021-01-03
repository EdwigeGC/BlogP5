<?php

namespace App\entity;

/**
 * Class represents a post
 * @author Edwige Genty
 */
class Post
{
    /**
     * @var integer $id post's id
     */
    private $id;
    /**
     * @var string $title post's title
     */
    private $title;
    /**
     * @var string $author post's author
     */
    private $author;
    /**
     * @var string $chapo post's chapo
     */
    private $chapo;
    /**
     * @var string $content post's content
     */
    private $content;
    /**
     * @var Datetime $displayDate post's last update
     */
    private $displayDate;
    /**
     * @var string $published post's published
     */
    private $published;

    /**
     * Constructor for post
     *
     * @param mixed $param
     */
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

    /**
     * Setter for post's id
     * 
     * @param integer $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * Setter for post's title
     * 
     * @param string $title
     */
    public function setTitle(string $title)
    {
        if (is_string($title) || !empty($title)) {
            $this->title = $title;
        }
    }

    /**
     * Setter for post's author
     * 
     * @param string $author
     */
    public function setAuthor(string $author)
    {
        if (is_string($author) || !empty($author)) {
            $this->author = $author;
        }
    }

    /**
     * Setter for post's chapo
     * 
     * @param string $chapo
     */
    public function setChapo(string $chapo)
    {
        if (is_string($chapo) || !empty($chapo)) {
            $this->chapo = $chapo;
        }
    }

    /**
     * Setter for post's content
     * 
     * @param string $content
     */
    public function setContent(string $content)
    {
        if (is_string($content) || !empty($content)) {
            $this->content = $content;
        }
    }

    /**
     * Setter to display the last modification date of the post, in french format
     *
     * @param string|null $creationDate always exists
     * @param string|null $modificationDate can be empty
     */
    public function setDisplayDate(?string $creationDate, ?string $modificationDate)
    {
        if (!empty($modificationDate)) {
            $this->displayDate = $modificationDate;
        } else {
            $this->displayDate = $creationDate;
        }
        $dateFr = new \Datetime($this->displayDate);
        $this->displayDate = $dateFr->format('d/m/Y');
    }

    /**
     * Setter to differentiates articles which are accessible by everyone or by administrator only
     *
     * @param string $published posts are "Publié" or "Non publié"
     */
    public function setPublished(string $published)
    {
        $this->published = $published;
    }

    /**
     * Getter for post's id
     *
     * @return integer id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Getter for post's title
     *
     * @return string title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Getter for post's author
     *
     * @return string author's name
     */
    public function getAuthor()
    {
        return $this->author;
    }


    /**
     * Getter for post's chapo
     *
     * @return string text
     */
    public function getChapo()
    {
        return $this->chapo;
    }

    /**
     * Getter for post's content
     *
     * @return string text
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Getter for post's last update
     *
     * @return \Datetime 
     */
    public function getDisplayDate()
    {
        return $this->displayDate;
    }

    /**
     * Getter for post's status
     *
     * @return string "Publié" ou "Non publié"
     */
    public function getPublished()
    {
        return $this->published;
    }
}
