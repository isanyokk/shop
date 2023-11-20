<?php

namespace App\Controller\Admin;

use App\Entity\ProductType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProductType::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm()->setLabel('ID'),
            DateTimeField::new('created_at')->hideOnForm()->setLabel('Дата создания'),
            SlugField::new('slug')->setTargetFieldName('title')->setLabel('Слаг'),
            TextField::new('title')->setLabel('Название'),
            TextEditorField::new('description')->setLabel('Описание'),
            ImageField::new('image')
                ->setUploadedFileNamePattern('[year]-[month]-[day]_[contenthash].[extension]')
                ->setLabel('Изображение')
                ->setUploadDir('public/uploads/images/product_type/')
                ->setBasePath('uploads/images/product_type/')
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return Crud::new()
            ->setEntityLabelInSingular('Тип товара')
            ->setEntityLabelInPlural('Типы товаров')
            ;
    }
}
