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
            'reference' => 1,
            'adress' => null,
            'zipcode' => 69340,
            'city' => 'FRANCHEVILLE'
        ],
        [
            'date' => '2024-01-29',
            'civility' => null,
            'lastname' => 'Client particulier',
            'firstname' => '',
            'reference' => 2,
            'adress' => null,
            'zipcode' => null,
            'city' => null
        ],
        [
            'date' => '2024-01-29',
            'civility' => null,
            'lastname' => 'DO',
            'firstname' => 'Nhu Ngoc',
            'reference' => 3,
            'adress' => null,
            'zipcode' => 69160,
            'city' =>  'TASSIN LA DEMI-LUNE'
        ],
        [
            'date' => '2024-01-29',
            'civility' => 'Madame',
            'lastname' => 'JOURDAN',
            'firstname' => 'Charlotte',
            'reference' => 4,
            'adress' => null,
            'zipcode' => null,
            'city' => null
        ],
        [
            'date' => '2024-01-29',
            'civility' => 'Madame',
            'lastname' => '',
            'firstname' => 'Sylvie',
            'reference' => 5,
            'adress' => null,
            'zipcode' => null,
            'city' => null
        ],
        [
            'date' => '2024-01-29',
            'civility' => 'Monsieur et Madame',
            'lastname' => 'LACROUX',
            'firstname' => '',
            'reference' => 6,
            'adress' => null,
            'zipcode' => null,
            'city' => null
        ],
        [
            'date' => '2024-01-29',
            'civility' => null,
            'lastname' => 'Client particulier',
            'firstname' => '',
            'reference' => 7,
            'adress' => null,
            'zipcode' => null,
            'city' => null
        ],
        ['date' => '2024-01-29', 'civility' => 'Madame', 'lastname' => 'POPESCU', '
        firstname' => 'Andrea', 'reference' => 8, 'adress' => null, 'zipcode' => null,  'city' => null],
        [
            'date' => '2024-01-29',
            'civility' => 'Madame',
            'lastname' => 'PETIT',
            'firstname' => 'Isabelle',
            'reference' => 9,
            'adress' => null,
            'zipcode' => null,
            'city' => null
        ],
        [
            'date' => '2024-01-2',
            'civility' =>  null,
            'lastname' => 'Famille',
            'firstname' => '',
            'reference' => 10,
            'adress' => null,
            'zipcode' => null,
            'city' => null
        ],
        [
            'date' => '2024-01-2',
            'civility' =>  'Monsieur',
            'lastname' => 'MERLIN',
            'firstname' => '',
            'reference' => 11,
            'adress' => null,
            'zipcode' => null,
            'city' => null
        ],
        [
            'date' => '2024-01-2',
            'civility' =>  null,
            'lastname' => 'Commerçant de Tassin',
            'firstname' => '',
            'reference' => 12,
            'adress' => null,
            'zipcode' => null,
            'city' => null
        ],
        [
            'date' => '2024-01-2',
            'civility' =>  'Madame',
            'lastname' => '',
            'firstname' => 'NAIMA',
            'reference' => 13,
            'adress' => null,
            'zipcode' => null,
            'city' => null
        ],
        [
            'date' => '2024-01-2',
            'civility' =>  null,
            'lastname' => '',
            'firstname' => 'Hsin Yi',
            'reference' => 14,
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
            $customer->setReference($customerFixture['reference']);
            $customer->setAdress($customerFixture['adress']);
            $customer->setZipCode($customerFixture['zipcode']);
            $customer->setCity($customerFixture['city']);


            $manager->persist($customer);
        }
        $manager->flush();
    }
}
