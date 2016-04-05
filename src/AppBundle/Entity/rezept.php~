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
}

?>