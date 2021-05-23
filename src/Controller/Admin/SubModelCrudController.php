<?php

namespace App\Controller\Admin;

use App\Entity\SubModel;
use App\Form\ImageFormType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SubModelCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SubModel::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
            ->hideOnForm(),
            CollectionField::new('images')
                ->setFormTypeOption('by_reference', false)
                ->setTranslationParameters(['form.label.delete' => ' Do your want to delete image?'])
                ->setEntryType(ImageFormType::class)
                ->onlyOnForms(),
            CollectionField::new('images')
                ->setTemplatePath('admin/images.html.twig')
                ->onlyOnDetail(),
            CollectionField::new('images')
                ->onlyOnIndex(),
            ArrayField::new('bodyType')
                ->hideOnForm(),
            ChoiceField::new('bodyType')
                ->onlyOnForms()
                ->setChoices([
                    'Hatchback' => 'Hatchback',
                    'Sedan' => 'Sedan',
                    'MUV/SUV' => 'MUV/SUV',
                    'Coupe' => 'Coupe',
                    'Convertible' => 'Convertible',
                    'Wagon' => 'Wagon',
                    'Van' => 'Van',
                    'Jeep' => 'Jeep'
                ]),
            AssociationField::new('model')
                ->hideOnDetail()
                ,
            TextField::new('bodyPlatform'),
        ];
    }
    public function configureActions(Actions $actions): Actions
    {

        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

}
