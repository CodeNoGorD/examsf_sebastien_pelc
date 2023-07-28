<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $hasher;
    public function __construct(UserPasswordHasherInterface $hasher){
        $this->hasher = $hasher;
    }
    public function load(ObjectManager $manager): void
    {
        $testAdmin = new User();
        $testAdmin->setEmail('rh@humanbooster.com');
        $testAdmin->setRoles(["ROLE_RH"]);
        $encodedPassword = $this->hasher->hashPassword($testAdmin, 'rh123@');
        $testAdmin->setPassword($encodedPassword);
        $testAdmin->setName('PELC');
        $testAdmin->setFirstName('sebastien');
        $testAdmin->setPicture('rh.jpg');
        $testAdmin->setSector('RH');
        $testAdmin->setContract('CDI');

        $testUser = new User();
        $testUser->setEmail('gr@humanbooster.com');
        $testUser->setRoles(["ROLE_USER"]);
        $encodedPassword = $this->hasher->hashPassword($testUser, 'test');
        $testUser->setPassword($encodedPassword);
        $testUser->setName('ROBBE');
        $testUser->setFirstName('gladys');
        $testUser->setPicture('photoGR.jpg');
        $testUser->setSector('Informatique,');
        $testUser->setContract('CDI');

        $manager->persist($testAdmin);
        $manager->persist($testUser);
        $manager->flush();
    }
}
