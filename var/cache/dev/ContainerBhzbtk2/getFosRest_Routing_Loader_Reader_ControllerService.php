<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'fos_rest.routing.loader.reader.controller' shared service.

@trigger_error('The fos_rest.routing.loader.reader.controller service is deprecated since FOSRestBundle 2.8.', E_USER_DEPRECATED);

return $this->services['fos_rest.routing.loader.reader.controller'] = new \FOS\RestBundle\Routing\Loader\Reader\RestControllerReader(${($_ = isset($this->services['fos_rest.routing.loader.reader.action']) ? $this->services['fos_rest.routing.loader.reader.action'] : $this->load('getFosRest_Routing_Loader_Reader_ActionService.php')) && false ?: '_'}, ${($_ = isset($this->services['annotation_reader']) ? $this->services['annotation_reader'] : $this->getAnnotationReaderService()) && false ?: '_'});