<?php

namespace App\Controller;

use App\Entity\Tema;
use App\Form\TemaType;
use App\Repository\TemaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Repository\ForoRepository;


#[Route('/tema')]
class TemaController extends AbstractController
{
    #[Route('/', name: 'app_tema_index', methods: ['GET'])]
    public function index(TemaRepository $temaRepository): Response
    {
        return $this->render('tema/index.html.twig', [
            'temas' => $temaRepository->findAll(),
        ]);
    }

    #[Route('/moderafulllist', name: 'app_tema_moderafulllist', methods: ['GET'])]
    public function moderafulllist(TemaRepository $temaRepository): Response
    {
        return $this->render('tema/moderatemafullist.html.twig', [
            'temas' => $temaRepository->findAll(),
        ]);
    }


    #[Route('/admintemafullist', name: 'app_tema_admintemafullist', methods: ['GET'])]
    public function admintemafullist(TemaRepository $temaRepository): Response
    {
        return $this->render('tema/admintemafullist.html.twig', [
            'temas' => $temaRepository->findAll(),
        ]);
    }

/* Ocultar tema  */


#[Route('/{id}/ocultame', name: 'app_user_ocultame', methods: ['GET', 'POST'])]
public function ocultame (Request $request, Tema $tema, TemaRepository $temaRepository): Response
{
    /**By ChatGP3 */
    $form = $this->createFormBuilder($tema)
    ->add('oculto', ChoiceType::class, [
        'choices' => [
            'Sí' => true,
            'No' => false,
        ],
        'expanded' => true,
        'multiple' => false,
        'label' => '¿Está seguro/a de que desea ocultar el tema?',
    ])
    ->add('save', SubmitType::class, ['label' => 'Guardar cambios'])
    ->getForm();

$form->handleRequest($request);

if ($form->isSubmitted() && $form->isValid()) {
    $temaRepository->save($tema, true);

    return $this->redirectToRoute('app_tema_index', [], Response::HTTP_SEE_OTHER);
    
}

return $this->render('tema/ocultame.html.twig', [
    'form' => $form->createView(),
    'tema' => $tema,
]);


}

 #[Route('/new', name: 'app_tema_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TemaRepository $temaRepository): Response
    {
        $tema = new Tema();

        $form = $this->createForm(TemaType::class, $tema);
        //$listareproduccion-> setUser($this->getUser());
        $tema->setCreatortema($this->getUser());
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $temaRepository->save($tema, true);
            return $this->redirectToRoute('app_tema_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tema/new.html.twig', [
            'tema' => $tema,
            'form' => $form,
        ]);
    }


    #[Route('/{id}/newtema2', name: 'app_tema_newtema2', methods: ['GET', 'POST'])]
    public function newtema2(Request $request, TemaRepository $temaRepository,ForoRepository $foroRepository,$id): Response
    {
        $tema = new Tema();
        $form = $this->createForm(TemaType::class, $tema);
        //$listareproduccion-> setUser($this->getUser());
        $tema->setCreatortema($this->getUser());
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //Invalid: $tema->setForo($this->getForo());
            
            $tema->setForo($foroRepository->findOneById($id));
            $temaRepository->save($tema, true);
            
            return $this->redirectToRoute('app_tema_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tema/new.html.twig', [
            'tema' => $tema,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tema_show', methods: ['GET'])]
    public function show(Tema $tema): Response
    {
        return $this->render('tema/show.html.twig', [
            'tema' => $tema,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tema_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tema $tema, TemaRepository $temaRepository): Response
    {
        $form = $this->createForm(TemaType::class, $tema);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $temaRepository->save($tema, true);

            return $this->redirectToRoute('app_tema_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tema/edit.html.twig', [
            'tema' => $tema,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tema_delete', methods: ['POST'])]
    public function delete(Request $request, Tema $tema, TemaRepository $temaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tema->getId(), $request->request->get('_token'))) {
            $temaRepository->remove($tema, true);
        }

        return $this->redirectToRoute('app_tema_index', [], Response::HTTP_SEE_OTHER);
    }
}
