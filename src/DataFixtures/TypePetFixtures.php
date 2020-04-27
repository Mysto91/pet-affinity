<?php

namespace App\DataFixtures;

use App\Entity\TypePet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class TypePetFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        $type_array = array(
            '1' => 'dog',
            '2' => 'cat',
        );

        foreach ($type_array as $id => $type) {
            $typePet = new TypePet();
            $typePet->setId((int) $id)
                ->setName($type);
            $manager->persist($typePet);
        }

        $manager->flush();
    }
}
