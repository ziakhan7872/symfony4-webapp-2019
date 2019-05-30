<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
    * @ORM\Column(type="string", length=180)
    */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;


    /**
    * @ORM\Column(type="string", length=10)
    */
    private $status = 'Pending';

    /**
     * @ORM\Column(type="integer")
     */
    private $userId;


    /**
     * @var \App\Entity\Category
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * })
     */
    private $category;


    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;
    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Image;

    /**
     * @ORM\Column(type="text")
     */
    private $tag;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $vote_up = "0";

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $vote_down = "0";




    //Getter setter methods

  /**
    * @return mixed
    */
    public function getId()
    { 
        return $this->id; 
    }
    /**
    * @param mixed $id
    */
    public function setId($id)
    { 
        $this->id = $id; 
    }


    /**
    * @return mixed
    */
    public function getTitle()
    {
        return $this->title;
    }
    /**
    * @param mixed $title
    */
    public function setTitle($title)
    {
        if (\strlen($title) < 5) {
            throw new \InvalidArgumentException('Title needs to have 5 or more characters.');
        }

        $this->title = $title;
    }


    /**
    * @return mixed
    */
    public function getDescription()
    {
        return $this->description;
    }
    /**
    * @param mixed $description
    */
    public function setDescription($description)
    {
        $this->description = $description;
    }

 /**
    * @return mixed
    */
    public function getTag()
    {
        return $this->tag;
    }
    /**
    * @param mixed $tag
    */
    public function setTag($tag)
    {
        $this->tag = $tag;
    }


    /**
    * @return mixed
    */
    public function getStatus()
    {
        return $this->status;
    }
    /**
    * @param mixed $status
    */
    public function setStatus($status)
    {
        $this->status = $status;
    }

     /**
    * @return mixed
    */
    public function getUserId()
    {
        return $this->userId;
    }
    /**
    * @param mixed $userId
    */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getCategory()
    {
        return $this->category ;
    }

    public function setCategory( $category): self
    {
        $this->category = $category;

        return $this;
    }
    
    /**
    * @return mixed
    */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    /**
    * @param mixed $createdAt
    */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = new \DateTime($createdAt);
    }
    /**
    * @return mixed
    */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    /**
    * @param mixed $updatedAt
    */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = new \DateTime($updatedAt);
    }

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(string $Image): self
    {
        $this->Image = $Image;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getVoteUp(): ?string
    {
        return $this->vote_up;
    }

    public function setVoteUp(string $vote_up): self
    {
        $this->vote_up = $vote_up;

        return $this;
    }

    public function getVoteDown(): ?string
    {
        return $this->vote_down;
    }

    public function setVoteDown(string $vote_down): self
    {
        $this->vote_down = $vote_down;

        return $this;
    }

}
