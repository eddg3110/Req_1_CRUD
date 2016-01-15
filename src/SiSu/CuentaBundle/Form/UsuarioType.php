<?php

namespace SiSu\CuentaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use SiSu\CuentaBundle\Form\EventListener\AddEstadoFieldSubscriber;
use SiSu\CuentaBundle\Form\EventListener\AddMunicipioFieldSubscriber;
use SiSu\CuentaBundle\Form\EventListener\AddParroquiaFieldSubscriber;

class UsuarioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombreUsuario')
    		->addEventSubscriber(new AddEstadoFieldSubscriber())
    		->addEventSubscriber(new AddMunicipioFieldSubscriber())
    		->addEventSubscriber(new AddParroquiaFieldSubscriber())
    		//->add('estado', 'entity', array('class' => 'SiSuCuentaBundle:Estado'))
			//->add('municipio', 'entity', array('class' => 'SiSuCuentaBundle:Municipio'))
			//->add('parroquia', 'entity', array('class' => 'SiSuCuentaBundle:Parroquia'))
/* Ejemplo        	
        	->add('nacimiento', 'date', array(
        		//'type'           => new AddressType(),
        		'label'            => 'Direcciones',
        		'by_reference'     => false,
        		//'prototype_data' => new Address(),
        		//'allow_delete'   => true,
        		//'allow_add'      => true,
        		'max_length'	   => '20',
        		'mapped'           => false,
        		'attr'             => array(
        		'class'			   => 'row addresses'
        		)))
*/        		
		;	
		// Añadimos EventListeners que actualizaran los campos
		// para que sus opciones correspondan
		// con el campo seleccionado por el usuario   
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SiSu\CuentaBundle\Entity\Usuario'
        ));
    }
    
    public function getNombreUsuario()
    {
    	return 'nombreUsuario';
    }
}

