<?php

namespace App\DataFixtures;

use App\Entity\Commune;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use Faker\Factory;

class CommuneFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        // $faker = Factory::create('fr_FR');
        // for($i = 0; $i < 300; $i++)
        // {
        //   $commune = new Commune();
        //   $commune->setNom($faker->words(1, true));
        //   $commune->setVille($faker->numberBetween(1, 116));
        //   $commune->setNombreHabitants($faker->numberBetween(2000, 3000000));
        //   $commune->setTauxMusulmans($faker->numberBetween(10, 75));
        //   $commune->setNom($faker->words(1, true));
        //   $manager->persist($commune);
        // }

        $manager->flush();
    }
}
