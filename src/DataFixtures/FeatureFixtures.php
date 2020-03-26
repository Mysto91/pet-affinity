<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Feature;

class FeatureFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $feature = new Feature();
            $feature->setName("Feature ".$i)
                    ->setDescription("<p>Description n°$i</p>")
                    ->setCreatedAt(new \DateTime());

            $manager->persist($feature);
        }

        $manager->flush();
    }
}
