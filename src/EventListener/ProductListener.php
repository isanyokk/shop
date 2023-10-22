<?php

namespace App\EventListener;

use App\Entity\Product;
use Doctrine\ORM\Event\PostPersistEventArgs;
use Doctrine\ORM\Event\PostUpdateEventArgs;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

class ProductListener
{
    public function prePersist(Product $product, PrePersistEventArgs $args): void
    {
        $product->setCreatedAt(new \DateTimeImmutable());
        $product->setUpdatedAt(new \DateTimeImmutable());
    }

    public function preUpdate(Product $product, PreUpdateEventArgs $args): void
    {
        $product->setUpdatedAt(new \DateTimeImmutable());
    }
}
