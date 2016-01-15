<?php

namespace SiSu\CuentaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SiSu\CuentaBundle\Entity\Usuario;
use SiSu\CuentaBundle\Form\UsuarioType;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Usuario controller.
 *
 * @Route("/usuario")
 */
class UsuarioController extends Controller
{
    /**
     * Lists all Usuario entities.
     *
     * @Route("/", name="usuario_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $usuarios = $em->getRepository('SiSuCuentaBundle:Usuario')->findAll();

        return $this->render('usuario/index.html.twig', array(
            'usuarios' => $usuarios,
        ));
    }

    /**
     * Creates a new Usuario entity.
     *
     * @Route("/new", name="usuario_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $usuario = new Usuario();
        $form = $this->createForm('SiSu\CuentaBundle\Form\UsuarioType', $usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($usuario);
            $em->flush();

            return $this->redirectToRoute('usuario_show', array('id' => $usuario->getId()));
        }

        return $this->render('usuario/new.html.twig', array(
            'usuario' => $usuario,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Usuario entity.
     *
     * @Route("/{id}", name="usuario_show")
     * @Method("GET")
     */
    public function showAction(Usuario $usuario)
    {
        $deleteForm = $this->createDeleteForm($usuario);

        return $this->render('usuario/show.html.twig', array(
            'usuario' => $usuario,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Usuario entity.
     *
     * @Route("/{id}/edit", name="usuario_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Usuario $usuario)
    {
        $deleteForm = $this->createDeleteForm($usuario);
        $editForm = $this->createForm('SiSu\CuentaBundle\Form\UsuarioType', $usuario);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($usuario);
            $em->flush();

            return $this->redirectToRoute('usuario_show', array('id' => $usuario->getId()));
        }

        return $this->render('usuario/edit.html.twig', array(
            'usuario' => $usuario,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Usuario entity.
     *
     * @Route("/{id}", name="usuario_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Usuario $usuario)
    {
        $form = $this->createDeleteForm($usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($usuario);
            $em->flush();
        }

        return $this->redirectToRoute('usuario_index');
    }

    /**
     * Creates a form to delete a Usuario entity.
     *
     * @param Usuario $usuario The Usuario entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Usuario $usuario)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('usuario_delete', array('id' => $usuario->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
    /**
     * @Route(
     *      "/new-ajax-form",
     *      name="usuario_new_ajax_form",
     *      condition="request.isXmlHttpRequest()"
     * )
     */
    public function ajaxNewFormAction(Request $request)
    {
    	$usuario = new Usuario();
    	$form = $this->createForm(UsuarioType::class, $usuario);
    	$form->handleRequest($request);
    
    	return $this->render(
    			'usuario/new.html.twig',
    			array('form' => $form->createView(),
    			));
    }
    
    /**
     * @Route(
     *      "/edit-ajax-form",
     *      name="usuario_edit_ajax_form",
     *      condition="request.isXmlHttpRequest()"
     * )
     */
    public function ajaxEditFormAction(Request $request)
    {
    	$usuario = new Usuario();
    	$form = $this->createForm(UsuarioType::class, $usuario);
    	$form->handleRequest($request);
    
    	return $this->render(
    			'usuario/edit.html.twig',
    			array('form' => $form->createView(),
    			));
    }
    
    /**
     * @Route("/Municipios", name="select_municipios")
     */
    public function municipiosAction(Request $request)
    {
    	$estado_id = $request->request->get('estado_id');
    
    	$em = $this->getDoctrine()->getManager();
    
    	$municipios = $em->getRepository('SiSuCuentaBundle:Municipio')->findByEstadoId($estado_id);
    
    	return new JsonResponse($municipios);
    }
    
    /**
     * @Route("/Parroquias", name="select_parroquias")
     */
    public function parroquiasAction(Request $request)
    {
    	$municipio_id = $request->request->get('municipio_id');
    
    	$em = $this->getDoctrine()->getManager();
    
    	$parroquias = $em->getRepository('SiSuCuentaBundle:Parroquia')->findByMunicipioId($municipio_id);
    
    	return new JsonResponse($parroquias);
    }
}
