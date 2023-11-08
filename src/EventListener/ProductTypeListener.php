<?php

namespace App\EventListener;

use App\Entity\ProductType;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

#[AsEntityListener(event: Events::prePersist, entity: ProductType::class)]
#[AsEntityListener(event: Events::preUpdate, entity: ProductType::class)]
class ProductTypeListener
{
    public function __construct(
        private readonly SluggerInterface $slugger
    ){}

    public function prePersist(ProductType $type, LifecycleEventArgs $args): void
    {
        $type->computeSlug($this->slugger);
    }

    public function preUpdate(ProductType $type, LifecycleEventArgs $args): void
    {
        $type->computeSlug($this->slugger);
    }
}