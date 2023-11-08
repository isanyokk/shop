<?php

namespace App\EventListener;

use App\Entity\Product;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\Filesystem\Filesystem;

class ProductListener
{
    public function __construct(private readonly string $projectDir)
    {
    }

    public function prePersist(Product $product, PrePersistEventArgs $args): void
    {
        $product->setCreatedAt(new \DateTimeImmutable());
        $product->setUpdatedAt(new \DateTimeImmutable());
    }

    public function preUpdate(Product $product, PreUpdateEventArgs $args): void
    {
        if ($args->hasChangedField('photos')) {
            $fs = new Filesystem();
            foreach ($args->getEntityChangeSet()['photos'][0] as $item) {
                $filePath = sprintf("%s/%s%s", $this->projectDir, Product::IMAGES_PATH, $item['file']);
                $fs->remove($filePath);
            }
        }

        $product->setUpdatedAt(new \DateTimeImmutable());
    }
}
