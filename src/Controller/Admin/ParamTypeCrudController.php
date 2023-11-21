<?php

namespace App\Controller\Admin;

use App\Entity\ParamType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ParamTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ParamType::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            DateTimeField::new('created_at')->hideOnForm()->setLabel('Дата создания'),
            TextField::new('value')->setLabel('Значение'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return Crud::new()
            ->setEntityLabelInSingular('Тип параметра')
            ->setEntityLabelInPlural('Типы параметров');
    }
}
