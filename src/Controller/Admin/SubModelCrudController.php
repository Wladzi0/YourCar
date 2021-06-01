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
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Contracts\Translation\TranslatorInterface;

class SubModelCrudController extends AbstractCrudController
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }
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
            AssociationField::new('images')
                ->onlyOnIndex(),
            AssociationField::new('model'),
            ChoiceField::new('yearStart')
                ->setLabel($this->translator->trans('Production start'))
                ->autocomplete()
                ->setChoices($this->getYears(1900)),
            ChoiceField::new('yearFinish')
                ->setLabel($this->translator->trans('Production finish'))
                ->setChoices($this->getYears(1900)),
            TextField::new('bodyType')
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

            TextField::new('bodyPlatform'),
            AssociationField::new('engines')
                ->hideOnDetail()
                ->setFormType(EntityType::class)
                ->setFormTypeOptions([
                    'multiple' => true,
                    'by_reference' => false,
                ]),
            ArrayField::new('engines')
                ->onlyOnDetail(),
            AssociationField::new('rims')
                ->hideOnDetail()
                ->setFormType(EntityType::class)
                ->setFormTypeOptions([
                    'multiple' => true,
                    'by_reference' => false,
                ]),
            ArrayField::new('rims')
                ->onlyOnDetail(),
            AssociationField::new('faults')
                ->setFormType(EntityType::class)
                ->setFormTypeOptions([
                    'multiple' => true,
                    'by_reference' => false,
                ]),
            NumberField::new('tank'),
            NumberField::new('length')
            ->setRequired(true),
            NumberField::new('width'),
            AssociationField::new('details')
                ->onlyOnIndex(),
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
