<?php

namespace App\Form;

use App\Entity\Categoria;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class LancamentoType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nome', TextType::class, ['label' => 'Nome do Lançamento: '])
        ->add('valor', TextType::class, ['label' => 'Valor do Lançamento: '])
        ->add('categoria_id', EntityType::class, [
            'class' => Categoria::class,
            'choice_label' => 'descricao_cat',
            'label' => 'Categoria: '
        ])->add('Salvar', SubmitType::class);
    }
}