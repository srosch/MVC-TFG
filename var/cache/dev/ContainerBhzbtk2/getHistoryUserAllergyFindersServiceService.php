<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'Mvc\Application\Service\HistoryUserAllergyFindersService' shared autowired service.

return $this->services['Mvc\\Application\\Service\\HistoryUserAllergyFindersService'] = new \Mvc\Application\Service\HistoryUserAllergyFindersService(${($_ = isset($this->services['Mvc\\Domain\\HistoryUserAllergyRepository']) ? $this->services['Mvc\\Domain\\HistoryUserAllergyRepository'] : $this->load('getHistoryUserAllergyRepositoryService.php')) && false ?: '_'});