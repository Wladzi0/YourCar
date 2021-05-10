<?php

namespace App\Controller\Admin;

use App\Entity\Make;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class MakeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Make::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            ImageField::new('icon')
                ->setBasePath('/images/makes')
                ->setUploadDir('public/images/makes')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false)

        ];
    }

}
