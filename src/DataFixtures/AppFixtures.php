<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $user = (new User())
            ->setFirstName('test')
            ->setLastName('noob')
            ->setEmail('test@mail.com')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword(
                $this->passwordHasher->hashPassword(new User(), 'test123')
            );

        $manager->persist($user);

        $manager->flush();
    }
}
