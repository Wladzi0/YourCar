<?php

namespace App\Controller\Admin;

use App\Entity\Engine;
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
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EngineCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Engine::class;
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
            AssociationField::new('images')
                ->onlyOnIndex(),
            ChoiceField::new('capacity')
                ->onlyOnForms()
                ->setChoices(
                    function () {
                        $capacities = range(0.8, 9.1, 0.1);
                        return array_combine($capacities, $capacities);
                    }
                ),
            TextField::new('capacity')
                ->hideOnForm()
                ->setLabel('Capacity (l)'),
            ChoiceField::new('fuel')
                ->setChoices([
                        'Petrol' => 'Petrol',
                        'Diesel' => 'Diesel',
                        'Gas' => 'Gas',
                        'Petrol + gas' => 'Petrol + gas',
                        'Hybrid' => 'Hybrid',
                        'Electronic' => 'Electronic']
                ),
            TextField::new('abbreviation'),
            NumberField::new('weight')
            ->setLabel('Weight (kg)')
            ->hideOnIndex(),
            TextField::new('powerIncrease')
            ->setRequired(false)
            ->setFormTypeOption('empty_data',''),
            AssociationField::new('models')
                ->hideOnDetail()
                ->setFormType(EntityType::class)
                ->setFormTypeOptions([
                    'multiple' => true,
                    'by_reference' => false,
                ]),
            ArrayField::new('models')
                ->onlyOnDetail(),

            NumberField::new('oil'),
            NumberField::new('cylinders'),
            AssociationField::new('carDetails')
                ->onlyOnIndex(),
            AssociationField::new('faults')
                ->setFormType(EntityType::class)
                ->setFormTypeOptions([
                    'multiple' => true,
                    'by_reference' => false,
                ]),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {

        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }
}
