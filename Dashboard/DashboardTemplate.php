<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\Dashboard;

use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Harryn\Jacobn\CoreFrameworkBundle\Framework\ExtendableComponentInterface;
use Harryn\Jacobn\CoreFrameworkBundle\Dashboard\Segments\StylesheetResourceInterface;
use Harryn\Jacobn\CoreFrameworkBundle\Dashboard\Segments\JavascriptResourceInterface;

class DashboardTemplate implements ExtendableComponentInterface
{
    private $scripts = [];
    private $stylesheets = [];

	public function __construct(ContainerInterface $container, RequestStack $requestStack, RouterInterface $router)
	{
		$this->router = $router;
		$this->container = $container;
		$this->requestStack = $requestStack;
    }
    
    public function appendJavascript($javascript, $tags = [])
	{
		$this->scripts[] = $javascript;
    }

    public function getJavascriptResources()
    {
        return $this->scripts;
    }

	public function appendStylesheet($stylesheet, $tags = [])
	{
		$this->stylesheets[] = $stylesheet;
    }

    public function getStylesheetResources()
    {
        return $this->stylesheets;
    }
}
