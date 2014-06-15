<?php

namespace EB\DoctrineBundle\Entity\Doctrine;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait SlugTrait
 *
 * @author "Emmanuel BALLERY" <emmanuel.ballery@gmail.com>
 */
trait SlugTrait
{
    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * {@inheritdoc}
     */
    public function setComputedSlug($slug)
    {
        return $this->setSlug($slug);
    }

    /**
     * {@inheritdoc}
     */
    public function getComputedSlug()
    {
        return $this->getSlug();
    }

    /**
     * Get Slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set Slug
     *
     * @param string $slug
     *
     * @return SlugTrait
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }
}
