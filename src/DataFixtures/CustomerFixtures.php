<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use DateTime;

class CustomerFixtures extends Fixture
{
    public const CUSTOMERS = [
        [
            'date' => '2024-01-29',
            'civility' => 'Madame',
            'lastname' => 'WANG',
            'firstname' => 'Peibei',
            'adress' => null,
            'zipcode' => 69340,
            'city' => 'FRANCHEVILLE'
        ],
        [
            'date' => '2024-01-29',
            'civility' => null,
            'lastname' => 'Client particulier',
            'firstname' => '',
            'adress' => null,
            'zipcode' => null,
            'city' => null
        ],
        [
            'date' => '2024-01-29',
            'civility' => null,
            'lastname' => 'DO',
            'firstname' => 'Nhu Ngoc',
            'adress' => null,
            'zipcode' => 69160,
            'city' =>  'TASSIN LA DEMI-LUNE'
        ],
        [
            'date' => '2024-01-29',
            'civility' => 'Madame',
            'lastname' => 'JOURDAN',
            'firstname' => 'Charlotte',
            'adress' => null,
            'zipcode' => null,
            'city' => null
        ],
        [
            'date' => '2024-01-29',
            'civility' => 'Madame',
            'lastname' => '',
            'firstname' => 'Sylvie',
            'adress' => null,
            'zipcode' => null,
            'city' => null
        ],
        [
            'date' => '2024-01-29',
            'civility' => 'Monsieur et Madame',
            'lastname' => 'LACROUX',
            'firstname' => '',
            'adress' => null,
            'zipcode' => null,
            'city' => null
        ],
        [
            'date' => '2024-01-29',
            'civility' => null,
            'lastname' => 'Client particulier',
            'firstname' => '',
            'adress' => null,
            'zipcode' => null,
            'city' => null
        ],
        [
            'date' => '2024-01-29',
            'civility' => 'Madame',
            'lastname' => 'POPESCU',
            'firstname' => 'Andrea',
            'adress' => null,
            'zipcode' => null,
            'city' => null
        ],
        [
            'date' => '2024-01-29',
            'civility' => 'Madame',
            'lastname' => 'PETIT',
            'firstname' => 'Isabelle',
            'adress' => null,
            'zipcode' => null,
            'city' => null
        ],
        [
            'date' => '2024-01-2',
            'civility' =>  null,
            'lastname' => 'Famille',
            'firstname' => '',
            'adress' => null,
            'zipcode' => null,
            'city' => null
        ],
        [
            'date' => '2024-01-2',
            'civility' =>  'Monsieur',
            'lastname' => 'MERLIN',
            'firstname' => '',
            'adress' => null,
            'zipcode' => null,
            'city' => null
        ],
        [
            'date' => '2024-01-2',
            'civility' =>  null,
            'lastname' => 'Commerçant de Tassin',
            'firstname' => '',
            'adress' => null,
            'zipcode' => null,
            'city' => null
        ],
        [
            'date' => '2024-01-2',
            'civility' =>  'Madame',
            'lastname' => '',
            'firstname' => 'NAIMA',
            'adress' => null,
            'zipcode' => null,
            'city' => null
        ],
        [
            'date' => '2024-01-2',
            'civility' =>  null,
            'lastname' => '',
            'firstname' => 'Hsin Yi',
            'adress' => null,
            'zipcode' => null,
            'city' => null
        ]
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::CUSTOMERS as $customerFixture) {
            $customer = new Customer();
            $customer->setCreatedDate(new DateTime($customerFixture['date']));
            $customer->setCivility($customerFixture['civility']);
            $customer->setLastname($customerFixture['lastname']);
            $customer->setFirstname($customerFixture['firstname']);
            $customer->setAdress($customerFixture['adress']);
            $customer->setZipCode($customerFixture['zipcode']);
            $customer->setCity($customerFixture['city']);


            $manager->persist($customer);
        }
        $manager->flush();
    }
}
