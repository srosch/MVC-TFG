<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'Mvc\Application\Service\AllergyFindersService' shared autowired service.

return $this->services['Mvc\\Application\\Service\\AllergyFindersService'] = new \Mvc\Application\Service\AllergyFindersService(${($_ = isset($this->services['Mvc\\Domain\\UserRepository']) ? $this->services['Mvc\\Domain\\UserRepository'] : $this->load('getUserRepositoryService.php')) && false ?: '_'}, ${($_ = isset($this->services['Mvc\\Domain\\AllergyRepository']) ? $this->services['Mvc\\Domain\\AllergyRepository'] : $this->load('getAllergyRepositoryService.php')) && false ?: '_'});