<?php
namespace TINTA\Form\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
class VillaType extends AbstractType
{
    private $typesVillas;
    
    public function __construct($typesVillas) {
        $this->typesVillas = $typesVillas;
    }
    
    
    public function buildForm(FormBuilderInterface $builder,array $options)
    {
        // $this->locataires contient un tableau d'objets Locataire
        // Transforme le tableau id => objet en un tableau chaîne => id pour la liste déroulante
        $choices = array();
        foreach ($this->typesVillas as $id => $typeVilla) {
          $cle = $typeVilla->__toString();
          $choices[$cle] = $id;
        }
        $builder->add('typeVilla', 'choice', array(
          'choices' => $choices,
          'choices_as_values' => true, // Future valeur par défaut dans Symfony 3.x
          'choice_value' => function ($choice) {
            return $choice;
          },
          'expanded' => false, 
          'multiple' => false,
          'mapped' => false  // ce champ n'est pas mis en correspondance avec la propriété de l'objet
        ));
        
             
        $builder->add('nom','text');
        $builder->add('ville','text');
        $builder->add('cp','text');
        $builder->add('description','textarea');
        $builder->add('descriptionPiece','textarea');
        $builder->add('surfaceHabitable','number');
        $builder->add('anneeConstruction','text');
        $builder->add('cautionVilla','number');
        $builder->add('cautionVelo','number');
        $builder->add('animauxAdmis','text');
        $builder->add('comVilla','textarea');
         $builder->add('ajouter','submit');
    }
    public function getName()
    {
        return 'villa';
    }
}