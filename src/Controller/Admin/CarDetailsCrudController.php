<?php

namespace App\Controller\Admin;

use App\Entity\CarDetails;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Contracts\Translation\TranslatorInterface;

class CarDetailsCrudController extends AbstractCrudController
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public static function getEntityFqcn(): string
    {
        return CarDetails::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Car')
            ->setEntityLabelInPlural('Car details');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->onlyOnIndex(),
            AssociationField::new('subModel')
                ->setRequired(true)
                ->autocomplete(),
            AssociationField::new('engine')
                ->setRequired(true)
                ->autocomplete(),
            NumberField::new('power')
                ->setLabel('Power (KM)')
                ->setHelp('Must be only numbers'),
            ChoiceField::new('torque')
                ->setLabel('Torque (Nm)')
                ->setChoices(
                    function () {
                        $capacities = range(70, 999, 1);
                        return array_combine($capacities, $capacities);
                    }
                ),
            ChoiceField::new('eco')
                ->setChoices(
                    [
                        'Euro I' => 'Euro I',
                        'Euro II' => 'Euro II',
                        'Euro III' => 'Euro III',
                        'Euro IV' => 'Euro IV',
                        'Euro V' => 'Euro V',
                        'Euro VI' => 'Euro VI',
                    ]
                ),
            ChoiceField::new('yearStart')
                ->setLabel($this->translator->trans('Production start'))
                ->setChoices($this->getYears(1900)),
            ChoiceField::new('yearFinish')
                ->setLabel($this->translator->trans('Production finish'))
                ->setChoices($this->getYears(1900)),

            AssociationField::new('transmission')
                ->setRequired(true)
                ->autocomplete(),
            ChoiceField::new('drive')
                ->setRequired(true)
                ->setChoices([
                        '4-wheel drive' => '4-wheel drive',
                        'Front drive' => 'Front drive',
                        'Rear drive' => 'Rear drive'
                    ]
                ),
            NumberField::new('weight')
                ->hideOnIndex()
                ->setLabel('Weight (kg)')
                ->setHelp('Must be only numbers'),
            NumberField::new('speed')
                ->setLabel('Max. speed (km/h)')
                ->setHelp('Must be only numbers'),
            NumberField::new('fuelConsumption')
                ->hideOnIndex()
                ->setLabel('Fuel consumption (l/100km)')
                ->setHelp('Must be only numbers'),
            NumberField::new('fuelConsumptionMixed')
                ->hideOnIndex()
                ->setLabel('Fuel consumption mixed (l/100km)')
                ->setHelp('Must be only numbers'),
            NumberField::new('fuelConsumptionExtra')
                ->hideOnIndex()
                ->setLabel('Fuel consumption extra-urban (l/100km)')
                ->setHelp('Must be only numbers'),
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
