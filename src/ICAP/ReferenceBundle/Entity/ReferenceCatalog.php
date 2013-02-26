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
}