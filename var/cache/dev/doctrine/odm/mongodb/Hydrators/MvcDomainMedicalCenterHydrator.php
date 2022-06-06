<?php

namespace Hydrators;

use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Doctrine\ODM\MongoDB\Hydrator\HydratorInterface;
use Doctrine\ODM\MongoDB\Query\Query;
use Doctrine\ODM\MongoDB\UnitOfWork;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ODM. DO NOT EDIT THIS FILE.
 */
class MvcDomainMedicalCenterHydrator implements HydratorInterface
{
    private $dm;
    private $unitOfWork;
    private $class;

    public function __construct(DocumentManager $dm, UnitOfWork $uow, ClassMetadata $class)
    {
        $this->dm = $dm;
        $this->unitOfWork = $uow;
        $this->class = $class;
    }

    public function hydrate($document, $data, array $hints = array())
    {
        $hydratedData = array();

        /** @Field(type="id") */
        if (isset($data['_id']) || (! empty($this->class->fieldMappings['id']['nullable']) && array_key_exists('_id', $data))) {
            $value = $data['_id'];
            if ($value !== null) {
                $typeIdentifier = $this->class->fieldMappings['id']['type'];
                $return = $value instanceof \MongoId ? (string) $value : $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['id']->setValue($document, $return);
            $hydratedData['id'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['name']) || (! empty($this->class->fieldMappings['name']['nullable']) && array_key_exists('name', $data))) {
            $value = $data['name'];
            if ($value !== null) {
                $typeIdentifier = $this->class->fieldMappings['name']['type'];
                $return = (string) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['name']->setValue($document, $return);
            $hydratedData['name'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['address']) || (! empty($this->class->fieldMappings['address']['nullable']) && array_key_exists('address', $data))) {
            $value = $data['address'];
            if ($value !== null) {
                $typeIdentifier = $this->class->fieldMappings['address']['type'];
                $return = (string) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['address']->setValue($document, $return);
            $hydratedData['address'] = $return;
        }

        /** @Field(type="collection") */
        if (isset($data['healthPersonnel']) || (! empty($this->class->fieldMappings['healthPersonnel']['nullable']) && array_key_exists('healthPersonnel', $data))) {
            $value = $data['healthPersonnel'];
            if ($value !== null) {
                $typeIdentifier = $this->class->fieldMappings['healthPersonnel']['type'];
                $return = $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['healthPersonnel']->setValue($document, $return);
            $hydratedData['healthPersonnel'] = $return;
        }
        return $hydratedData;
    }
}