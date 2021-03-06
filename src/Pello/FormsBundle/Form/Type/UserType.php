<?php 

namespace Pello\FormsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('login','text')
            ->add('password', 'password')
            ->add('save', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Pello\FormsBundle\Entity\User',
        ));
    }

    public function getName() {
        return 'user';
    }
}