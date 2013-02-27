<?php

namespace ICAP\ReferenceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="icap__reference")
 */
class Reference
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
     * @ORM\Column(type="text")
     */
    protected $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $url;

    /**
     * @ORM\Column(type="json_array")
     */
    protected $data;

    /**
     * @ORM\OneToMany(targetEntity="ICAP\ReferenceBundle\Entity\CustomField", mappedBy="reference", cascade={"persist"})
     */
    protected $customFields;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->customFields = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @return Reference
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
     * Set description
     *
     * @param string $description
     * @return Reference
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Reference
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Reference
     */
    public function setUrl($url)
    {
        $this->url = $url;
    
        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set data
     *
     * @param array $data
     * @return Reference
     */
    public function setData($data)
    {
        $this->data = $data;
    
        return $this;
    }

    /**
     * Get data
     *
     * @return array 
     */
    public function getData()
    {
        return $this->data;
    }
    
    /**
     * Add customFields
     *
     * @param \ICAP\ReferenceBundle\Entity\CustomField $customField
     * @return Reference
     */
    public function addCustomField(\ICAP\ReferenceBundle\Entity\CustomField $customField)
    {
        $this->customFields[] = $customField;
    
        return $this;
    }

    /**
     * Remove customFields
     *
     * @param \ICAP\ReferenceBundle\Entity\CustomField $customField
     */
    public function removeCustomField(\ICAP\ReferenceBundle\Entity\CustomField $customField)
    {
        $this->customFields->removeElement($customField);
    }

    /**
     * Get customFields
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCustomFields()
    {
        return $this->customFields;
    }
}