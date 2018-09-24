<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class LocationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titre')
            ->add('description',TextareaType::class)
            ->add('type', ChoiceType::class, array(
                'choices' => array(
                    'Studio' => "Studio",
                    'Colocation' => "Colocation",
                    'Maison' => "Maison",
                    'Appartement' => "Appartement",
                )
            ))
            ->add('equipement', ChoiceType::class, array(
                'choices' => array(
                    'meublé' => "meublé",
                    'non meublé' => "non meublé",
                )
            ))

            ->add('etat',ChoiceType::class, array(
                'choices' => array(
                    'Neuf/Refait à Neuf' => "Neuf/Refait à Neuf",
                    'trés bien état' => "trés bien état",
                    'Etat d\'usage' => "Etat d'usage",
                )
            ))
            ->add('piece')
            ->add('surface')
            ->add('dateDisp')
            ->add('datePublication')
            ->add('adresse')
            ->add('region')
            ->add('prix')
            ->add('photo',FileType::class, [
                'data_class' => null,
//              'multiple' => true,
                'label' => false
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Location'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_location';
    }


}
