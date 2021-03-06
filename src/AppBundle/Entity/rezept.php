<?php
/**
 * Created by PhpStorm.
 * User: luisaziegler
 * Date: 05.04.16
 * Time: 20:34
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class rezept
 * @ORM\Entity
 * @ORM\Table(name="rezept")
 */

class rezept{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="string", length=32)
     */
    protected $title;
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $zutaten;
    /**
     * @ORM\Column(type="text")
     */
    protected $discription;
    /**
     * @ORM\Column(type="string", length=32)
     */
    protected $author;
    /**
     * @ORM\Column(type="string", length=400)
     */
    protected $image;

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

    /**
     * Set image
     *
     * @param string $image
     *
     * @return rezept
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }
}
