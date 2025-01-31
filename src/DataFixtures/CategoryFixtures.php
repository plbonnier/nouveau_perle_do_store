<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    // public const CATEGORIES = [
    //     ['name' => 'BRACELET'],
    //     ['name' => 'COLLIER'],
    //     ['name' => 'PENDENTIF'],
    //     ['name' => 'LAMPE'],
    //     ['name' => 'BOUGEOIR'],
    //     ['name' => 'ANIMAUX'],
    //     ['name' => 'OEUF / BOULE'],
    //     ['name' => 'PIERRES ROULÉES'],
    //     ['name' => 'ARBRE DE VIE'],
    //     ['name' => 'BOUGIE'],
    //     ['name' => 'DECO'],
    //     ['name' => 'MINERAUX'],
    //     ['name' => 'FOSSILE'],
    //     ['name' => 'POINTE'],
    //     ['name' => 'AGATE TRANCHE'],
    //     ['name' => 'SELENITE'],
    //     ['name' => 'GÉODE'],
    //     ['name' => 'JEUX'],
    //     ['name' => 'BOIS'],
    //     ['name' => 'PIERRES POLIES'],
    //     ['name' => 'AUTRES'],
    //     ['name' => 'COEUR'],
    //     ['name' => 'BAGUE'],
    //     ['name' => 'BIEN ETRE'],
    //     ['name' => 'BOUCLE OREILLES'],
    //     ['name' => 'PRESENTOIR'],
    //     ['name' => 'CHAINE'],
    //     ['name' => 'PALO SANTO'],
    //     ['name' => 'MALAS'],
    //     ['name' => 'ROLLEUR'],
    //     ['name' => 'BOUTEILLE'],
    //     ['name' => 'MERKABA'],
    //     ['name' => 'HEMATITE'],
    // ];

    public function load(ObjectManager $manager): void
    {
        // foreach (self::CATEGORIES as $categoryFixture) {
        //     $category = new Category();
        //     $category->setName($categoryFixture['name']);
        //     $manager->persist($category);
        //     $this->addReference('category_' . $categoryFixture['name'], $category);
        // }
        // $manager->flush();
    }
}
