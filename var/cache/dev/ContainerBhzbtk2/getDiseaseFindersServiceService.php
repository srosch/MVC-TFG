<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'Mvc\Application\Service\DiseaseFindersService' shared autowired service.

return $this->services['Mvc\\Application\\Service\\DiseaseFindersService'] = new \Mvc\Application\Service\DiseaseFindersService(${($_ = isset($this->services['Mvc\\Domain\\UserRepository']) ? $this->services['Mvc\\Domain\\UserRepository'] : $this->load('getUserRepositoryService.php')) && false ?: '_'}, ${($_ = isset($this->services['Mvc\\Domain\\DiseaseRepository']) ? $this->services['Mvc\\Domain\\DiseaseRepository'] : $this->load('getDiseaseRepositoryService.php')) && false ?: '_'});
