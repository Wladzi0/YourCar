<?php

namespace App\Controller\Admin;

use App\Entity\Model;
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
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Contracts\Translation\TranslatorInterface;

class ModelCrudController extends AbstractCrudController
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public static function getEntityFqcn(): string
    {
        return Model::class;
    }


    public function configureFields(string $pageName): iterable
    {

        return [
            IdField::new('id')
                ->onlyOnDetail(),

            ImageField::new('icon')
                ->setLabel('Image')
                ->setBasePath('/images/models')
                ->setUploadDir('public/images/models')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            AssociationField::new('make'),
            TextField::new('name'),
            ChoiceField::new('yearStart')
                ->setLabel($this->translator->trans('Production start'))
                ->setChoices($this->getYears(1900)),
            ChoiceField::new('yearFinish')
                ->setLabel($this->translator->trans('Production finish'))
                ->setChoices($this->getYears(1900)),
            AssociationField::new('engines')
                ->hideOnDetail()
                ->setFormType(EntityType::class)
                ->setFormTypeOptions([
                    'multiple' => true,
                    'by_reference' => false,
                ]),
            ArrayField::new('engines')
                ->onlyOnDetail(),
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
                ])
            ->allowMultipleChoices(true),
            AssociationField::new('transmissions')
                ->hideOnDetail()
                ->setFormType(EntityType::class)
                ->setFormTypeOptions([
                    'multiple' => true,
                    'by_reference' => false,
                ]),
            ArrayField::new('transmissions')
                ->onlyOnDetail(),
            AssociationField::new('rims')
                ->hideOnDetail()
                ->setFormType(EntityType::class)
                ->setFormTypeOptions([
                    'multiple' => true,
                    'by_reference' => false,
                ]),

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

    private function getYears($min, $max = 'current')
    {
        $years = range($min, ($max === 'current' ? date('Y') : $max));

        return array_combine($years, $years);
    }
}
