<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'Mvc\UserInterface\Http\Controller\OnlineConsultationPendingFindersGetController' shared autowired service.

return $this->services['Mvc\\UserInterface\\Http\\Controller\\OnlineConsultationPendingFindersGetController'] = new \Mvc\UserInterface\Http\Controller\OnlineConsultationPendingFindersGetController(${($_ = isset($this->services['Mvc\\Infrastructure\\CQRS\\Query\\QueryBus']) ? $this->services['Mvc\\Infrastructure\\CQRS\\Query\\QueryBus'] : $this->getQueryBusService()) && false ?: '_'}, ${($_ = isset($this->services['Mvc\\Infrastructure\\CQRS\\Command\\CommandBus']) ? $this->services['Mvc\\Infrastructure\\CQRS\\Command\\CommandBus'] : $this->load('getCommandBusService.php')) && false ?: '_'}, ${($_ = isset($this->services['autowired.Mvc\\UserInterface\\Http\\Validator\\EmptyValidator']) ? $this->services['autowired.Mvc\\UserInterface\\Http\\Validator\\EmptyValidator'] : ($this->services['autowired.Mvc\\UserInterface\\Http\\Validator\\EmptyValidator'] = new \Mvc\UserInterface\Http\Validator\EmptyValidator())) && false ?: '_'});
