<?php

namespace EB\DoctrineBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use EB\DoctrineBundle\Entity\CreatedInterface;

/**
 * Class DoctrineCreatedListener
 *
 * @author "Emmanuel BALLERY" <emmanuel.ballery@gmail.com>
 */
class DoctrineCreatedListener
{
    /**
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof CreatedInterface) {
            if (null === $entity->getCreated()) {
                $entity->setCreated(new \DateTime());
            }
        }
    }
}
