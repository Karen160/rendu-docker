<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++){
            $article = new Article;
            $article->setTitle('Article n°' . $i);
            $manager->persist($article);
        }

        $manager->flush();
    }
}
