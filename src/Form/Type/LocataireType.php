<?php
namespace TINTA\Form\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
class LocataireType extends AbstractType
{


    
    public function __construct() {
        
    }
    
    public function buildForm(FormBuilderInterface $builder,array $options)
    {

        $builder->add('nom','text');
        $builder->add('prenom','text');
        $builder->add('rue','text');
        $builder->add('cp','text');
		$builder->add('ville','text');
        $builder->add('pays','text');
        $builder->add('tel','text');
        $builder->add('email','text');
        $builder->add('comLoc','textarea');
         $builder->add('ajouter','submit');
    }
    public function getName()
    {
        return 'locataire';
    }
}