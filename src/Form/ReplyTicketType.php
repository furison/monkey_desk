<?php

namespace App\Form;

use App\Entity\TicketResponse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReplyTicketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('subject', null, ['data' => $options['subject']])
            ->add('body')
            //->add('dateSubmitted')
            //->add('type')
            //->add('ticket')
            //->add('parent')
            //->add('child')
            ->add('submitter', null, array(
                'choice_label' => 'fullname',
                
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TicketResponse::class,
            'subject'   => null,
        ]);
    }
}
