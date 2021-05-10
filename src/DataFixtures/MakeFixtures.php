<?php

namespace App\DataFixtures;

use App\Entity\Make;
use App\Entity\Model;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\File;

class MakeFixtures extends Fixture
{


    public function load(ObjectManager $manager)
    {
//        foreach ($images as $image) {
//            $file = md5(uniqid()) . '.' . $image->guessExtension();
//            $image->move(
//                $this->getParameter('advertisement_images_directory'),
//                $file
//            );
//            $img = new Image();
//            $img->setName($file);
//            $advertisement->addImage($img);
//        }

        $ar= new Make();
        $ar->setName('Alfa Romeo');
        $arGiu=new Model();
        $arGiu->setName('Giulietta');
        $arGiu->setMake($ar);
        $arSte=new Model();
        $arSte->setName('Stelvio');
        $arSte->setMake($ar);


        $am= new Make();
        $am->setName('Aston Martin');
        $amRap= new Model();
        $amRap->setName('Rapide');
        $amRap->setMake($am);
        $amVan= new Model();
        $amVan->setName('Vantage');
        $amVan->setMake($am);


        $alpine= new Make();
        $alpine->setName('Alpine');

        $audi= new Make();
        $audi->setName('Audi');

        $bentley= new Make();
        $bentley->setName('Bentley');
        $bmw= new Make();
        $bmw->setName('BMW');

        $chevrolet= new Make();
        $chevrolet->setName('Chevrolet');


        $ford= new Make();
        $ford->setName('Ford');

        $kia= new Make();
        $kia->setName('Kia');

        $mitsubishi= new Make();
        $mitsubishi->setName('Mitsubishi');

        $mercedes= new Make();
        $mercedes->setName('Mercedes-Benz');

        $volkswagen= new Make();
        $volkswagen->setName('Volkswagen');

        $volvo= new Make();
        $volvo->setName('Volvo');

        $manager->persist($ar);
        $manager->persist($arGiu);
        $manager->persist($arSte);

        $manager->persist($am);
        $manager->persist($amRap);
        $manager->persist($amVan);

        $manager->persist($alpine);
        $manager->persist($audi);
        $manager->persist($bentley);
        $manager->persist($bmw);
        $manager->persist($chevrolet);
        $manager->persist($ford);
        $manager->persist($kia);
        $manager->persist($mitsubishi);
        $manager->persist($mercedes);
        $manager->persist($volkswagen);
        $manager->persist($volvo);
        $manager->flush();
    }
}