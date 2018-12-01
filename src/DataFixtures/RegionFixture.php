<?php

namespace App\DataFixtures;

use App\Entity\Region;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use Faker\Factory;

class RegionFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        // $faker = Factory::create('fr_FR');
        // for($i = 0; $i < 30; $i++)
        // {
        //   $region = new Region();
        //   $region->setNom($faker->words(1, true));
        //   $region->setLocalisation($faker->numberBetween(0, 4));
        //   $manager->persist($region);
        // }
        $manager->flush();
    }
}
