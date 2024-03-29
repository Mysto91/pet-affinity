<?php

namespace App\DataFixtures;

use App\Entity\Pet;
use App\Entity\TypePet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PetFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        $animals = array(
            "Aardvark", "Albatross", "Alligator", "Alpaca", "Ant", "Anteater", "Antelope", "Ape", "Armadillo", "Donkey", "Baboon", "Badger", "Barracuda", "Bat", "Bear", "Beaver", "Bee", "Bison", "Boar", "Buffalo", "Butterfly", "Camel", "Capybara", "Caribou", "Cassowary", "Cat", "Caterpillar", "Cattle", "Chamois", "Cheetah", "Chicken", "Chimpanzee", "Chinchilla", "Chough", "Clam", "Cobra", "Cockroach", "Cod", "Cormorant", "Coyote", "Crab", "Crane", "Crocodile", "Crow", "Curlew", "Deer", "Dinosaur", "Dog", "Dogfish", "Dolphin", "Donkey", "Dotterel", "Dove", "Dragonfly", "Duck", "Dugong", "Dunlin", "Eagle", "Echidna", "Eel", "Eland", "Elephant", "Elephant-seal", "Elk", "Emu", "Falcon", "Ferret", "Finch", "Fish", "Flamingo", "Fly", "Fox", "Frog", "Gaur", "Gazelle", "Gerbil", "Giant-panda", "Giraffe", "Gnat", "Gnu", "Goat", "Goose", "Goldfinch", "Goldfish", "Gorilla", "Goshawk", "Grasshopper", "Grouse", "Guanaco", "Guinea-fowl", "Guinea-pig", "Gull", "Hamster", "Hare", "Hawk", "Hedgehog", "Heron", "Herring", "Hippopotamus", "Hornet", "Horse", "Human", "Hummingbird", "Hyena", "Ibex", "Ibis", "Jackal", "Jaguar", "Jay", "Jellyfish", "Kangaroo", "Kingfisher", "Koala", "Komodo-dragon", "Kookabura", "Kouprey", "Kudu", "Lapwing", "Lark", "Lemur", "Leopard", "Lion", "Llama", "Lobster", "Locust", "Loris", "Louse", "Lyrebird", "Magpie", "Mallard", "Manatee", "Mandrill", "Mantis", "Marten", "Meerkat", "Mink", "Mole", "Mongoose", "Monkey", "Moose", "Mouse", "Mosquito", "Mule", "Narwhal", "Newt", "Nightingale", "Octopus", "Okapi", "Opossum", "Oryx", "Ostrich", "Otter", "Owl", "Ox", "Oyster", "Panther", "Parrot", "Partridge", "Peafowl", "Pelican", "Penguin", "Pheasant", "Pig", "Pigeon", "Polar-bear", "Pony", "Porcupine", "Porpoise", "Prairie-dog", "Quail", "Quelea", "Quetzal", "Rabbit", "Raccoon", "Rail", "Ram", "Rat", "Raven", "Red-deer", "Red-panda", "Reindeer", "Rhinoceros", "Rook", "Salamander", "Salmon", "Sand-dollar", "Sandpiper", "Sardine", "Scorpion", "Sea-lion", "Sea-urchin", "Seahorse", "Seal", "Shark", "Sheep", "Shrew", "Skunk", "Snail", "Snake", "Sparrow", "Spider", "Spoonbill", "Squid", "Squirrel", "Starling", "Stingray", "Stinkbug", "Stork", "Swallow", "Swan", "Tapir", "Tarsier", "Termite", "Tiger", "Toad", "Trout", "Turkey", "Turtle", "Vicuña", "Viper", "Vulture", "Wallaby", "Walrus", "Wasp", "Water-buffalo", "Weasel", "Whale", "Wolf", "Wolverine", "Wombat", "Woodcock", "Woodpecker", "Worm", "Wren", "Yak", "Zebra"
        );

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

        $type_array = array(
            '1' => 'dog',
            '2' => 'cat',
        );

        foreach ($type_array as $id => $type) {
            $typePet = new TypePet();
            $typePet->setId((int) $id)
                ->setName($type);
            $manager->persist($typePet);

            for ($i = 0; $i < 25; $i++) {
                $pet = new Pet();
                $pet->setName($faker->randomElement($animals))
                    ->setDescription('found in ' . $faker->departmentName)
                    ->setGender($faker->randomElement($genderType))
                    ->setAge($faker->numberBetween(1, 20))
                    ->setColor($faker->randomElement($colors))
                    ->setSize($faker->numberBetween(20, 100))
                    ->setTypePet($typePet)
                    ->setCreatedAt(new \DateTime())
                    ;

                $manager->persist($pet);
            }
        }

        $manager->flush();
    }
}
