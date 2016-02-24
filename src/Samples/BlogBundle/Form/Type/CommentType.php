<?php 

namespace Samples\BlogBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CommentType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('id','hidden')
            ->add('post','hidden',
                    array(
                    'property_path' => 'post.id'
                    ))
            ->add('comment', 'textarea')
            ->add('save', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Samples\BlogBundle\Entity\Comment',
        ));
    }

    public function getName() {
        return 'comment';
    }
}