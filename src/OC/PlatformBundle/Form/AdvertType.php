<?php

namespace OC\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use OC\PlatformBundle\Repository\CategoryRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class AdvertType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$pattern = "%%";
        $builder
	        ->add('date',		DateTimeType::class)
	        ->add('title',    	TextType::class)
	        ->add('text',   	TextareaType::class)
	        ->add('author',   	TextType::class)
	        //->add('published',	CheckboxType::class, 	array('required'	=>	false))
	        ->add('image',		ImageType::class)
	      /*  ->add('categories', CollectionType::class, array(        
	        		'entry_type'   => CategoryType::class,        
	        		'allow_add'    => true,
	          		'allow_delete' => true
	        ))*/
	        ->add('categories', EntityType::class, array(
	        		'class'        => 'OCPlatformBundle:Category',
	        		'choice_label' => 'name',
	        		'multiple'     => true,
	        		'query_builder' => function(CategoryRepository $repository) use($pattern) {
	        			return $repository->getLikeQueryBuilder($pattern);
	        		}
	        ))
	       /* ->add('skills', EntityType::class, array(
	        		'class'        => 'OCPlatformBundle:Category',
	        		'choice_label' => 'name',
	        		'multiple'     => true,
	        ))  */
	        ;
	        
        // Construire un formulaire différemment selon des paramètres
        // On ajoute une fonction qui va écouter un évènement
        $builder->addEventListener(
        	FormEvents::PRE_SET_DATA,    // 1er argument : L'évènement qui nous intéresse : ici, PRE_SET_DATA
        	function(FormEvent $event) { // 2e argument : La fonction à exécuter lorsque l'évènement est déclenché
       			$advert = $event->getData();	// On récupère notre objet Advert sous-jacent
       			if (null === $advert) { // Cette condition est importante, on en reparle plus loin
       				return;
       			}
       			// Si l'annonce n'est pas publiée, ou si elle n'existe pas encore en base (id est null)
       			if (!$advert->getPublished() || null === $advert->getId()) {
       				$event->getForm()->add('published', CheckboxType::class, array('required' => false));
       			} else {
       				$event->getForm()->remove('published');
       			}
       		}
       		);
        
        $builder->add('save', SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OC\PlatformBundle\Entity\Advert'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'oc_platformbundle_advert';
    }


}
