<?php

namespace App\Controller;

use App\Entity\Lancamento;
use App\Form\LancamentoType;
use App\Repository\CategoriaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LancamentoController extends AbstractController
{
    /**
     * @Route("/lancamento", name="lancamento_index")
     */
    public function index(EntityManagerInterface $em, CategoriaRepository $categoriaRepository)
    {
        $categoria = $categoriaRepository->find(1);
        $lancamento = new Lancamento();
        $lancamento->setNome('Passeio a noite');
        $lancamento->setValor(160);
        $lancamento->setCategoria($categoria);

        try {
            $em->persist($lancamento); //salvar em nivel de memoria
            $em->flush(); // executa no bd
            $msg = "Lançamento cadastrada com sucesso";
        } catch (Exception $e) {
            $msg = "Erro ao cadastrar lançamento";
        }

        return new Response("<h1>" . $msg . "</h1>");
    }

    /**
     * @Route("/lancamento/adicionar", name="lancamento_adicionar")
     */
    public function adicionar(){
        $form = $this->createForm(LancamentoType::class);
        $data['titulo'] = 'Adicionar novo Lançamento';
        $data['form'] = $form;

        return $this->renderForm('lancamento/form.html.twig', $data);
    }
}
