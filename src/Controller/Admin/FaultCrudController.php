<?php

namespace App\Controller\Admin;

use App\Entity\Fault;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
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
            TextField::new('name'),
            AssociationField::new('subModel'),
            AssociationField::new('engine'),
            TextareaField::new('description')
        ];
    }
}
