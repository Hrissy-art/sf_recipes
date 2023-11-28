<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AppFixtures extends Fixture
{
    private $userPasswordHasherInterface;

    public function __construct (UserPasswordHasherInterface $userPasswordHasherInterface) 
    {
        $this->userPasswordHasherInterface = $userPasswordHasherInterface;
    }
    public function load(ObjectManager $manager): void
    {
        $faker = Factory ::create ('bg_BG');
       
        $categories = [];

        for ($i = 0; $i < 30; $i++){

            $category = new Category();
            $category-> setName( $faker ->realTextBetween(3,10));

            $manager->persist($category);
            $categories[] = $category;
        }

        $users = [];
        $regularuser = new User ();
        $regularuser->setEmail("test@example.com");
       
        $regularuser->setPassword(
            $this->userPasswordHasherInterface->hashPassword(
                $regularuser, "test_pass"

            )
        );
        $regularuser->setRoles(
            ['ROLE_USER']
        );
        $manager->persist($regularuser);
        $manager->flush();
        $user = new User();
        $user->setEmail("admin@example.com");
       
        $user->setPassword(
            $this->userPasswordHasherInterface->hashPassword(
                $user, "test_pass"

            )
        );
        $user->setRoles(
            ['ROLE_ADMIN']
        );

        $manager->persist($user);
        $manager->flush();

        $users = [$regularuser, $user];

     for ($i = 0; $i < 150; $i++)
     {$article = new Article ();
     $article -> setTitle ($faker->realTextBetween(3,10));
     $article ->setCreatedOn ($faker ->dateTimeBetween('-2 years'));
     $article ->setVisible ($faker ->boolean(80));
     $article -> setCategory ($faker -> randomElement($categories));
     $article -> setAuthor ($faker -> randomElement($users));

     $manager->persist($article);

    }

        $manager->flush();
    
       

        
    }
}

 
