<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'Mvc\Application\Service\VaccineFindersService' shared autowired service.

return $this->services['Mvc\\Application\\Service\\VaccineFindersService'] = new \Mvc\Application\Service\VaccineFindersService(${($_ = isset($this->services['Mvc\\Domain\\UserRepository']) ? $this->services['Mvc\\Domain\\UserRepository'] : $this->load('getUserRepositoryService.php')) && false ?: '_'}, ${($_ = isset($this->services['Mvc\\Domain\\VaccineRepository']) ? $this->services['Mvc\\Domain\\VaccineRepository'] : $this->load('getVaccineRepositoryService.php')) && false ?: '_'});