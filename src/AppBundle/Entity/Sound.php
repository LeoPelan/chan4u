<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sound
 *
 * @ORM\Table(name="sound")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SoundRepository")
 */
class Sound
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="genre", type="string", length=255)
     */
    private $genre;

    /**
     * @var string
     *
     * @ORM\Column(name="artiste", type="string", length=255)
     */
    private $artiste;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Sound
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set genre
     *
     * @param string $genre
     *
     * @return Sound
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return string
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set artiste
     *
     * @param string $artiste
     *
     * @return Sound
     */
    public function setArtiste($artiste)
    {
        $this->artiste = $artiste;

        return $this;
    }

    /**
     * Get artiste
     *
     * @return string
     */
    public function getArtiste()
    {
        return $this->artiste;
    }
}

