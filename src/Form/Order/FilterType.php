<?php

namespace App\Form\Order;

use App\Order\Model\FilterModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user')
            ->add('currency')
            ->add('amountFrom')
            ->add('amountTo')
            ->add('message')
            ->add('createdAtFrom')
            ->add('createdAtTo')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FilterModel::class,
        ]);
    }
}
