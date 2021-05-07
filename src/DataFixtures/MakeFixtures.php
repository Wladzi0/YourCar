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
        $file = new File('path/images/alfa.jpeg');
        $ar->setIcon($file);
        $arGiu=new Model();
        $arGiu->setName('Giulietta');
        $arGiu->setMake($ar);
        $arSte=new Model();
        $arSte->setName('Stelvio');
        $arSte->setMake($ar);


        $am= new Make();
        $am->setName('Aston Martin');
        $am->setIcon('asdf');
        $amRap= new Model();
        $amRap->setName('Rapide');
        $amRap->setMake($am);
        $amVan= new Model();
        $amVan->setName('Vantage');
        $amVan->setMake($am);


        $alpine= new Make();
        $alpine->setName('Alpine');
        $alpine->setIcon('asdf');

        $audi= new Make();
        $audi->setName('Audi');
        $audi->setIcon('asdf');

        $bentley= new Make();
        $bentley->setName('Bentley');
        $bentley->setIcon('asdf');

        $bmw= new Make();
        $bmw->setName('BMW');
        $bmw->setIcon('asdf');

        $chevrolet= new Make();
        $chevrolet->setName('Chevrolet');
        $chevrolet->setIcon('asdf');


        $ford= new Make();
        $ford->setName('Ford');
        $ford->setIcon('asdf');

        $kia= new Make();
        $kia->setName('Kia');
        $kia->setIcon('asdf');

        $mitsubishi= new Make();
        $mitsubishi->setName('Mitsubishi');
        $mitsubishi->setIcon('asdf');

        $mercedes= new Make();
        $mercedes->setName('Mercedes-Benz');
        $mercedes->setIcon('asdf');


        $volkswagen= new Make();
        $volkswagen->setName('Volkswagen');
        $volkswagen->setIcon('asdf');

        $volvo= new Make();
        $volvo->setName('Volvo');
        $volvo->setIcon('asdf');


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