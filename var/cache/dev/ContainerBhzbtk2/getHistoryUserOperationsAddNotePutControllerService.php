<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'Mvc\UserInterface\Http\Controller\HistoryUserOperationsAddNotePutController' shared autowired service.

return $this->services['Mvc\\UserInterface\\Http\\Controller\\HistoryUserOperationsAddNotePutController'] = new \Mvc\UserInterface\Http\Controller\HistoryUserOperationsAddNotePutController(${($_ = isset($this->services['Mvc\\Infrastructure\\CQRS\\Query\\QueryBus']) ? $this->services['Mvc\\Infrastructure\\CQRS\\Query\\QueryBus'] : $this->getQueryBusService()) && false ?: '_'}, ${($_ = isset($this->services['Mvc\\Infrastructure\\CQRS\\Command\\CommandBus']) ? $this->services['Mvc\\Infrastructure\\CQRS\\Command\\CommandBus'] : $this->load('getCommandBusService.php')) && false ?: '_'}, new \Mvc\UserInterface\Http\Validator\HistoryUserOperationsAddNotePutValidator());
