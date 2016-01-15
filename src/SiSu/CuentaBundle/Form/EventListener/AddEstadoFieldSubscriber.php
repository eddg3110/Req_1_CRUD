<?php

namespace SiSu\CuentaBundle\Form\EventListener;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AddEstadoFieldSubscriber implements EventSubscriberInterface
{	
    public static function getSubscribedEvents()
    {
        return array(
        	FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_SUBMIT => 'preSubmit',
        );
    }

    protected function addField(Form $form, $estado = null)
    {
    	$formOptions = array(
    			'class' 		=> 'SiSuCuentaBundle:Estado',
    			'empty_value' 	=> '-- Seleccionar --',
    			'attr'          => 	array(
    			'class' 		=> 'usuario_estado',),
    			'required' 		=> true,
    			'label'         => 'Estado',
    			//'placeholder'   => '-- Seleccionar --',
    			//'mapped'        => false,
    			//'invalid_message' => '-- Estado Invalido --',
    			);
    	
    	$form->add('estado', 'entity', $formOptions);
    			
    }

    public function preSubmit(FormEvent $event)
    {
    	$form = $event->getForm();
    	$this->addField($form);
    }
    
    public function preSetData(FormEvent $event)
    {
    	$data = $event->getData();
    	$form = $event->getForm();

    	$estado = ($data and $data->getEstado()) ? $data->getEstado() : null;

    	$this->addField($form, $estado);
    }

}