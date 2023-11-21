<?php

namespace App\Controller\Admin;

use App\Entity\Param;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ParamCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Param::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            DateTimeField::new('created_at')->hideOnForm()->setLabel('Дата создания'),
            TextField::new('value')->setLabel('Название'),
            AssociationField::new('type')->setLabel('Тип'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return Crud::new()
            ->setEntityLabelInSingular('Параметр')
            ->setEntityLabelInPlural('Параметры');
    }
}
