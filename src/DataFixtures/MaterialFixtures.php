<?php

namespace App\DataFixtures;

use App\Entity\Material;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MaterialFixtures extends Fixture
{
    public const MATERIALS = [
        ['name' => 'UNAKITE'],
        ['name' => 'LABRADORITE'],
        ['name' => 'CALCITE'],
        ['name' => 'MALACHITE'],
        ['name' => 'OEIL DE TIGRE'],
        ['name' => 'ONYX'],
        ['name' => 'AMETHYSTE'],
        ['name' => 'ANGELITE'],
        ['name' => 'QUARTZ ROSE'],
        ['name' => 'TOURMALINE'],
        ['name' => 'LAPIS LAZULI'],
        ['name' => 'CRISTAL DE ROCHE'],
        ['name' => 'AGATE'],
        ['name' => 'AGATE DU BOTSWANA'],
        ['name' => 'SERPENTINE'],
        ['name' => 'RHODONITE'],
        ['name' => 'AMETHYSTE ZONEE'],
        ['name' => 'AVENTURINE VERTE'],
        ['name' => 'JASPE'],
        ['name' => 'DUMORTIERITE'],
        ['name' => 'HOWLITE'],
        ['name' => 'OBSIDIENNE DES NEIGES'],
        ['name' => 'OPALE'],
        ['name' => 'HEMATITE'],
        ['name' => 'QUARTZ'],
        ['name' => 'PIERRE DE LUNE'],
        ['name' => 'CHRYSOCOLLE'],
        ['name' => 'OEIL DE LUCIE'],
        ['name' => 'FELDSPATH'],
        ['name' => 'CELESTINE'],
        ['name' => 'SELENITE'],
        ['name' => 'AUTRES'],
        ['name' => 'CORNALINE'],
        ['name' => 'SEL HIMALAYA'],
        ['name' => 'PERLE'],
        ['name' => 'OEIL DE TAUREAU'],
        ['name' => 'NACRE'],
        ['name' => 'PREHNITE'],
        ['name' => 'TURQUOISE'],
        ['name' => 'AMAZONITE'],
        ['name' => 'GRENAT'],
        ['name' => 'KUNZITE'],
        ['name' => 'SODALITE'],
        ['name' => 'CITRINE'],
        ['name' => 'AIGUE MARINE'],
        ['name' => 'JADE'],
        ['name' => 'MULTIPIERRES'],
        ['name' => 'APATITE'],
        ['name' => 'PIERRE DE SOLEIL'],
        ['name' => 'ONYX INDIEN'],
        ['name' => 'AMBRE'],
        ['name' => 'LAVE'],
        ['name' => 'TANZANITE'],
        ['name' => 'BOIS FOSSILE'],
        ['name' => 'FLUORITE'],
        ['name' => 'APPRET'],
        ['name' => 'RHYOLITE'],
        ['name' => 'AGATE MOUSSE'],
        ['name' => 'LEPIDOLITE'],
        ['name' => 'RHODOCHROSITE'],
        ['name' => 'CHAINE AG'],
        ['name' => 'PALO SANTO'],
        ['name' => 'ANGE'],
        ['name' => 'SHUNGITE'],
        ['name' => 'FORFAIT REPARATION']
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::MATERIALS as $materialFixture) {
            $material = new Material();
            $material->setName($materialFixture['name']);
            $manager->persist($material);
            $this->addReference('material_' . $materialFixture['name'], $material);
        }

        $manager->flush();
    }
}
