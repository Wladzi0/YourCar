<?php

namespace App\Controller\Admin;

use App\Entity\Engine;
use App\Form\EngineType;
use App\Form\ImageFormType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use Symfony\Component\Validator\Constraints as Assert;
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
            TextField::new('name')
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
                ->hideOnForm(),
            ChoiceField::new('fuel')
                ->setChoices([
                        'Petrol' => 'Petrol',
                        'Diesel' => 'Diesel',
                        'Gas' => 'Gas',
                        'Petrol + gas' => 'Petrol + gas',
                        'Hybrid' => 'Hybrid',
                        'Electronic' => 'Electronic']
                ),
            TextField::new('power')
                ->hideOnForm(),
            ChoiceField::new('power')
                ->onlyOnForms()
                ->setChoices(
                    function () {
                        $capacities = range(50, 1200, 5);
                        return array_combine($capacities, $capacities);
                    }
                ),
            TextField::new('abbreviation'),
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
