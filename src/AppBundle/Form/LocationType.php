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
                    'Etat dusage' => "Etat d'usage",
                )
            ))
            ->add('piece',ChoiceType::class, array(
                'choices' => array(
                    'S+0' => "S+0",
                    'S+1' => "S+1",
                    'S+2' => "S+2",
                    'S+3' => "S+3",
                    'S+4 ou plus' => "S+4 ou plus",

                )
            ))
            ->add('surface')
            ->add('dateDisp')
            ->add('adresse')
            ->add('region', ChoiceType::class, array(

                'choices' => array(
                    'Ariana' => 'Ariana' ,
                    'Béja' => 'Béja',
                    'Ben Arous' => 'Ben Arous',
                    'Bizerte' => 'Bizerte',
                    'Gabès' =>  'Gabès' ,
                    'Gafsa' => 'Gafsa',
                    'Jendouba' => 'Jendouba',
                    'Kairouan' => 'Kairouan',
                    'Kasserine' =>'Kasserine',
                    'Kébili' =>'Kébili',
                    'Le Kef' =>'Le Kef',
                    'Mahdia' =>'Mahdia',
                    'La Manouba' =>'La Manouba',
                    'Médenine' =>'Médenine' ,
                    'Monastir' => 'Monastir',
                    'Nabeul' =>'Nabeul',
                    'Sfax' =>'Sfax' ,
                    'Sidi Bouzid' => 'Sidi Bouzid' ,
                    'Siliana' => 'Siliana',
                    'Sousse' => 'Sousse',
                    'Tataouine' =>'Tataouine',
                    'Tozeur'=>'Tozeur',
                    'Tunis'=>'Tunis',
                    'Zaghouan'=>'Zaghouan',

                )))
            ->add('prix')
            ->add('photo',FileType::class, [
                'data_class' => null,

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
