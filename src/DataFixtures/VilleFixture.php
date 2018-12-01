<?php

namespace App\DataFixtures;

use App\Entity\Ville;
use App\Entity\Region;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use Faker\Factory;

class VilleFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create('fr_FR');
        for($i = 0; $i < 116; $i++)
        {
          $ville = new Ville();
          $ville->setNom($faker->city);
          $r = $manager->getRepository(Region::class)->findAll();
          $ville->setRegion($r[rand(38, 60)]);
          $manager->persist($ville);
        }

        $manager->flush();
    }
}
