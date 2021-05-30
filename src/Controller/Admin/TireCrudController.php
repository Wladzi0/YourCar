<?php

namespace App\Controller\Admin;

use App\Entity\Tire;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tire::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
            ->onlyOnIndex(),
            NumberField::new('width')
            ->setLabel('Width (mm)')
            ->setHelp('Must be ony numbers'),
            NumberField::new('aspectRatio')
                ->setLabel('Aspect ratio (mm)')
                ->setHelp('Must be ony numbers'),
            ChoiceField::new('diameter')
                ->setChoices(
                    function () {
                        $diameters = range(13, 22, 1);
                        return array_combine($diameters, $diameters);
                    }
                ),
        ];
    }

}
