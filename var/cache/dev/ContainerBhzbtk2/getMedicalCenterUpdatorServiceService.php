<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'Mvc\Application\Service\MedicalCenterUpdatorService' shared autowired service.

return $this->services['Mvc\\Application\\Service\\MedicalCenterUpdatorService'] = new \Mvc\Application\Service\MedicalCenterUpdatorService(${($_ = isset($this->services['Mvc\\Domain\\UserRepository']) ? $this->services['Mvc\\Domain\\UserRepository'] : $this->load('getUserRepositoryService.php')) && false ?: '_'}, ${($_ = isset($this->services['Mvc\\Domain\\MedicalCenterRepository']) ? $this->services['Mvc\\Domain\\MedicalCenterRepository'] : $this->load('getMedicalCenterRepositoryService.php')) && false ?: '_'});
