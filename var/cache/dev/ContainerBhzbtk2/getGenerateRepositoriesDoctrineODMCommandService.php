<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'Doctrine\Bundle\MongoDBBundle\Command\GenerateRepositoriesDoctrineODMCommand' shared service.

return $this->services['Doctrine\\Bundle\\MongoDBBundle\\Command\\GenerateRepositoriesDoctrineODMCommand'] = new \Doctrine\Bundle\MongoDBBundle\Command\GenerateRepositoriesDoctrineODMCommand(${($_ = isset($this->services['doctrine_mongodb']) ? $this->services['doctrine_mongodb'] : $this->getDoctrineMongodbService()) && false ?: '_'});
