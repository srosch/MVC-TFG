<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'Mvc\Domain\UserDiseaseTreatmentRepository' shared autowired service.

$a = ${($_ = isset($this->services['doctrine_mongodb.odm.default_document_manager']) ? $this->services['doctrine_mongodb.odm.default_document_manager'] : $this->load('getDoctrineMongodb_Odm_DefaultDocumentManagerService.php')) && false ?: '_'};

return $this->services['Mvc\\Domain\\UserDiseaseTreatmentRepository'] = new \Mvc\Infrastructure\Doctrine\DoctrineUserDiseaseTreatmentRepository($a, $a);
