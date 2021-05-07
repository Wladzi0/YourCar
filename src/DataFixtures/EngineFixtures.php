<?php

namespace App\DataFixtures;

use App\Entity\Engine;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EngineFixtures extends Fixture
{


    public function load(ObjectManager $manager)
    {
        $tb = new Engine();
        $tb->setName('1.4 l., gasoline, 120 HP, TB');

        $tbm = new Engine();
        $tbm->setName('1.4 l., gasoline, 120 HP, TB MultiAir');

        $tb7 = new Engine();
        $tb7->setName('1.75 l., gasoline, 150 HP, TB');

        $jtdm = new Engine();
        $jtdm->setName('1.6 l., gasoline,150 HP, JTDM');

        $jtdm2 = new Engine();
        $jtdm2->setName('2.0 l., diesel, 170 HP, JTDM');

        $gme=new Engine();
        $gme->setName('2.0 l., diesel, 200 HP, GME');

        $gme21=new Engine();
        $gme21->setName('2.1 l., diesel, 180 HP, JTDM');

        $gme211=new Engine();
        $gme211->setName('2.1 l., diesel, 210 HP, JTDM ');

        $f154=new Engine();
        $f154->setName('2.9 l, gasoline, 510 HP, F154 ');

        $f154=new Engine();
        $f154->setName('2.9 l, gasoline, 510 HP, F154 ');

        $am28=new Engine();
        $am28->setName('5.9 L, gasoline, 477 HP, AM28');

        $am281=new Engine();
        $am281->setName('5.9 L, gasoline, 558 HP, AM28');

        $aj37=new Engine();
        $aj37->setName('4.7 l, gasoline, 426 HP, AJ37');

        $am281=new Engine();
        $am281->setName('5.9 l, gasoline, 517 hp,  AM11');


        $manager->persist($tb);
        $manager->persist($tbm);
        $manager->persist($tb7);
        $manager->persist($jtdm);
        $manager->persist($jtdm2);
        $manager->persist($gme);
        $manager->persist($gme21);
        $manager->persist($gme211);
        $manager->persist($f154);
        $manager->persist($am28);
        $manager->persist($am281);
        $manager->persist($aj37);
        $manager->persist($am281);
        $manager->flush();


    }
}