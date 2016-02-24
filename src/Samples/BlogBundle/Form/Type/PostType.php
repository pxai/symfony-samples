<?php 

namespace Samples\BlogBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('id','hidden')
            ->add('title','text')
            ->add('category', 'entity',
                array(
                    'class' => 'SamplesBlogBundle:Category',
                    'label' => 'Category'
                ))
            ->add('text', 'textarea')
            ->add('save', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Samples\BlogBundle\Entity\Post',
        ));
    }

    public function getName() {
        return 'post';
    }
}