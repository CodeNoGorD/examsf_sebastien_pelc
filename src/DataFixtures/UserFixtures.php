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
        $testAdmin->setPicture('Photo.jpg');
        $testAdmin->setSector('RH');
        $testAdmin->setContract('CDI');
//        $testAdmin->setDateContract('');

        $manager->persist($testAdmin);
        $manager->flush();
    }
}
