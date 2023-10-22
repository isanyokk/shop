<?php

namespace App\Field;

use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class MultipleImageField implements FieldInterface
{
    use FieldTrait;

    public static function new(string $propertyName, ?string $label = null): self
    {
        return (new self())
            ->setProperty($propertyName)
            ->setTemplatePath('admin/fields/gallery.html.twig')
            ->setFormType(FileType::class)
            ->setFormTypeOptions([
                'multiple' => true,
                'data_class' => null,
            ]);
    }
}
