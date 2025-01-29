<?php

namespace App\DataFixtures;

use App\Entity\TypeCustomer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeCustomerFixtures extends Fixture
{
    public const TYPE_CUSTOMER_REFERENCE = [
        [
            'type' => 'particulier',
            'discount' => 0,
        ],
        [
            'type' => 'commerçant',
            'discount' => 0.1,
        ],
        [
            'type' => 'police',
            'discount' => 0.1,
        ],
        [
            'type' => 'pompier',
            'discount' => 0.1,
        ],
        [
            'type' => 'famille',
            'discount' => 0.2,
        ],
        [
            'type' => 'ami',
            'discount' => 0.1,
        ],
        [
            'type' => 'carte de fidélité',
            'discount' => 0.1,
        ],
        [
            'type' => 'professionnel',
            'discount' => 0.05,
        ]
    ];
    public function load(ObjectManager $manager): void
    {
        foreach (self::TYPE_CUSTOMER_REFERENCE as $typeCustomerFixture) {
            $typeCustomer = new TypeCustomer();
            $typeCustomer->setType($typeCustomerFixture['type']);
            $typeCustomer->setDiscount($typeCustomerFixture['discount']);
            $manager->persist($typeCustomer);
            $this->addReference('type_' . $typeCustomerFixture['type'], $typeCustomer);
            $manager->flush();
        }
    }
}
