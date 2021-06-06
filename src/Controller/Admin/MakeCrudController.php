<?php

namespace App\Controller\Admin;

use App\Entity\Make;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

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
                ->setRequired(true),
            AssociationField::new('models')
                ->hideOnDetail()
                ->setFormType(EntityType::class)
                ->setFormTypeOptions([
                    'multiple' => true,
                    'by_reference' => false,
                ]),
            ArrayField::new('models')
                ->onlyOnDetail(),

        ];
    }

    public function configureActions(Actions $actions): Actions
    {

        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

}
