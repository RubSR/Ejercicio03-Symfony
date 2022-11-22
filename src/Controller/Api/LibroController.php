<?php

namespace App\Controller\Api;

use App\Entity\Libro;
use App\Form\LibroType;
use App\Repository\LibroRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Rest\Route("/libros")
 */

class LibroController extends AbstractFOSRestController
{

    private $repo;

    public function __construct(LibroRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @Rest\Post(path="")
     * @Rest\View(serializerGroups={"libro"}, serializerEnableMaxDepthChecks= true)
     */

    public function postLibro(Request $request){

        $libro = new Libro();
        $form= $this->createForm(LibroType::class, $libro);
        $form->handleRequest($request);
        if(!$form->isSubmitted() || !$form->isValid()){
            return $form;
        }
        $this->repo->add($libro, true);
        return $libro;
    }

    /**
     * @Rest\Post (path="/parte1")
     * @Rest\View (serializerGroups={"libro"}, serializerEnableMaxDepthChecks=true)
     */
    public function getBy(Request $request){
        //El nombre que pongamos dentro del get tiene que ser el
        // nombre de la prpiedad en el Json cuando enviemos
        $autor = $request->get('autor');
        $categoria = $request->get('categoria');
        $anyo = $request->get('anyo');
        //Comporbar que me vienen las tres variables

        $libros = $this->repo->findBy(['autor'=>$autor, 'anyo'=> $anyo, 'categoria'=> $categoria]);

        return $libros;
    }


    /**
     * @Rest\Post (path="/parte2")
     * @Rest\View (serializerGroups={"libro"}, serializerEnableMaxDepthChecks=true)
     */

    public function getByAnyo(Request $request){
            $anyoinicio = $request->get('inicio');
            $anyoFin = $request->get('fin');
            $libros = $this->repo->getBetweenYears($anyoinicio, $anyoFin);
            return $libros;
    }

}