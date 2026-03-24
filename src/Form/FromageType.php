<?php

namespace App\Form;

use App\Entity\Fromage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\File;

class FromageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class,[
                'label'=>'Nom du Fromage : ',
                'constraints'=>[
                    new Assert\NotBlank([
                        'message'=>'Le champ titre ne peux pas être vide',]),
                    ],
                'attr'=>[
                    'class' => 'add-fromage'
                ]
            ])
            ->add('prix', TextType::class,[
                'label'=>'Prix du Fromage : ',
                'attr'=>[
                    'class' => 'add-prix'
                ]
            ])
            ->add('verdict', TextareaType::class,[
                'label' => 'Description : ',
                'attr' => [
                    'class' => 'add-verdict'
                ]
            ])
            ->add('date')
            ->add('imageFile', FileType::class, [
                'required' => false,
                'label' => " ",
                'mapped' => true,
                'attr' => [
                    'class' => 'add-img'
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '2M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/gif',
                        ],
                        'mimeTypesMessage' => 'Veuillez télécharger une image valide (JPEG, PNG, GIF).',
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Fromage::class,
        ]);
    }
}
