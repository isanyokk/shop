<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Form\PhotoUploadType;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('title')
            ->add('price')
            ->add('createdAt');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title')->setLabel('Название'),
            TextEditorField::new('description')->setLabel('Описание'),
            MoneyField::new('price')->setCurrency('RUB')->setLabel('Цена'),
            IntegerField::new('discountPercent')->setLabel('Процент скидки'),
            IntegerField::new('discountValue')->setLabel('Значение скидки'),
            DateTimeField::new('createdAt')->hideOnForm()->setLabel('Дата создания'),
            DateTimeField::new('updatedAt')->hideOnForm()->setLabel('Дата последнего обновления'),
            AssociationField::new('type')->setLabel('Тип'),
            AssociationField::new('params')->setLabel('Тип'),
            CollectionField::new('images')
                ->setEntryType(PhotoUploadType::class)
                ->setLabel('Фото'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return Crud::new()
            ->setEntityLabelInSingular('Товар')
            ->setEntityLabelInPlural('Товары')
            ->overrideTemplate('crud/field/text_editor', 'admin/fields/html_description.html.twig');
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $entityInstance->setImages(array_values($entityInstance->getImages()));
        parent::persistEntity($entityManager, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $entityInstance->setImages(array_values($entityInstance->getImages()));
        parent::updateEntity($entityManager, $entityInstance);
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_DETAIL, Action::DETAIL)
            ->add(Crud::PAGE_NEW, Action::NEW)
            ->add(Crud::PAGE_EDIT, Action::EDIT);
    }
}
