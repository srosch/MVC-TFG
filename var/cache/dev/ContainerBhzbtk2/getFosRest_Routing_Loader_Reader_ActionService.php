<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'fos_rest.routing.loader.reader.action' shared service.

@trigger_error('The fos_rest.routing.loader.reader.action service is deprecated since FOSRestBundle 2.8. You can disable it by setting the config `fos_rest.routing_loader.enabled` to `false`.', E_USER_DEPRECATED);

return $this->services['fos_rest.routing.loader.reader.action'] = new \FOS\RestBundle\Routing\Loader\Reader\RestActionReader(${($_ = isset($this->services['annotation_reader']) ? $this->services['annotation_reader'] : $this->getAnnotationReaderService()) && false ?: '_'}, ${($_ = isset($this->services['fos_rest.request.param_fetcher.reader']) ? $this->services['fos_rest.request.param_fetcher.reader'] : $this->load('getFosRest_Request_ParamFetcher_ReaderService.php')) && false ?: '_'}, ${($_ = isset($this->services['fos_rest.inflector']) ? $this->services['fos_rest.inflector'] : $this->load('getFosRest_InflectorService.php')) && false ?: '_'}, true, ['json' => false, 'xml' => false, 'html' => true], true);
