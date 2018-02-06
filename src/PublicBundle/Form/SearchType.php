<?php

namespace PublicBundle\Form;

use PublicBundle\Entity\Search;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('searchingFor',ChoiceType::class,['multiple'=>false, 'expanded'=>true,'choices'=>Search::FOR_CHOICES_FOR])
            ->add('searchingGender',ChoiceType::class,['multiple'=>true, 'expanded'=>true,'choices'=>Search::FOR_CHOICES_GENDER])
            ->add('searchingDist', HiddenType::class, array(
                'required'   => false))
            ->add('searchingInterest', ChoiceType::class,['multiple'=>false, 'expanded'=>true,'choices'=>Search::FOR_CHOICES_INTEREST])
            ->add('searchingAge', ChoiceType::class,['multiple'=>true, 'expanded'=>true,'choices'=>Search::FOR_CHOICES_AGES ])
            ->add('submit', SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PublicBundle\Entity\Search'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'publicbundle_search';
    }


}
