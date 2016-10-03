<?php

namespace Victoire\Widget\PollBundle\EventSubscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Mapping\ClassMetadata;
use Victoire\Bundle\BusinessEntityBundle\Reader\BusinessEntityCacheReader;

/**
 * This class build the entity EntityProxy with activated widgets relations.
 **/
class VotingSubscriber implements EventSubscriber
{
    private $userClass;

    /**
     * contructor.
     *
     * @param BusinessEntityCacheReader $cacheReader
     */
    public function __construct($userClass)
    {
        $this->userClass = $userClass;
    }

    /**
     * bind to LoadClassMetadata method.
     *
     * @return string[]
     */
    public function getSubscribedEvents()
    {
        return [
            'loadClassMetadata',
        ];
    }

    /**
     * @param LoadClassMetadataEventArgs $eventArgs
     */
    public function loadClassMetadata($eventArgs)
    {
        if ($eventArgs instanceof LoadClassMetadataEventArgs) {
            /** @var ClassMetadata $metadatas */
            $metadatas = $eventArgs->getClassMetadata();
            if ($metadatas->name === 'Victoire\Widget\PollBundle\Entity\Voting') {
                if (!$metadatas->hasAssociation('user')) {
                    $metadatas->mapManyToOne([
                            'fieldName' => 'user',
                            'targetEntity' => $this->userClass,
                            'cascade' => ['persist'],
                        ]
                    );
                }
            }
        }
    }
}
