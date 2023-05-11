<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher    
    ){
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $user = (new User())
         ->setFirstName('prénom')
         ->setLastName('nom')
         ->setEmail('admin@test.com')
         ->setRoles(['ROLE_ADMIN'])
         ->setPassword(
            $this->passwordHasher->hashPassword(new User(), 'test123')
         );
        $manager->persist($user);
        
        $manager->flush();
    }
}
