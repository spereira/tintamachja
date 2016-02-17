<?php
namespace TINTA\Form\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
class EquipementType extends AbstractType
{

    
    public function __construct() {
    }
    
    
    public function buildForm(FormBuilderInterface $builder,array $options)
	{
             
        $builder->add('id','text');
        $builder->add('libelle','text');
        $builder->add('description','textarea');
        $builder->add('prix','number');
        $builder->add('comEqui','textarea');
		    $builder->add('ajouter','submit');

    }
    public function getName()
    {
        return 'equipement';
    }
}