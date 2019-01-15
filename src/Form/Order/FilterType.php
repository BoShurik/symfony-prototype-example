<?php

namespace App\Form\Order;

use App\Entity\Currency;
use App\Entity\User;
use App\Order\Model\FilterModel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'name',
                'required' => false,
            ])
            ->add('currency', EntityType::class, [
                'class' => Currency::class,
                'choice_label' => 'name',
                'required' => false,
            ])
            ->add('amountFrom')
            ->add('amountTo')
            ->add('message')
            ->add('createdAtFrom', DateTimeType::class, [
                'widget' => 'single_text',
                'format' => 'dd.MM.yyyy HH:mm',
                'required' => false,
            ])
            ->add('createdAtTo', DateTimeType::class, [
                'widget' => 'single_text',
                'format' => 'dd.MM.yyyy HH:mm',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'method' => 'GET',
            'data_class' => FilterModel::class,
            'required' => false,
            'csrf_protection' => false,
        ]);
    }
}
