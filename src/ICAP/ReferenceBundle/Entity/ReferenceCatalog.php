<?php

namespace ICAP\ReferenceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="icap__referencecatalog")
 */
class ReferenceCatalog
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $title;

     /**
     * @ORM\Column(type="string", length=255)
     */
    protected $references;

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
     * @return ReferenceCatalog
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
     * Set references
     *
     * @param string $references
     * @return ReferenceCatalog
     */
    public function setReferences($references)
    {
        $this->references = $references;
    
        return $this;
    }

    /**
     * Get references
     *
     * @return string 
     */
    public function getReferences()
    {
        return $this->references;
    }
}