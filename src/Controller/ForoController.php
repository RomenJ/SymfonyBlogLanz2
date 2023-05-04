<?php

namespace App\Controller;

use App\Entity\Foro;
use App\Form\ForoType;
use App\Repository\ForoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Knp\Component\Pager\PaginatorInterface;
#[Route('/foro')]
class ForoController extends AbstractController
{
    #[Route('/', name: 'app_foro_index', methods: ['GET'])]
    public function index(ForoRepository $foroRepository,PaginatorInterface $paginator, Request $request): Response
    {


        $query=$foroRepository->findMyUsers();
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit per page*/
        );
        return $this->render('foro/index.html.twig', [
            'foros' => $foroRepository->findAll(),

            'pagination' => $pagination,
            'comentarios' => $query,
            'Todosloscomentarios'=>$foroRepository->findMyUsers()
        ]);
    }

    #[Route('/new', name: 'app_foro_new', methods: ['GET', 'POST'])]
    public function new(SluggerInterface $slugger, Request $request, ForoRepository $foroRepository): Response
    {
        $foro = new Foro();
        $form = $this->createForm(ForoType::class, $foro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $FotoFile = $form->get('foto')->getData();
            if($FotoFile){

                $originalFilename = pathinfo($FotoFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'. $FotoFile ->guessExtension();
           
                try {
                    //$peli->setPoster($newFilename);

                    $foro->setFoto($newFilename);
                    $FotoFile->move(
                        //aquí va el nombre de parámetro
                      
                    $this->getParameter('images_path'),
                    $newFilename
                );
                    //
                 
                    
              } catch (FileException $e) {
                  // ... handle exception if something happens during file upload
              }
           

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
              //  $product->setBrochureFilename($newFilename);

            }

            $foro->setFoto($newFilename);
            $foroRepository->save($foro, true);

            return $this->redirectToRoute('app_foro_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('foro/new.html.twig', [
            'foro' => $foro,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_foro_show', methods: ['GET'])]
    public function show(Foro $foro): Response
    {
        return $this->render('foro/show.html.twig', [
            'foro' => $foro,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_foro_edit', methods: ['GET', 'POST'])]
    public function edit(SluggerInterface $slugger,Request $request, Foro $foro, ForoRepository $foroRepository): Response
    {
        $form = $this->createForm(ForoType::class, $foro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           /*Sección relatiba a foto*/
           $FotoFile = $form->get('foto')->getData();
           if($FotoFile){

               $originalFilename = pathinfo($FotoFile->getClientOriginalName(), PATHINFO_FILENAME);
               $safeFilename = $slugger->slug($originalFilename);
               $newFilename = $safeFilename.'-'.uniqid().'.'. $FotoFile ->guessExtension();
          
               try {
                   //$peli->setPoster($newFilename);

                   $foro->setFoto($newFilename);
                   $FotoFile->move(
                       //aquí va el nombre de parámetro
                     
                   $this->getParameter('images_path'),
                   $newFilename
               );
                   //
                
                   
             } catch (FileException $e) {
                 // ... handle exception if something happens during file upload
             }
          

               // updates the 'brochureFilename' property to store the PDF file name
               // instead of its contents
             //  $product->setBrochureFilename($newFilename);

           }

           $foro->setFoto($newFilename);
           /*Fin de sección relativa a foto */
            $foroRepository->save($foro, true);

            return $this->redirectToRoute('app_foro_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('foro/edit.html.twig', [
            'foro' => $foro,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_foro_delete', methods: ['POST'])]
    public function delete(Request $request, Foro $foro, ForoRepository $foroRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$foro->getId(), $request->request->get('_token'))) {
            $foroRepository->remove($foro, true);
        }

        return $this->redirectToRoute('app_foro_index', [], Response::HTTP_SEE_OTHER);
    }
}
