<?php

namespace App\Controller\Admin;

use App\Entity\Fault;
use App\Form\ImageFormType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FaultCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Fault::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->onlyOnIndex(),
            CollectionField::new('images')
                ->setFormTypeOption('by_reference', false)
                ->setTranslationParameters(['form.label.delete' => ' Do your want to delete image?'])
                ->setEntryType(ImageFormType::class)
                ->onlyOnForms(),
            CollectionField::new('images')
                ->setTemplatePath('admin/images.html.twig')
                ->onlyOnDetail(),
            AssociationField::new('images')
                ->onlyOnIndex(),
            TextField::new('name'),
            AssociationField::new('subModel'),
            AssociationField::new('engine'),
            TextareaField::new('description'),
            AssociationField::new('user')
                ->setRequired(true)
                ->autocomplete()
                ->setFormTypeOption('by_reference', false)
        ];
    }

    public function configureActions(Actions $actions): Actions
    {

        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }
}
