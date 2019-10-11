<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="movie")
 */
class Movie
{
    /**
     * @ORM\Id()
     * @ORM\Column(name="titleId", type="string", length=255)
     */
    private $titleId;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $region;

    /**
     * @var string
     *
     * @ORM\Column(name="language", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $language;

    /**
     * @var string
     *
     * @ORM\Column(name="types", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $types;

    /**
     * @var DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $createdAt;
    /**
     * @var DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $updatedAt;

    /**
     * @ORM\ManyToMany(targetEntity="Genre", cascade={"persist"})
     * @ORM\JoinTable(name="movie_genre")
     */
    protected $genreCollection;

    public function __construct()
    {
        $this->genreCollection = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getTitleId()
    {
        return $this->titleId;
    }

    /**
     * @return mixed
     */
    public function setTitleId(string $titleId)
    {
        $this->titleId = $titleId;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param string $region
     * @return $this
     */
    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $language
     * @return $this
     */
    public function setLanguage(string $language): self
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return string
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * @param string $types
     * @return $this
     */
    public function setTypes(string $types): self
    {
        $this->types = $types;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     * @return $this
     */
    public function setCreatedAt(DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $updatedAt
     * @return $this
     */
    public function setUpdatedAt(DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGenreCollection()
    {
        return $this->genreCollection;
    }

    /**
     * @param mixed $genreCollection
     * @return $this
     */
    public function setGenreCollection($genreCollection)
    {
        $this->genreCollection = $genreCollection;

        return $this;
    }

    public function addGenre(Genre $genre)
    {
        $this->genreCollection->add($genre);
    }
}
