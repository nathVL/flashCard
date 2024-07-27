<?php

namespace App\Controller;

use App\Entity\File;
use App\Form\AddFileType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        // Rediriger si pas connecté
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }


        return $this->render('home/index.html.twig', [
            'user' => $this->getUser(),
            'routeName' => 'app_home'
        ]);
    }

    #[Route('/file', name: 'app_addFile')]
    public function addFile(Request $request,SluggerInterface $slugger, EntityManagerInterface $em, ): Response
    {
        $file = new File();

        $form = $this->createForm(AddFileType::class, $file);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $slug = strtolower($slugger->slug($file->getName()));
            $file->setSlug($slug);
            $file->setUser($this->getUser());
            $file->setCreatedAt(new \DateTimeImmutable());
            $file->setModifiedAt(new \DateTimeImmutable());

            dd($file->getCreatedAt()->format('Y-m-d'));

            $em->persist($file);
            $em->flush();
            return $this->redirectToRoute('app_home');
        }

        return $this->render('home/add.html.twig', [
            'routeName' => 'app_addFile',
            'form' => $form->createView()
        ]);
    }
}
