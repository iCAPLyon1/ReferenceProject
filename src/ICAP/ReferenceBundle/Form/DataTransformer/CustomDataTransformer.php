<?php

// src/Acme/TaskBundle/Form/DataTransformer/IssueToNumberTransformer.php
namespace Acme\TaskBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use Acme\TaskBundle\Entity\Issue;

class CustomDataTransformer implements DataTransformerInterface
{
    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    /**
     * Transforms an object (reference) to a array.
     *
     * @param  reference|null $reference
     * @return string
     */
    public function transform($reference)
    {
        return array('key': '', 'value': '');
    }

    /**
     * Transforms a customData(array) to an object (reference).
     *
     * @param  array $customData
     * @return reference|null
     * @throws TransformationFailedException if object (reference) is not found.
     */
    public function reverseTransform($customData)
    {
        if (!$array) {
            return null;
        }

        $issue = $this->om
            ->getRepository('ICAPReferenceBundle:Reference')
            ->findOneBy(array('number' => $number))
        ;

        if (null === $issue) {
            throw new TransformationFailedException(sprintf(
                'An issue with number "%s" does not exist!',
                $number
            ));
        }

        return $issue;
    }
}