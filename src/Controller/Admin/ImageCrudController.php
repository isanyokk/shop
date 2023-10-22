<?php

namespace App\Controller\Admin;

use App\Entity\Image;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class ImageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Image::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            ImageField::new('filepath')
                ->setLabel('Изображение')
                ->setUploadDir('public/uploads/images/product')
                ->setBasePath('uploads/images/product')
                ->setUploadedFileNamePattern('[year]-[month]-[day]_[ulid].[extension]'),
        ];
    }
}
