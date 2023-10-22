<?php

namespace App\Form;

use App\Entity\Image;
use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\FileUploadType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class GalleryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('color', ColorType::class, [
                'label' => 'Цвет',
            ])
            ->add('uploadedFiles', FileType::class, [
                'data_class' => null,
                'label' => 'Фото',
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'gallery_form';
    }
}
