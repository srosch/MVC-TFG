<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'Mvc\Application\Service\ScheduleAddNoteService' shared autowired service.

return $this->services['Mvc\\Application\\Service\\ScheduleAddNoteService'] = new \Mvc\Application\Service\ScheduleAddNoteService(${($_ = isset($this->services['Mvc\\Domain\\UserRepository']) ? $this->services['Mvc\\Domain\\UserRepository'] : $this->load('getUserRepositoryService.php')) && false ?: '_'}, ${($_ = isset($this->services['Mvc\\Domain\\ScheduleRepository']) ? $this->services['Mvc\\Domain\\ScheduleRepository'] : $this->load('getScheduleRepositoryService.php')) && false ?: '_'});
