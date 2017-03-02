<?php

class EmailGhost
{
    private $from;
    private $title;
    private $body;

    /**
     * EmailGhost constructor.
     * @param $from
     * @param $title
     * @param $body
     */
    public function __construct($from, $title, $body)
    {
        $this->from = $from;
        $this->title = $title;
        $this->body = $body;
    }

    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }
}