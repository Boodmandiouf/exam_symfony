<?php

namespace examBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class examType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('album')
            ->add('titreAlbum')
            ->add('artiste')
            ->add('genre', ChoiceType::class, array(
                'choices' => array(
                    'hiphop' => 'Hip-Hop',
                    'soul' => 'Soul',
                    'rock' => 'Rock',
                )
            ))
            ->add('support', ChoiceType::class, array(
                'choices' => array(
                    'vinyl' => 'Vinyl',
                    'cd' => 'CD',
                    'cassette' => 'Cassette',
                )
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'examBundle\Entity\exam'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'exambundle_exam';
    }


}
