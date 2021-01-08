<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nom', TextType::class)
            ->add('Description', TextType::class)
			->add('Image', FileType::class, [
                'label' => 'Miniature (Image)',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/gif',
                            'image/jpg',
                        ],
                        'mimeTypesMessage' => 'Veuillez donner un type de fichier correspondant à une image.',
                    ])
                ],
            ])
			->add('auteurs', CollectionType::class, [
				'entry_type' => TextType::class,
				'allow_add' => true,
				'allow_delete' => true,
				'prototype' => true,
			])
			->add('categories', CollectionType::class, [
				'entry_type' => TextType::class,
				'allow_add' => true,
				'allow_delete' => true,
				'prototype' => true,
			])
			->add('contenu', TextareaType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
