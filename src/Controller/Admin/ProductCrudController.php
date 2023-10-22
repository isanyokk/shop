<?php

namespace App\Controller\Admin;

use App\Entity\Image;
use App\Entity\Product;
use App\Field\MultipleImageField;
use App\Form\GalleryType;
use App\Form\ImageUploadType;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\FileUploadType;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\TextEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormInterface;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

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
            CollectionField::new('images')
                ->useEntryCrudForm(ImageCrudController::class)
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
}
