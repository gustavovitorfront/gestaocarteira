<?php

namespace App\Controller;

use App\Entity\Categoria;
use App\Form\CategoriaType;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoriaController extends AbstractController
{
    /**
     * @Route("/categoria", name="categoria_index")
     */
    public function index(EntityManagerInterface $em)
    {
        // $em é um objeto que vai auxiliar a execução de ações no BD
        $categoria = New Categoria();
        $categoria->setDescricaoCat("Namorada");

        try{
            $em->persist($categoria); //salvar em nivel de memoria
            $em->flush(); // executa no bd
            $msg = "Categoria cadastrada com sucesso";
        }
        catch(Exception $e){
            $msg = "Erro ao cadastrar categoria";
        }

        return new Response("<h1>".$msg."</h1>");
        
    }

    /**
     * @Route("/categoria/adicionar", name="categoria_adicionar")
     */
    public function adicionar()
    {
        $form = $this->createForm(CategoriaType::class);
        $data['titulo'] = 'Adicionar nova Categoria';
        $data['form'] = $form;

        return $this->renderForm('categoria/form.html.twig', $data);
    }
}