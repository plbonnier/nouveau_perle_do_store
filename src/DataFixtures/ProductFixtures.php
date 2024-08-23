<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public const PRODUCTS = [
        [
            'name' => 'LABRADORITE',
            'ref' => 1,
            'price' => 80.00,
            'quantity' => 2,
            'category' => 'category_PIERRES POLIES',
            'material' => 'material_LABRADORITE'
        ],
        [
            'name' => 'LABRADORITE',
            'ref' => 2,
            'price' => 42.00,
            'quantity' => 2,
            'category' => 'category_PIERRES POLIES',
            'material' => 'material_LABRADORITE'
        ],
        [
            'name' => 'LABRADORITE',
            'ref' => 3,
            'price' => 38.00,
            'quantity' => 2,
            'category' => 'category_PIERRES POLIES',
            'material' => 'material_LABRADORITE'
        ],
        [
            'name' => 'PIERRE DE LUNE',
            'ref' => 4,
            'price' => 50.00,
            'quantity' => 2,
            'category' => 'category_PIERRES POLIES',
            'material' => 'material_PIERRE DE LUNE'
        ],
        [
            'name' => 'PIERRE DE LUNE',
            'ref' => 5,
            'price' => 72.00,
            'quantity' => 2,
            'category' => 'category_PIERRES POLIES',
            'material' => 'material_PIERRE DE LUNE'
        ],
        [
            'name' => 'PIERRE DE LUNE ORANGÉE',
            'ref' => 6,
            'price' => 90.00,
            'quantity' => 2,
            'category' => 'category_PIERRES POLIES',
            'material' => 'material_PIERRE DE LUNE'
        ],
        [
            'name' => 'OPALE',
            'ref' => 7,
            'price' => 60.00,
            'quantity' => 2,
            'category' => 'category_AUTRES',
            'material' => 'material_AUTRES'
        ],
        [
            'name' => 'OPALE',
            'ref' => 8,
            'price' => 94.50,
            'quantity' => 2,
            'category' => 'category_AUTRES',
            'material' => 'material_AUTRES'
        ],
        [
            'name' => 'OPALE',
            'ref' =>  9,
            'price' => 100.00,
            'quantity' => 2,
            'category' => 'category_AUTRES',
            'material' => 'material_AUTRES'
        ],
        [
            'name' => 'OPALE',
            'ref' => 10,
            'price' => 100.00,
            'quantity' => 2,
            'category' => 'category_AUTRES',
            'material' => 'material_AUTRES'
        ],
        [
            'name' => 'PENDENTIF ROND CHRYSOCOLLE',
            'ref' => 11,
            'price' => 30.00,
            'quantity' => 2,
            'category' => 'category_PENDENTIF',
            'material' => 'material_CHRYSOCOLLE'
        ],
        [
            'name' => 'PENDENTIF COEUR OEIL DE LUCIE',
            'ref' => 12,
            'price' => 33.00,
            'quantity' => 2,
            'category' => 'category_PENDENTIF',
            'material' => 'material_OEIL DE LUCIE'
        ],
        [
            'name' => 'PENDENTIF ROND MULTI',
            'ref' => 13,
            'price' => 30.00,
            'quantity' => 2,
            'category' => 'category_PENDENTIF',
            'material' => 'material_JASPE'
        ],
        [
            'name' => 'PENDENTIF ROND OPALE BLEUE',
            'ref' => 14,
            'price' => 30.00,
            'quantity' => 2,
            'category' => 'category_PENDENTIF',
            'material' => 'material_OPALE'
        ],
        [
            'name' => 'PENDENTIF TRIANGLE JASPE K2',
            'ref' => 15,
            'price' => 30.00,
            'quantity' => 2,
            'category' => 'category_PENDENTIF',
            'material' => 'material_JASPE'
        ],
        [
            'name' => 'PENDENTIF MARQUISE FELDSPATH',
            'ref' => 16,
            'price' => 30.00,
            'quantity' => 2,
            'category' => 'category_PENDENTIF',
            'material' => 'material_FELDSPATH'
        ],
        [
            'name' => 'PENDENTIF GOUTTE MOOKAITE',
            'ref' => 17,
            'price' => 30.00,
            'quantity' => 2,
            'category' => 'category_PENDENTIF',
            'material' => 'material_JASPE'
        ],
        [
            'name' => 'PENDENTIF ROND AGATE DENTRITE',
            'ref' => 18,
            'price' => 18.00,
            'quantity' => 2,
            'category' => 'category_PENDENTIF',
            'material' => 'material_AGATE'
        ],
        [
            'name' => 'PENDENTIF ROND OPALE DENTRITE',
            'ref' => 19,
            'price' => 15.00,
            'quantity' => 2,
            'category' => 'category_PENDENTIF',
            'material' => 'material_OPALE'
        ],
        [
            'name' => 'QUARTZ ROSE BRUT',
            'ref' => 20,
            'price' => 2.00,
            'quantity' => 2,
            'category' => 'category_MINERAUX',
            'material' => 'material_QUARTZ'
        ],
        [
            'name' => 'QUARTZ BLANC BRUT',
            'ref' => 21,
            'price' => 2.00,
            'quantity' => 2,
            'category' => 'category_MINERAUX',
            'material' => 'material_QUARTZ'
        ],
        [
            'name' => 'AVENTURINE VERTE',
            'ref' => 22,
            'price' => 2.00,
            'quantity' => 2,
            'category' => 'category_MINERAUX',
            'material' => 'material_AVENTURINE VERTE'
        ],
        [
            'name' => 'JASPE ZEBRE',
            'ref' => 23,
            'price' => 2.00,
            'quantity' => 2,
            'category' => 'category_MINERAUX',
            'material' => 'material_JASPE'
        ],
        [
            'name' => 'LAPIS LAZULI',
            'ref' => 24,
            'price' => 75.00,
            'quantity' => 2,
            'category' => 'category_PIERRES POLIES',
            'material' => 'material_LAPIS LAZULI'
        ],
        [
            'name' => 'LAPIS LAZULI',
            'ref' => 25,
            'price' => 130.00,
            'quantity' => 2,
            'category' => 'category_PIERRES POLIES',
            'material' => 'material_LAPIS LAZULI'
        ],
        [
            'name' => 'SELENITE CASCADE S',
            'ref' => 26,
            'price' => 12.00,
            'quantity' => 2,
            'category' => 'category_SELENITE',
            'material' => 'material_SELENITE'
        ],
        [
            'name' => 'SELENITE CASCADE M',
            'ref' => 27,
            'price' => 16.00,
            'quantity' => 2,
            'category' => 'category_SELENITE',
            'material' => 'material_SELENITE'
        ],
        [
            'name' => 'SPHERE SELENITE',
            'ref' => 28,
            'price' => 25.00,
            'quantity' => 2,
            'category' => 'category_SELENITE',
            'material' => 'material_SELENITE'
        ],
        [
            'name' => 'PALET SELENITE METATRON',
            'ref' => 29,
            'price' => 20.00,
            'quantity' => 2,
            'category' => 'category_SELENITE',
            'material' => 'material_SELENITE'
        ],
        [
            'name' => 'PALET SELENITE',
            'ref' => 30,
            'price' => 17.00,
            'quantity' => 2,
            'category' => 'category_SELENITE',
            'material' => 'material_SELENITE'
        ],
        [
            'name' => 'BOUGEOIR SELENITE',
            'ref' => 31,
            'price' => 20.00,
            'quantity' => 2,
            'category' => 'category_BOUGEOIR',
            'material' => 'material_SELENITE'
        ],
        [
            'name' => 'POINTE CALCITE',
            'ref' => 32,
            'price' => 22.00,
            'quantity' => 2,
            'category' => 'category_POINTE',
            'material' => 'material_CALCITE'
        ],
        [
            'name' => 'POINTE CALCITE',
            'ref' => 33,
            'price' => 20.00,
            'quantity' => 2,
            'category' => 'category_POINTE',
            'material' => 'material_CALCITE'
        ],
        [
            'name' => 'POINTE CALCITE',
            'ref' => 34,
            'price' => 25.00,
            'quantity' => 2,
            'category' => 'category_POINTE',
            'material' => 'material_CALCITE'
        ],
        [
            'name' => 'POINTE QUARTZ',
            'ref' => 35,
            'price' => 35.00,
            'quantity' => 2,
            'category' => 'category_POINTE',
            'material' => 'material_QUARTZ'
        ],
        [
            'name' => 'AMETHYSTE',
            'ref' => 36,
            'price' => 75.00,
            'quantity' => 2,
            'category' => 'category_GÉODE',
            'material' => 'material_AMETHYSTE'
        ],
        [
            'name' => 'AMETHYSTE',
            'ref' => 37,
            'price' => 40.00,
            'quantity' => 2,
            'category' => 'category_GÉODE',
            'material' => 'material_AMETHYSTE'
        ],
        [
            'name' => 'AMETHYSTE',
            'ref' => 38,
            'price' => 60.00,
            'quantity' => 2,
            'category' => 'category_GÉODE',
            'material' => 'material_AMETHYSTE'
        ],
        [
            'name' => 'AMETHYSTE',
            'ref' => 39,
            'price' => 50.00,
            'quantity' => 2,
            'category' => 'category_GÉODE',
            'material' => 'material_AMETHYSTE'
        ],
        [
            'name' => 'AMETHYSTE',
            'ref' => 40,
            'price' => 48.00,
            'quantity' => 2,
            'category' => 'category_GÉODE',
            'material' => 'material_AMETHYSTE'
        ],
        [
            'name' => 'AMETHYSTE',
            'ref' => 41,
            'price' => 55.00,
            'quantity' => 2,
            'category' => 'category_GÉODE',
            'material' => 'material_AMETHYSTE'
        ],
        [
            'name' => 'AMETHYSTE SOCLE',
            'ref' => 42,
            'price' => 15.00,
            'quantity' => 2,
            'category' => 'category_GÉODE',
            'material' => 'material_AMETHYSTE'
        ],
        [
            'name' => 'AMETHYSTE SOCLE',
            'ref' => 43,
            'price' => 25.00,
            'quantity' => 2,
            'category' => 'category_GÉODE',
            'material' => 'material_AMETHYSTE'
        ],
        [
            'name' => 'PLAQUE AMETHYSTE',
            'ref' => 44,
            'price' => 10.00,
            'quantity' => 2,
            'category' => 'category_GÉODE',
            'material' => 'material_AMETHYSTE'
        ],
        [
            'name' => 'PLAQUE AMETHYSTE',
            'ref' => 45,
            'price' => 15.00,
            'quantity' => 2,
            'category' => 'category_GÉODE',
            'material' => 'material_AMETHYSTE'
        ],
        [
            'name' => 'PLAQUE AMETHYSTE',
            'ref' => 46,
            'price' => 13.00,
            'quantity' => 2,
            'category' => 'category_GÉODE',
            'material' => 'material_AMETHYSTE'
        ],
        [
            'name' => 'PLAQUE AMETHYSTE',
            'ref' => 47,
            'price' => 20.00,
            'quantity' => 2,
            'category' => 'category_GÉODE',
            'material' => 'material_AMETHYSTE'
        ],
        [
            'name' => 'PLAQUE AMETHYSTE',
            'ref' => 48,
            'price' => 20.00,
            'quantity' => 2,
            'category' => 'category_GÉODE',
            'material' => 'material_AMETHYSTE'
        ],
        [
            'name' => 'PLAQUE AMETHYSTE',
            'ref' => 49,
            'price' => 13.00,
            'quantity' => 2,
            'category' => 'category_GÉODE',
            'material' => 'material_AMETHYSTE'
        ],
        [
            'name' => 'PLAQUE AMETHYSTE',
            'ref' => 50,
            'price' => 15.00,
            'quantity' => 2,
            'category' => 'category_GÉODE',
            'material' => 'material_AMETHYSTE'
        ],
        [
            'name' => 'PLAQUE AMETHYSTE',
            'ref' => 51,
            'price' => 15.00,
            'quantity' => 2,
            'category' => 'category_GÉODE',
            'material' => 'material_AMETHYSTE'
        ],
        [
            'name' => 'SOCLE QUARTZ ROSE',
            'ref' => 52,
            'price' => 12.00,
            'quantity' => 2,
            'category' => 'category_DECO',
            'material' => 'material_QUARTZ ROSE'
        ],
        [
            'name' => 'SOCLE AVENTURINE VERTE',
            'ref' => 53,
            'price' => 12.00,
            'quantity' => 2,
            'category' => 'category_DECO',
            'material' => 'material_AVENTURINE VERTE'
        ],
        [
            'name' => 'BOUGEOIR AGATE',
            'ref' => 54,
            'price' => 30.00,
            'quantity' => 2,
            'category' => 'category_BOUGEOIR',
            'material' => 'material_AGATE'
        ],
        [
            'name' => 'BOUGEOIR AGATE',
            'ref' => 55,
            'price' => 30.00,
            'quantity' => 2,
            'category' => 'category_BOUGEOIR',
            'material' => 'material_AGATE'
        ],
        [
            'name' => 'SPHERE QUARTZ ROSE',
            'ref' => 56,
            'price' => 130.00,
            'quantity' => 2,
            'category' => 'category_OEUF / BOULE',
            'material' => 'material_QUARTZ ROSE'
        ],
        [
            'name' => 'SPHERE CHRYSOCOLLE',
            'ref' => 57,
            'price' => 90.00,
            'quantity' => 2,
            'category' => 'category_OEUF / BOULE',
            'material' => 'material_CHRYSOCOLLE'
        ],
        [
            'name' => 'SPHERE CHRYSOCOLLE',
            'ref' => 58,
            'price' => 50.00,
            'quantity' => 2,
            'category' => 'category_OEUF / BOULE',
            'material' => 'material_CHRYSOCOLLE'
        ],
        [
            'name' => 'BRACELET PERLE',
            'ref' => 59,
            'price' => 30.00,
            'quantity' => 2,
            'category' => 'category_BRACELET',
            'material' => 'material_PERLE'
        ],
        [
            'name' => 'BRACELET JADE NEPHRITE',
            'ref' => 60,
            'price' => 30.00,
            'quantity' => 2,
            'category' => 'category_BRACELET',
            'material' => 'material_JADE'
        ],
        [
            'name' => 'BRACELET QUARTZ ROSE ENFANT',
            'ref' => 61,
            'price' => 12.00,
            'quantity' => 2,
            'category' => 'category_BRACELET',
            'material' => 'material_QUARTZ ROSE'
        ],
        [
            'name' => 'BRACELET OEIL DE TIGRE 6MM',
            'ref' => 62,
            'price' => 16.00,
            'quantity' => 2,
            'category' => 'category_BRACELET',
            'material' => 'material_OEIL DE TIGRE'
        ],
        [
            'name' => 'BRACELET AMETHYSTE ENFANT',
            'ref' => 63,
            'price' => 13.00,
            'quantity' => 2,
            'category' => 'category_BRACELET',
            'material' => 'material_AMETHYSTE'
        ],
        [
            'name' => 'BRACELET OEIL DE TAUREAU',
            'ref' => 64,
            'price' => 20.00,
            'quantity' => 2,
            'category' => 'category_BRACELET',
            'material' => 'material_OEIL DE TAUREAU'
        ],
        [
            'name' => 'BRACELET CALCITE',
            'ref' => 65,
            'price' => 22.00,
            'quantity' => 2,
            'category' => 'category_BRACELET',
            'material' => 'material_CALCITE'
        ],
        [
            'name' => 'BRACELET CORNALINE',
            'ref' => 66,
            'price' => 20.00,
            'quantity' => 2,
            'category' => 'category_BRACELET',
            'material' => 'material_CORNALINE'
        ],
        [
            'name' => 'BRACELET OEIL DE TIGRE 8MM',
            'ref' => 67,
            'price' => 22.00,
            'quantity' => 2,
            'category' => 'category_BRACELET',
            'material' => 'material_OEIL DE TIGRE'
        ],
        [
            'name' => 'BRACELET QUARTZ ROSE',
            'ref' => 68,
            'price' => 16.00,
            'quantity' => 2,
            'category' => 'category_BRACELET',
            'material' => 'material_QUARTZ ROSE'
        ],
        [
            'name' => 'BRACELET NACRE',
            'ref' => 69,
            'price' => 25.00,
            'quantity' => 2,
            'category' => 'category_BRACELET',
            'material' => 'material_NACRE'
        ],
        [
            'name' => 'BRACELET PHRENITE - 6mm',
            'ref' => 70,
            'price' => 30.00,
            'quantity' => 2,
            'category' => 'category_BRACELET',
            'material' => 'material_PREHNITE'
        ],
        [
            'name' => 'BRACELET TURQUOISE PÉROU',
            'ref' => 71,
            'price' => 48.00,
            'quantity' => 2,
            'category' => 'category_BRACELET',
            'material' => 'material_TURQUOISE'
        ],
        [
            'name' => 'BRACELET PIERRE DE LUNE',
            'ref' => 72,
            'price' => 30.00,
            'quantity' => 2,
            'category' => 'category_BRACELET',
            'material' => 'material_PIERRE DE LUNE'
        ],
        [
            'name' => 'BRACELET AMAZONITE',
            'ref' => 73,
            'price' => 35.00,
            'quantity' => 2,
            'category' => 'category_BRACELET',
            'material' => 'material_AMAZONITE'
        ],
        [
            'name' => 'COEUR COUPLE',
            'ref' => 74,
            'price' => 30.00,
            'quantity' => 2,
            'category' => 'category_BOIS',
            'material' => 'material_AUTRES'
        ],
        [
            'name' => 'PLATEAU OM',
            'ref' => 75,
            'price' => 35.00,
            'quantity' => 2,
            'category' => 'category_BOIS',
            'material' => 'material_AUTRES'
        ],
        [
            'name' => 'BOUDDHA RELAX A GENOU',
            'ref' => 76,
            'price' => 40.00,
            'quantity' => 2,
            'category' => 'category_BOIS',
            'material' => 'material_AUTRES'
        ],
        [
            'name' => 'PIERRE ROULÉE CRISTAL DE ROCHE',
            'ref' => 77,
            'price' => 5.00,
            'quantity' => 2,
            'category' => 'category_PIERRES ROULÉES',
            'material' => 'material_CRISTAL DE ROCHE'
        ],
        [
            'name' => 'COLLIER CALCITE ORANGE 6mm',
            'ref' => 78,
            'price' => 30.00,
            'quantity' => 2,
            'category' => 'category_COLLIER',
            'material' => 'material_CALCITE'
        ],
        [
            'name' => 'PIERRE ROULÉE ONYX',
            'ref' => 79,
            'price' => 5.00,
            'quantity' => 2,
            'category' => 'category_PIERRES ROULÉES',
            'material' => 'material_ONYX'
        ],
        [
            'name' => 'PIERRE ROULÉE ONYX',
            'ref' => 80,
            'price' => 6.00,
            'quantity' => 2,
            'category' => 'category_PIERRES ROULÉES',
            'material' => 'material_ONYX'
        ],
        [
            'name' => 'PIERRE ROULÉE OEIL DE TIGRE - S',
            'ref' => 81,
            'price' => 3.00,
            'quantity' => 2,
            'category' => 'category_PIERRES ROULÉES',
            'material' => 'material_OEIL DE TIGRE'
        ],
        [
            'name' => 'PIERRE ROULÉE OEIL DE TIGRE - L',
            'ref' => 82,
            'price' => 5.00,
            'quantity' => 2,
            'category' => 'category_PIERRES ROULÉES',
            'material' => 'material_OEIL DE TIGRE'
        ],
        [
            'name' => 'PIERRE ROULÉE OEIL DE TIGRE -L',
            'ref' => 83,
            'price' => 6.00,
            'quantity' => 2,
            'category' => 'category_PIERRES ROULÉES',
            'material' => 'material_OEIL DE TIGRE'
        ],
        [
            'name' => 'PIERRE ROULÉE OEIL DE TIGRE - L',
            'ref' => 84,
            'price' => 7.00,
            'quantity' => 2,
            'category' => 'category_PIERRES ROULÉES',
            'material' => 'material_OEIL DE TIGRE'
        ],
        [
            'name' => 'BOUGEOIR EN SEL FER FORGÉ',
            'ref' => 85,
            'price' => 30.00,
            'quantity' => 2,
            'category' => 'category_BOUGEOIR',
            'material' => 'material_SEL HIMALAYA'
        ],
        [
            'name' => 'PIERRE ROULÉE AGATE BOTSWANA',
            'ref' => 86,
            'price' => 6.00,
            'quantity' => 2,
            'category' => 'category_PIERRES ROULÉES',
            'material' => 'material_AGATE'
        ],
        [
            'name' => 'PIERRE ROULÉE AGATE DU BOTSWANA',
            'ref' => 87,
            'price' => 3.00,
            'quantity' => 2,

            'category' => 'category_PIERRES ROULÉES',
            'material' => 'material_AGATE'
        ],
        [
            'name' => 'PIERRE ROULÉE LABRADORITE',
            'ref' => 88,
            'price' => 10.00,
            'quantity' => 2,
            'category' => 'category_PIERRES ROULÉES',
            'material' => 'material_LABRADORITE'
        ],
        [
            'name' => 'PIERRE ROULÉE CALCITE',
            'ref' => 89,
            'price' => 6.00,
            'quantity' => 2,
            'category' => 'category_PIERRES ROULÉES',
            'material' => 'material_CALCITE'
        ],
        [
            'name' => 'PIERRE ROULÉE CALCITE',
            'ref' => 90,
            'price' => 5.00,
            'quantity' => 2,
            'category' => 'category_PIERRES ROULÉES',
            'material' => 'material_CALCITE'
        ],
        [
            'name' => 'PIERRE ROULÉE CALCITE',
            'ref' => 91,
            'price' => 3.00,
            'quantity' => 2,
            'category' => 'category_PIERRES ROULÉES',
            'material' => 'material_CALCITE'
        ],
        [
            'name' => 'PIERRE ROULÉE UNAKITE',
            'ref' => 92,
            'price' => 7.00,
            'quantity' => 2,
            'category' => 'category_PIERRES ROULÉES',
            'material' => 'material_UNAKITE'
        ],
        [
            'name' => 'PIERRE ROULÉE UNAKITE',
            'ref' => 93,
            'price' => 6.00,
            'quantity' => 2,
            'category' => 'category_PIERRES ROULÉES',
            'material' => 'material_UNAKITE'
        ],
        [
            'name' => 'PIERRE ROULÉE UNAKITE',
            'ref' => 94,
            'price' => 4.00,
            'quantity' => 2,
            'category' => 'category_PIERRES ROULÉES',
            'material' => 'material_UNAKITE'
        ],
        [
            'name' => 'PIERRE ROULÉE CORNALINE',
            'ref' => 95,
            'price' => 4.00,
            'quantity' => 2,
            'category' => 'category_PIERRES ROULÉES',
            'material' => 'material_CORNALINE'
        ],
        [
            'name' => 'PIERRE ROULÉE QUARTZ ROSE MADAGASCAR',
            'ref' => 96,
            'price' => 7.00,
            'quantity' => 2,
            'category' => 'category_PIERRES ROULÉES',
            'material' => 'material_QUARTZ ROSE'
        ],
        [
            'name' => 'PIERRE ROULÉE ANGELITE',
            'ref' => 97,
            'price' => 8.00,
            'quantity' => 2,
            'category' => 'category_PIERRES ROULÉES',
            'material' => 'material_ANGELITE'
        ],
        [
            'name' => 'PIERRE ROULÉE TOURMALINE NOIR',
            'ref' => 98,
            'price' => 6.00,
            'quantity' => 2,
            'category' => 'category_PIERRES ROULÉES',
            'material' => 'material_TOURMALINE'
        ],
        [
            'name' => 'PIERRE ROULÉE TOURMALINE NOIR',
            'ref' => 99,
            'price' => 7.00,
            'quantity' => 2,
            'category' => 'category_PIERRES ROULÉES',
            'material' => 'material_TOURMALINE'
        ],
        [
            'name' => 'PIERRE ROULÉE LAPIS LAZULI',
            'ref' => 100,
            'price' => 10.00,
            'quantity' => 2,
            'category' => 'category_PIERRES ROULÉES',
            'material' => 'material_LAPIS LAZULI'
        ],
        [
            'name' => 'PIERRE ROULÉE LAPIS LAZULI',
            'ref' => 101,
            'price' => 7.00,
            'quantity' => 2,
            'category' => 'category_PIERRES ROULÉES',
            'material' => 'material_LAPIS LAZULI'
        ],
        [
            'name' => 'PIERRE ROULÉE LAPIS LAZULI',
            'ref' => 102,
            'price' => 6.00,
            'quantity' => 2,
            'category' => 'category_PIERRES ROULÉES',
            'material' => 'material_LAPIS LAZULI'
        ],
        [
            'name' => 'PIERRE ROULÉE LAPIS LAZULI',
            'ref' => 103,
            'price' => 4.00,
            'quantity' => 2,
            'category' => 'category_PIERRES ROULÉES',
            'material' => 'material_LAPIS LAZULI'
        ],
        [
            'name' => 'TRANCHE D\'AGATE',
            'ref' => 104,
            'price' => 1.00,
            'quantity' => 2,
            'category' => 'category_AGATE TRANCHE',
            'material' => 'material_AGATE'
        ],
        [
            'name' => 'CALCITE BRUT',
            'ref' => 105,
            'price' => 225.00,
            'quantity' => 2,
            'category' => 'category_MINERAUX',
            'material' => 'material_CALCITE'
        ]
        //105
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::PRODUCTS as $productFixture) {
            $product = new Product();
            $product->setName($productFixture['name']);
            $product->setRef($productFixture['ref']);
            $product->setPrice($productFixture['price']);
            $product->setquantity($productFixture['quantity']);
            $product->setCategory($this->getReference($productFixture['category']));
            $product->setMaterial($this->getReference($productFixture['material']));
            $manager->persist($product);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [CategoryFixtures::class, MaterialFixtures::class];
    }
}
