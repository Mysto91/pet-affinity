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
        $faker = Factory::create('FR_fr');

        $genderType = array(
            'male',
            'female'
        );

        $colors = array(
            'brown',
            'black',
            'white',
            'grey'
        );

        for ($i = 0; $i < 100; $i++) {
            $pet = new Pet();
            $pet->setName($faker->words(3, true))
                ->setDescription($faker->sentences(3, true))
                ->setGender($faker->randomElement($genderType))
                ->setAge($faker->numberBetween(1, 20))
                ->setColor($faker->randomElement($colors))
                ->setSize($faker->numberBetween(20, 100));

            $manager->persist($pet);
        }

        $manager->flush();
    }
}
