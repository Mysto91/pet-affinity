<?php

namespace App\DataFixtures;

use App\Entity\Pet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class PetFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        
        for ($i = 0; $i < 10; $i++) {
            $pet = new Pet();
            $pet->setName("Feature ".$i)
                    ->setDescription("Description n°$i")
                    ;

            $manager->persist($feature);
        }

        $manager->flush();
    }
}
