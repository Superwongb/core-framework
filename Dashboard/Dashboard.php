<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\Dashboard;

use Harryn\Jacobn\CoreFrameworkBundle\Framework\ExtendableComponentInterface;
use Harryn\Jacobn\CoreFrameworkBundle\Dashboard\Segments\NavigationInterface;
use Harryn\Jacobn\CoreFrameworkBundle\Dashboard\Segments\PanelSidebarInterface;
use Harryn\Jacobn\CoreFrameworkBundle\Dashboard\Segments\PanelSidebarItemInterface;
use Harryn\Jacobn\CoreFrameworkBundle\Dashboard\Segments\HomepageSectionInterface;
use Harryn\Jacobn\CoreFrameworkBundle\Dashboard\Segments\HomepageSectionItemInterface;
use Harryn\Jacobn\CoreFrameworkBundle\Dashboard\Segments\StylesheetResourceInterface;
use Harryn\Jacobn\CoreFrameworkBundle\Dashboard\Segments\JavascriptResourceInterface;

class Dashboard implements ExtendableComponentInterface
{
	public function __construct(DashboardTemplate $dashboardTemplate, NavigationTemplate $navigationTemplate, HomepageTemplate $homepageTemplate)
	{
		$this->homepageTemplate = $homepageTemplate;
		$this->dashboardTemplate = $dashboardTemplate;
		$this->navigationTemplate = $navigationTemplate;
	}

	public function appendNavigation(NavigationInterface $navigation, array $tags = [])
	{
		$this->navigationTemplate->appendNavigation($navigation, $tags);
	}

	public function getNavigationTemplate()
	{
		return $this->navigationTemplate;
	}

	public function appendHomepageSection(HomepageSectionInterface $homepageSection, array $tags = [])
	{
		$this->homepageTemplate->appendSection($homepageSection, $tags);
	}

	public function appendHomepageSectionItem(HomepageSectionItemInterface $homepageSectionItem, array $tags = [])
	{
		$this->homepageTemplate->appendSectionItem($homepageSectionItem, $tags);
	}

	public function getHomepageTemplate()
	{
		return $this->homepageTemplate;
	}

	public function appendStylesheetResource($stylesheet, array $tags = [])
	{
		$this->dashboardTemplate->appendStylesheet($stylesheet, $tags);
	}

	public function appendJavascriptResource($javascript, array $tags = [])
	{
		$this->dashboardTemplate->appendJavascript($javascript, $tags);
	}

	public function getDashboardTemplate()
	{
		return $this->dashboardTemplate;
	}
}
