<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Knp\Component\Pager\PaginatorInterface;


#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository,PaginatorInterface $paginator, Request $request): Response
    {

        $query=$userRepository->findMyUsers();
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit per page*/
        );
    
        // parameters to template
       // return $this->render('article/list.html.twig', ['pagination' => $pagination]);

        return $this->render('user/index.html.twig', [
            'pagination' => $pagination,
            'comentarios' => $query,
            'Todosloscomentarios'=>$userRepository->findMyUsers()

        ]);




        /*
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);*/

    }

    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserRepository $userRepository): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
/**Bannear List */
    #[Route('/banearlist', name: 'app_user_banearlist', methods: ['GET', 'POST'])]
    public function banearlist(UserRepository $userRepository): Response
    {
        return $this->render('user/banear.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }
/**Permission  List */
    #[Route('/permissonlist', name: 'app_user_permissonlist', methods: ['GET', 'POST'])]
    public function permissonlist(UserRepository $userRepository): Response
    {
        return $this->render('user/permissonlist.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }



    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

/* Permisar User  */


#[Route('/{id}/permisame', name: 'app_user_permisame', methods: ['GET', 'POST'])]
public function permisame(Request $request, User $user, UserRepository $userRepository): Response
{
 
  
    /**By ChatGP3 */
    
    $form = $this->createFormBuilder($user)
    ->add('roles', ChoiceType::class, [
        'choices' => [
            'User' => 'ROLE_USER',
          'Admin' => 'ROLE_ADMIN',
        ],
        'expanded' => true,
        'multiple' => true,
        'label' => 'Elija el tipo de user deseado',
    ])
    ->add('save', SubmitType::class, ['label' => 'Guardar cambios'])
    ->getForm();

$form->handleRequest($request);

if ($form->isSubmitted() && $form->isValid()) {
    $userRepository->save($user, true);
    return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
  
}

return $this->render('user/permisame.html.twig', [
    'form' => $form->createView(),
    'user' => $user,
]);

}


/* Banear User  */


#[Route('/{id}/baneame', name: 'app_user_baneame', methods: ['GET', 'POST'])]
public function baneame(Request $request, User $user, UserRepository $userRepository): Response
{
    /**By ChatGP3 */
    $form = $this->createFormBuilder($user)
    ->add('banned', ChoiceType::class, [
        'choices' => [
            'Sí' => true,
            'No' => false,
        ],
        'expanded' => true,
        'multiple' => false,
        'label' => '¿Está seguro/a de banear al user?',
    ])
    ->add('save', SubmitType::class, ['label' => 'Guardar cambios'])
    ->getForm();

$form->handleRequest($request);

if ($form->isSubmitted() && $form->isValid()) {
    $userRepository->save($user, true);
  /*
  Generado por chatGP3 
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->flush();
   */
    return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    //return $this->redirectToRoute('user_show', ['id' => $user->getId()]);
}

return $this->render('user/baneame.html.twig', [
    'form' => $form->createView(),
    'user' => $user,
]);

    /*
    $form = $this->createForm(UserType::class, $user);
   
   
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $userRepository->save($user, true);

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }

    return $this->renderForm('user/baneame.html.twig', [
        'user' => $user,
        'form' => $form,
    ]);*/

}



    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
