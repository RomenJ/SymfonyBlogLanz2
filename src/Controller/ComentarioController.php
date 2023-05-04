<?php

namespace App\Controller;
use App\Entity\Tema;

use App\Entity\Comentario;
use App\Form\ComentarioType;
use App\Repository\ComentarioRepository;
use App\Repository\TemaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Knp\Component\Pager\PaginatorInterface;

#[Route('/comentario')]
class ComentarioController extends AbstractController
{
    #[Route('/', name: 'app_comentario_index', methods: ['GET'])]
    public function index(ComentarioRepository $comentarioRepository,PaginatorInterface $paginator, Request $request): Response
    {


        $query=$comentarioRepository->findMycomentarios();
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            8 /*limit per page*/
        );
    
        // parameters to template
       // return $this->render('article/list.html.twig', ['pagination' => $pagination]);

        return $this->render('comentario/index.html.twig', [
            'pagination' => $pagination,
            'comentarios' => $query,
            'Todosloscomentarios'=>$comentarioRepository->findMycomentarios()

        ]);

        /*
        return $this->render('comentario/index.html.twig', [
            'comentarios' => $comentarioRepository->findAll(),
        ]);*/
    }


    #[Route('/listmodera', name: 'app_comentario_listmodera', methods: ['GET'])]
    public function listmodera(ComentarioRepository $comentarioRepository): Response
    {
        return $this->render('comentario/listmoderaview.html.twig', [
            'comentarios' => $comentarioRepository->findAll(),
        ]);
    }


/* Ocultar comentario  */


#[Route('/{id}/ocultamentario', name: 'app_user_ocultamentario', methods: ['GET', 'POST'])]
public function ocultamentario (Request $request, Comentario $comentario, ComentarioRepository $comentarioRepository): Response
{
    /**By ChatGP3 */
    $form = $this->createFormBuilder($comentario)
    ->add('oculto', ChoiceType::class, [
        'choices' => [
            'Sí' => true,
            'No' => false,
        ],
        'expanded' => true,
        'multiple' => false,
        'label' => '¿Está seguro/a de que desea ocultar el comentario?',
    ])
    ->add('save', SubmitType::class, ['label' => 'Guardar cambios'])
    ->getForm();

$form->handleRequest($request);

if ($form->isSubmitted() && $form->isValid()) {
    $comentarioRepository->save($comentario, true);

    return $this->redirectToRoute('app_comentario_index', [], Response::HTTP_SEE_OTHER);
    
}

return $this->render('comentario/ocultamentario.html.twig', [
    'form' => $form->createView(),
    'comentario' => $comentario,
]);


}






#[Route('/new', name: 'app_comentario_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ComentarioRepository $comentarioRepository): Response
    {
        $comentario = new Comentario();
        $form = $this->createForm(ComentarioType::class, $comentario);
        $form->handleRequest($request);
        $comentario->setUser($this->getUser());

        
        if ($form->isSubmitted() && $form->isValid()) {
            $comentarioRepository->save($comentario, true);

            return $this->redirectToRoute('app_comentario_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('comentario/new.html.twig', [
            'comentario' => $comentario,
            'form' => $form,
        ]);
    }

    /*Comentario0tema*/ 
    #[Route('/{id}/newtemantario', name: 'app_comentario_temantario', methods: ['GET', 'POST'])]
    public function newtemantario(Request $request, ComentarioRepository $comentarioRepository, $id, TemaRepository $temaRepo): Response
    {
        $temacomentado= new Tema();
        $texto=$temacomentado->getDescrition($temaRepo->findOneById($id));
      //  $texto="Pepe está en su casa";
        $comentario = new Comentario();
        $form = $this->createForm(ComentarioType::class, $comentario);
        $form->handleRequest($request);
        $comentario->setTema($temaRepo->findOneById($id));
        $comentario->setUser($this->getUser());
        $temacomentado->getDescrition($temaRepo->findOneById($id));
        


        if ($form->isSubmitted() && $form->isValid()) {
            $comentarioRepository->save($comentario, true);

            return $this->redirectToRoute('app_comentario_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('comentario/new.html.twig', [
            'comentario' => $comentario,
            'form' => $form,
            'temacomentado'=>$temaRepo->findOneById($id),
         //   'textocomentado'=>$temacomentado->getDescrition($temaRepo->findOneById($id)),
            'textocomentado'=>$texto,
            'comentariosxid'=>$comentarioRepository->findByTemasId($id)
      
      
               // 'textocomentado'=>"kjshdkjsh",
        ]);
    }

    #[Route('/{id}', name: 'app_comentario_show', methods: ['GET'])]
    public function show(Comentario $comentario): Response
    {
        return $this->render('comentario/show.html.twig', [
            'comentario' => $comentario,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_comentario_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Comentario $comentario, ComentarioRepository $comentarioRepository): Response
    {
        $form = $this->createForm(ComentarioType::class, $comentario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comentarioRepository->save($comentario, true);

            return $this->redirectToRoute('app_comentario_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('comentario/edit.html.twig', [
            'comentario' => $comentario,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_comentario_delete', methods: ['POST'])]
    public function delete(Request $request, Comentario $comentario, ComentarioRepository $comentarioRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$comentario->getId(), $request->request->get('_token'))) {
            $comentarioRepository->remove($comentario, true);
        }

        return $this->redirectToRoute('app_comentario_index', [], Response::HTTP_SEE_OTHER);
    }
}
