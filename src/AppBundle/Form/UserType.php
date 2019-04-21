<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstName',TextType::class)
            ->add('lastName',TextType::class)
            ->add('username',TextType::class)
            ->add('email',EmailType::class)
            ->add('plainPassword', PasswordType::class)
            ->add('roles', ChoiceType::class, array('choices' =>
                array(
                    'Administrateur' => 'ROLE_ADMIN',
                    'Chef de parc' => 'ROLE_CHEF',
                    'Consultant' => 'ROLE_CONSULTANT',
                ),
                'required'  => true,
                'mapped' => false
            ))
        ;;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_user';
    }


}
