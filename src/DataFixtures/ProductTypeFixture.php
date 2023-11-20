<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\ProductType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\ORM\Doctrine\Populator;

class ProductTypeFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $populator = new Populator($faker, $manager);
        $populator->addEntity(ProductType::class, 10, ['created_at' => new \DateTimeImmutable()]);
        $populator->addEntity(Product::class, 200);
        $populator->execute();
    }


}
