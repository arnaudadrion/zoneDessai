<?php

namespace App\Twig;

use App\Composite\CabinetHierarchy\Collaborator;
use Doctrine\Common\Collections\ArrayCollection;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class CollaboratorExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('walkCollaborators', [$this, 'walkCollaborators']),
        ];
    }

    public function walkCollaborators(ArrayCollection $collaborators)
    {

    }
}