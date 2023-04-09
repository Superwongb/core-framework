<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\Dashboard;

use Twig\Environment as TwigEnvironment;
use Harryn\Jacobn\CoreFrameworkBundle\Dashboard\Segments\SearchItemInterface;
use Harryn\Jacobn\CoreFrameworkBundle\Framework\ExtendableComponentInterface;
use Harryn\Jacobn\CoreFrameworkBundle\Services\UserService;
use Symfony\Contracts\Translation\TranslatorInterface;


class SearchTemplate implements ExtendableComponentInterface
{
    private $collection = [];

    public function __construct(TwigEnvironment $twig, TranslatorInterface $translator, UserService $userService)
    {
        $this->twig = $twig;
        $this->translator = $translator;
        $this->userService = $userService;
    }

    public function appendSearchItem(SearchItemInterface $segment, $tags = [])
    {
        $this->collection[] = $segment; 
    }

    public function render()
    {
        // Compile accessible segments by end-user
		$searchCollection = [];
       
		foreach ($this->collection as $item) {
            if (in_array('getRoles', get_class_methods($item))) {
                if($item) {
                    if (null == $item::getRoles()) {
                        $searchCollection[] = $item;
                    } else {
                        foreach ($item::getRoles() as $requiredPermission) {
                            if ($this->userService->isAccessAuthorized($requiredPermission)) {
                                $searchCollection[] = $item;
        
                                break;
                            }
                        }
                    }
                }
            }
		}

        return $this->twig->render('@UVDeskCoreFramework/Templates/search.html.twig', [
            'collection' => $searchCollection
        ]);
    }
}
