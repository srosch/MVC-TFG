<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'fos_js_routing.router_debug_exposed_command' shared service.

$this->services['fos_js_routing.router_debug_exposed_command'] = $instance = new \FOS\JsRoutingBundle\Command\RouterDebugExposedCommand(${($_ = isset($this->services['fos_js_routing.extractor']) ? $this->services['fos_js_routing.extractor'] : $this->load('getFosJsRouting_ExtractorService.php')) && false ?: '_'}, ${($_ = isset($this->services['router']) ? $this->services['router'] : $this->getRouterService()) && false ?: '_'});

$instance->setName('fos:js-routing:debug');

return $instance;
