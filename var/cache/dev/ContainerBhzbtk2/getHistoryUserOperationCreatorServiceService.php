<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'Mvc\Application\Service\HistoryUserOperationCreatorService' shared autowired service.

return $this->services['Mvc\\Application\\Service\\HistoryUserOperationCreatorService'] = new \Mvc\Application\Service\HistoryUserOperationCreatorService(${($_ = isset($this->services['Mvc\\Domain\\UserRepository']) ? $this->services['Mvc\\Domain\\UserRepository'] : $this->load('getUserRepositoryService.php')) && false ?: '_'}, ${($_ = isset($this->services['Mvc\\Domain\\HistoryUserOperationsRepository']) ? $this->services['Mvc\\Domain\\HistoryUserOperationsRepository'] : $this->load('getHistoryUserOperationsRepositoryService.php')) && false ?: '_'});