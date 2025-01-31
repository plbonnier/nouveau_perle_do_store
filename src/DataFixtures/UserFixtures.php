<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setUsername('user');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($this->passwordHasher->hashPassword($user, 'User*1234'));
        $manager->persist($user);

        $admin = new User();
        $admin->setUsername('admin');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->passwordHasher->hashPassword($admin, 'Admin*1234'));
        $manager->persist($admin);

        $ngoc = new User();
        $ngoc->setUsername('ngoc');
        $ngoc->setRoles(['ROLE_ADMIN']);
        $ngoc->setPassword($this->passwordHasher->hashPassword($ngoc, 'Ngoc*2016'));
        $manager->persist($ngoc);

        $pilou = new User();
        $pilou->setUsername('pilou');
        $pilou->setRoles(['ROLE_ADMIN']);
        $pilou->setPassword($this->passwordHasher->hashPassword($pilou, 'Ngoc*2016'));
        $manager->persist($pilou);
        
        $manager->flush();
    }
}
