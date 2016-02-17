<?php
namespace TINTA\Form\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
class ReservationType extends AbstractType
{
    private $locataires;
    private $villas;
	private $forfaits;
    
    public function __construct($locataires, $villas, $forfaits) {
        $this->locataires = $locataires;
        $this->villas = $villas;
		$this->forfaits = $forfaits;
    }
    
    public function buildForm(FormBuilderInterface $builder,array $options)
    {
        // $this->locataires contient un tableau d'objets Locataire
        // Transforme le tableau id => objet en un tableau chaîne => id pour la liste déroulante
        $choices = array();
        foreach ($this->locataires as $id => $locataire) {
          $cle = $locataire->__toString();
          $choices[$cle] = $id;
        }
        $builder->add('locataire', 'choice', array(
          'choices' => $choices,
          'choices_as_values' => true, // Future valeur par défaut dans Symfony 3.x
          'choice_value' => function ($choice) {
            return $choice;
          },
          'expanded' => false, 
          'multiple' => false,
          'mapped' => false  // ce champ n'est pas mis en correspondance avec la propriété de l'objet
        ));
        
           // $this->villas contient un tableau d'objets villa
        $choices = array();
        foreach ($this->villas as $id => $villa) {
          $cle = $villa->__toString();
          $choices[$cle] = $id;
        }
        $builder->add('villa', 'choice', array(
          'choices' => $choices,
          'choices_as_values' => true, // Future valeur par défaut dans Symfony 3.x
          'choice_value' => function ($choice) {
            return $choice;
          },
          'expanded' => false, 
          'multiple' => false,
          'mapped' => false  // ce champ n'est pas mis en correspondance avec la propriété de l'objet
        ));
		
        // $this->forfaits contient un tableau d'objets Forfait
        $choices = array();
        foreach ($this->forfaits as $id => $forfait) {
          $cle = $forfait->__toString();
          $choices[$cle] = $id;
        }
        $builder->add('forfait', 'choice', array(
          'choices' => $choices,
          'choices_as_values' => true, // Future valeur par défaut dans Symfony 3.x
          'choice_value' => function ($choice) {
            return $choice;
          },
          'expanded' => false, 
          'multiple' => false,
          'mapped' => false  // ce champ n'est pas mis en correspondance avec la propriété de l'objet
        ));
        
                        $builder->add('dateResa', 'date', array(
                'widget' => 'single_text',    // Pour rendre le champ comme un input de type 'date'
            ));
        $builder->add('dateA', 'date', array(
                'widget' => 'single_text',    // Pour rendre le champ comme un input de type 'date'
            ));
                $builder->add('dateD', 'date', array(
                'widget' => 'single_text',    // Pour rendre le champ comme un input de type 'date'
            ));
        $builder->add('nbNuit','number');
        $builder->add('nbSemaine','number');
        $builder->add('animauxAdmission','text');
        $builder->add('NbAdulte','number');
        $builder->add('NbEnfant','number');
        $builder->add('etat','text');
        $builder->add('montant','text');
        $builder->add('montantAnimaux','text');
        $builder->add('comResa','textarea');
         $builder->add('ajouter','submit');
    }
    public function getName()
    {
        return 'reservation';
    }
}