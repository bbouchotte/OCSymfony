<?php

namespace OC\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use OC\PlatformBundle\Repository\SkillRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class Advert_SkillType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$pattern = "%%";    	 
        $builder
        //	->add('level')
        //	->add('advert')
        //	->add('skill', SkillType::class)
        	->add('skill', EntityType::class, array(
        			'class'			=> 'OC\PlatformBundle\Entity\Skill',
        			'choice_label'	=> 'name',
        			'multiple'		=> true,
        			'query_builder'	=> function(SkillRepository $repository) use($pattern) {
        			return $repository->getLikeQueryBuilder($pattern);
        			}
        	))
        	->add('level', TextType::class)
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OC\PlatformBundle\Entity\Advert_Skill'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'oc_platformbundle_advert_skill';
    }


}
