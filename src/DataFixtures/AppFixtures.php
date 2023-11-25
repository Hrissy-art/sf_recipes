<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory ::create ('bg_BG');
       
        $categories = [];

        for ($i = 0; $i < 30; $i++){

            $category = new Category ();
            $category-> setName( $faker ->realTextBetween(3,10));

            $manager->persist($category);
            $categories[] = $category;
        }
     for ($i = 0; $i < 150; $i++)
     {$article = new Article ();
     $article -> setTitle ($faker->realTextBetween(3,10));
     $article ->setCreatedOn ($faker ->dateTimeBetween('-2 years'));
     $article ->setVisible ($faker ->boolean(80));
     $article -> setCategory ($faker -> randomElement($categories));

     $manager->persist($article);

    }

        $manager->flush();
    }
}
