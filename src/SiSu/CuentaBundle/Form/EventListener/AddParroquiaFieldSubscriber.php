<?php

namespace SiSu\CuentaBundle\Form\EventListener;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\EntityRepository;

class AddParroquiaFieldSubscriber implements EventSubscriberInterface
{	
    public static function getSubscribedEvents()
    {
        return array(
        	FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_SUBMIT => 'preSubmit',
        );
    }
    
    protected function addField(Form $form, $municipio)
    {

    	$formOptions = array(
    			'class' 		=> 'SiSuCuentaBundle:Parroquia',
    			'empty_value' 	=> '-- Seleccionar --',
    			'attr'          => array(
    			'class' 		=> 'usuario_parroquia',),
    			'required' 		=> true,
    			'label'         => 'Parroquia',
    			//'placeholder' 	=> '-- Seleccionar --',
    			//'mapped'        => false,
    			//'invalid_message' => '-- Parroquia Invalida --',
    			'query_builder' => function(EntityRepository $er) use ($municipio){
    				return $er->createQueryBuilder('parroquia')
    				->where('parroquia.municipio = :municipio')
    				->setParameter('municipio', $municipio);
    			}
    			);

    	$form->add('parroquia','entity', $formOptions);
    }

    public function preSetData(FormEvent $event)
    {
    	$data = $event->getData();
    	$form = $event->getForm();

    	$municipio = ($data and $data->getMunicipio()) ? $data->getMunicipio() : null;

    	$this->addField($form, $municipio);
    }

    public function preSubmit(FormEvent $event)
    {
        $data = $event->getData();
        
        $form = $event->getForm();
        
        $this->addField($form, $data['municipio']);
    }

}