<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'Doctrine\Bundle\MongoDBBundle\Command\LoadDataFixturesDoctrineODMCommand' shared service.

return $this->services['Doctrine\\Bundle\\MongoDBBundle\\Command\\LoadDataFixturesDoctrineODMCommand'] = new \Doctrine\Bundle\MongoDBBundle\Command\LoadDataFixturesDoctrineODMCommand(${($_ = isset($this->services['doctrine_mongodb']) ? $this->services['doctrine_mongodb'] : $this->getDoctrineMongodbService()) && false ?: '_'}, ${($_ = isset($this->services['kernel']) ? $this->services['kernel'] : $this->get('kernel', 2)) && false ?: '_'}, NULL);
