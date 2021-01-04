<?php

namespace App\entity;

/**
 * Class represents a comment
 */
class Comment
{
    /**
     * @var integer $id comment's id
     */
    private $id;
    /**
     * @var string $dateFr date of comment's writing
     */
    private $date;
    /**
     * @var string $author name of the user who write the comment
     */
    private $author;
    /**
     * @var string $message comment's content
     */
    private $message;
    /**
     * @var string $status indicates if the comment has been validate or not by administrator user
     */
    private $status;
    /**
     * @var integer $postId indicates the post ID number to which the comment is linked
     */
    private $postId;

    /**
     * Constructor of Comment object
     *
     * @param mixed $param
     */
    public function __construct($param)
    {

        $this->setId($param['id']);
        $this->setDate($param['date']);
        $this->setAuthor($param['author']);
        $this->setMessage($param['message']);
        $this->setStatus($param['status']);
        $this->setpostId($param['post_id']);
    }

    /**
     * Setter for id property
     *
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * Setter for date property
     *
     * @param string $date date's comment
     */
    public function setDate(string $date)
    {
        if(is_string($date) || !empty($date))
        {
            $dateFr = new \Datetime($this->date);
            $this->date = $dateFr->format('d/m/Y');
        }
    }

    /**
     * Setter for author property
     *
     * @param string $author name's author of the comment
     */
    public function setAuthor(string $author)
    {
        if(is_string($author) || !empty($author))
        {
        $this->author = $author;
        }
       
    }

    /**
     * Setter for message property
     *
     * @param string $message message content of the comment
     */
    public function setMessage(string $message)
    {
        if(is_string($message) || !empty($message))
        {
        $this->message = $message;
        }
    }

    /**
     * Setter for status property
     *
     * @param string $status "agreed" or "wainting" if the comment is not validate
     */
    public function setStatus(string $status)
    {
        if(is_string($status) || !empty($status))
        {
        $this->status = $status;
        }
    }

    /**
     * Setter for post id property
     *
     * @param integer $postId indicates the id of the post linked with the comment
     */
    public function setpostId(int $postId)
    {
        $this->postId = $postId;
    }

    /**
     * Getter for Id
     *
     * @return int comment's Id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Getter for date
     *
     * @return int date of the comment with french format
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Getter for author
     *
     * @return string author's name of the comment
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Getter for message
     *
     * @return string content of the comment
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Getter for status
     *
     * @return string "agreed" or "waiting" if the comment is not validated
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Undocumented function
     *
     * @return int post id number (to which the comment corresponds)
     */
    public function getpostId()
    {
        return $this->postId;
    }
}
