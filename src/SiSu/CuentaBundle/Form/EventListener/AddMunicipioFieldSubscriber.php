<?php

namespace SiSu\CuentaBundle\Form\EventListener;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\EntityRepository;

class AddMunicipioFieldSubscriber implements EventSubscriberInterface
{	
    public static function getSubscribedEvents()
    {
        return array(
        	FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_SUBMIT => 'preSubmit',
        );
    }
    
    protected function addField(Form $form, $estado)
    {
    	// actualizamos el campo municipio, pasandole el estado a la opción
    	// query_builder, para que el dql tome en cuenta el estado
    	// y filtre la consulta por su valor.
    	
    	$formOptions = array(
    			'class' 		=> 'SiSuCuentaBundle:Municipio',
    			'empty_value' 	=> '-- Seleccionar --',
    			'attr'          => array(
    			'class' 		=> 'usuario_municipio',),
    			'required' 		=> true,
    			'label'         => 'Municipio',
    			//'placeholder' 	=> '-- Seleccionar --',
    			//'mapped'        => false,
    			//'invalid_message' => '-- Municipio Invalido --',
    			'query_builder' => function(EntityRepository $er) use ($estado){
    				return $er->createQueryBuilder('municipio')
    				->where('municipio.estado = :estado')
    				->setParameter('estado', $estado);
    			}
    			);

    	$form->add('municipio','entity', $formOptions);
    }

    /**
     * PRE_SET_DATA
     * Este evento se ejecuta al momento de crear el formulario
     * o al llamar al método $form->setData($usuario),
     * y nos sirve para obtener datos inicales del objeto asociado al form.
     * Ya que por ejemplo si el objeto viene de la base de datos y contiene
     * ya un estado establecido, lo ideal es que el campo municipio se carge inicalmente con
     * los estados de dicho estado.
     */
    
    public function preSetData(FormEvent $event)
    {
    	$data = $event->getData();	//data es un objeto SiSuCuentaBundle:Usuario
    	$form = $event->getForm();
    
    	// Pasamos siempre el estado así sea null
    	// para que cuando sea un usuario nuevo, el listado de estados esté
    	// vacio inicialmente, y solo se llene de items, cuando se ejecute el
    	// ajax que obtiene los estados del pais seleccionado por el usuario.
    
    	$estado = ($data and $data->getEstado()) ? $data->getEstado() : null; // Importante los parentesis al usar "and".
    
    	// Es importante siempre verificar que el valor devuelto por $event->getData()
    	// (que en este caso es $usuario) no sea null, porque no es obligatorio que al crear
    	// el formulario, se le pase una instancia de Usuario,
    	// y si no se le pasa, Usuario será nulo.
    
    	$this->addField($form ,  $estado);
    }
    
    /**
     * PRE_SUBMIT
     * Cuando el usuario llene los datos del formulario y haga el envío del mismo,
     * este método será ejecutado.
     */
    
    public function preSubmit(FormEvent $event)
    {
        $data = $event->getData();
        // data es un arreglo con los valores establecidos por el usuario en el form.
        $form = $event->getForm();
        // como $data contiene el estado seleccionado por el usuario al enviar el formulario,
        // usamos el valor de la posicion $data['estado'] para filtrar el sql de los estados
        $this->addField($form, $data['estado']);
    }
}