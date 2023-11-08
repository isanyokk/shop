<?php

namespace App\Form;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\FileUploadType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\FormBuilderInterface;

class PhotoUploadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('color', ColorType::class, [
                'label' => 'Цвет',
            ])
            ->add('file', FileUploadType::class, [
                'label' => 'Изображение',
                'upload_dir' => Product::IMAGES_PATH,
                'upload_filename' => '[year]-[month]-[day]_[contenthash].[extension]',
            ])
        ;
    }
}
