<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'Mvc\Application\Service\HistoryUserDiseaseFindersService' shared autowired service.

return $this->services['Mvc\\Application\\Service\\HistoryUserDiseaseFindersService'] = new \Mvc\Application\Service\HistoryUserDiseaseFindersService(${($_ = isset($this->services['Mvc\\Domain\\HistoryUserDiseaseRepository']) ? $this->services['Mvc\\Domain\\HistoryUserDiseaseRepository'] : $this->load('getHistoryUserDiseaseRepositoryService.php')) && false ?: '_'});