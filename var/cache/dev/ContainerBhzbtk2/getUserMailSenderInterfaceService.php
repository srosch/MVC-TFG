<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'Mvc\Notifier\UserMailSenderInterface' shared autowired service.

return $this->services['Mvc\\Notifier\\UserMailSenderInterface'] = new \Mvc\Notifier\UserMailSender(${($_ = isset($this->services['mail_service']) ? $this->services['mail_service'] : $this->load('getMailServiceService.php')) && false ?: '_'}, ${($_ = isset($this->services['twig']) ? $this->services['twig'] : $this->getTwigService()) && false ?: '_'});