<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'monolog.logger.snappy' shared service.

$this->services['monolog.logger.snappy'] = $instance = new \Symfony\Bridge\Monolog\Logger('snappy');

$instance->pushHandler(${($_ = isset($this->services['monolog.handler.output']) ? $this->services['monolog.handler.output'] : $this->getMonolog_Handler_OutputService()) && false ?: '_'});
$instance->pushHandler(${($_ = isset($this->services['monolog.handler.console']) ? $this->services['monolog.handler.console'] : $this->getMonolog_Handler_ConsoleService()) && false ?: '_'});
$instance->pushHandler(${($_ = isset($this->services['monolog.handler.main']) ? $this->services['monolog.handler.main'] : $this->getMonolog_Handler_MainService()) && false ?: '_'});

return $instance;
