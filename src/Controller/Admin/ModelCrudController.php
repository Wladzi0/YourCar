<?php

namespace App\Controller\Admin;

use App\Entity\Model;
use App\Form\ImageFormType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ModelCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Model::class;
    }


    public function configureFields(string $pageName): iterable
    {

        return [
            IdField::new('id')->onlyOnDetail(),
            AssociationField::new ('make'),
            TextField::new('name'),
            CollectionField::new('images')
                ->setFormTypeOption('by_reference',false)
                ->setTranslationParameters(['form.label.delete'=>' Do your want to delete image?'])
                ->setEntryType(ImageFormType::class)
                ->onlyOnForms(),
            CollectionField::new('images')
                ->setTemplatePath('admin/images.html.twig')
                ->onlyOnDetail()


        ];

    }
    public function configureActions(Actions $actions): Actions
    {

        return $actions
        ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

}
