<?php

namespace App\Controller\Admin;

use App\Entity\Rim;
use App\Form\ImageFormType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RimCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Rim::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->onlyOnDetail(),
            TextField::new('size')
                ->setLabel('Size (r)')
                ->onlyOnIndex(),
            ChoiceField::new('size')
                ->onlyOnForms()
                ->setChoices(
                    function () {
                        $capacities = range(12, 22, 1);
                        return array_combine($capacities, $capacities);
                    }
                ),
            ChoiceField::new('pcd')
                ->setChoices([
                    '88.8' => '88.8',
                    '100' => '100',
                    '110' => '110',
                    '112' => '112',
                    '115' => '115',
                    '120' => '120',
                    '130' => '130',
                ])
                ->setLabel('Pitch circle diameter'),
            ChoiceField::new('stud')
                ->setChoices([
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                ]),
            TextField::new('weight')
                ->setLabel('Weight (kg)')
                ->onlyOnIndex(),
            ChoiceField::new('weight')
                ->onlyOnForms()
                ->setChoices(
                    function () {
                        $capacities = range(5.0, 20.0, 0.2);
                        return array_combine($capacities, $capacities);
                    }
                ),
            TextField::new('departure')
                ->setLabel('Wheel departure'),
            CollectionField::new('images')
                ->setFormTypeOption('by_reference', false)
                ->setTranslationParameters(['form.label.delete' => ' Do your want to delete image?'])
                ->setEntryType(ImageFormType::class)
                ->onlyOnForms(),
            CollectionField::new('images')
                ->setTemplatePath('admin/images.html.twig')
                ->onlyOnDetail(),
            CollectionField::new('images')
                ->onlyOnIndex()
        ];
    }

    public function configureActions(Actions $actions): Actions
    {

        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }
}
