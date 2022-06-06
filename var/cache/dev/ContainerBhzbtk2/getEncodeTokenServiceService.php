<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'Mvc\Application\Service\EncodeTokenService' shared autowired service.

return $this->services['Mvc\\Application\\Service\\EncodeTokenService'] = new \Mvc\Application\Service\EncodeTokenService(${($_ = isset($this->services['security.password_encoder']) ? $this->services['security.password_encoder'] : $this->load('getSecurity_PasswordEncoderService.php')) && false ?: '_'}, ${($_ = isset($this->services['Mvc\\Domain\\Factory\\TokenFactory']) ? $this->services['Mvc\\Domain\\Factory\\TokenFactory'] : ($this->services['Mvc\\Domain\\Factory\\TokenFactory'] = new \Mvc\Domain\Factory\SimpleTokenFactory('secret123456S*', 14))) && false ?: '_'}, ${($_ = isset($this->services['Mvc\\Domain\\UserRepository']) ? $this->services['Mvc\\Domain\\UserRepository'] : $this->load('getUserRepositoryService.php')) && false ?: '_'});