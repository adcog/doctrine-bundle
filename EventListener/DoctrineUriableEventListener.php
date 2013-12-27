<?php

namespace EB\DoctrineBundle\EventListener;

use Doctrine\ORM\Event\PreUpdateEventArgs;
use EB\DoctrineBundle\Entity\UriableInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use EB\StringBundle\Twig\Extension\StringExtension;

/**
 * Class DoctrineUriableEventListener
 *
 * @author "Emmanuel BALLERY" <emmanuel.ballery@gmail.com>
 */
class DoctrineUriableEventListener
{
    /**
     * @var StringExtension
     */
    private $string;

    /**
     * @param StringExtension $string
     */
    public function __construct(StringExtension $string)
    {
        $this->string = $string;
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof UriableInterface) {
            $entity->setUri($this->string->uri($entity->getStringToUri()));
        }
    }

    /**
     * @param PreUpdateEventArgs $args
     */
    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof UriableInterface) {
            $entity->setUri($this->string->uri($entity->getStringToUri()));

            // Save new value
            $mdt = $args->getEntityManager()->getClassMetadata(get_class($entity));
            $args->getEntityManager()->getUnitOfWork()->recomputeSingleEntityChangeSet($mdt, $entity);
        }
    }
}