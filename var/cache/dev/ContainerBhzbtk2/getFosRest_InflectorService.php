<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'fos_rest.inflector' shared service.

@trigger_error('The fos_rest.inflector service is deprecated since FOSRestBundle 2.8.', E_USER_DEPRECATED);

return $this->services['fos_rest.inflector'] = new \FOS\RestBundle\Inflector\DoctrineInflector();
