<?php

namespace AppBundle\Entity;

/**
 * rezept
 */
class rezept
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $zutaten;

    /**
     * @var string
     */
    private $discription;

    /**
     * @var string
     */
    private $author;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return rezept
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set zutaten
     *
     * @param string $zutaten
     *
     * @return rezept
     */
    public function setZutaten($zutaten)
    {
        $this->zutaten = $zutaten;

        return $this;
    }

    /**
     * Get zutaten
     *
     * @return string
     */
    public function getZutaten()
    {
        return $this->zutaten;
    }

    /**
     * Set discription
     *
     * @param string $discription
     *
     * @return rezept
     */
    public function setDiscription($discription)
    {
        $this->discription = $discription;

        return $this;
    }

    /**
     * Get discription
     *
     * @return string
     */
    public function getDiscription()
    {
        return $this->discription;
    }

    /**
     * Set author
     *
     * @param string $author
     *
     * @return rezept
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }
}

