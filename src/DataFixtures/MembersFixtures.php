<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Member;
use App\Entity\Profil;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Comment;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
require_once 'vendor/autoload.php';

 // $manager est un objet de la classe ObjectManager qui permet de faire des requêtes en base de données
class MembersFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $members = [];
        $faker = Factory::create('fr_FR');

        for($i=0; $i < 100; $i++){
            $article = new Article();
            
            $comment = new Comment();
            $category = new Category();
            $profil = new Profil();
            $member = new Member();
            


            $member -> setFirstName($faker -> firstName());
            $member -> setLastName($faker -> lastName());
            $member -> setEmail($faker->email());
            $member -> setPassword($faker -> password());
            $members[] = $member;
            // dd($members);
            
            $profil -> setDescription($faker -> text());
            $profil -> setImage($faker->imageUrl(640, 480, 'cats'));
            $profil -> setSlug('slug' . $i);
            $profil -> setCreatedDate(new \DateTime());
            $profil -> setUser($member);


            
            $category -> setCategoryDescription($faker -> text());
            $category -> setCategoryImage($faker->imageUrl(640, 480, 'cats'));
            $category -> setSlug($faker -> text());
            $category -> setCategoryName($faker -> text());

            
            $comment -> setContent($faker -> text());
            $comment -> setPublishDate($faker->dateTimeBetween('-3000 days', 'now'));
            $comment -> setArticle($article);

            
            $article -> setDetail($faker -> text());
            $article -> setImage($faker->imageUrl(640, 480, 'cats'));
            $article -> setTitle($faker -> text());
            $article -> setCreatedDate($faker->dateTimeBetween('-3000 days', 'now'));
            $article -> setAuthor($member);
            // $article -> addComment($comment);
            // $article -> removeComment($comment);
            $article -> setCategory($category);
            $article -> setCategoryArticle($category);

     $manager -> persist($member);
     $manager -> persist($article);
     $manager -> persist($comment);
     $manager -> persist($category);
     $manager -> persist($profil);
     }
     $manager->flush();
    }
}
