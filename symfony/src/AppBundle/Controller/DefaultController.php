<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use AppBundle\Entity\Product;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction() {
        return $this->render('default/contact.html.twig');
    }

    /**
     * @Route("/ticTacToe", name="ticTacToe")
     */
    public function ticTacToeAction() {
        return $this->render('default/ticTacToe.html.twig');
    }

    /**
     * @Route("/products", name="products")
     */
    public function listAction()
    {
        $repository = $this->getDoctrine()->getRepository(Product::class);
        $products = $repository->findBy(['deleted' => 0]);
        return $this->render('product/list.html.twig', array(
            'products' => $products,
        ));
    }

    /**
     * @Route("/products/show/{productId}", name="productsshow")
     */
    public function showAction($productId) {
        $product = $this->getDoctrine()->getRepository(Product::class)->find($productId);
        return $this->render('product/show.html.twig', array(
            'product' => $product
        ));
    }

    /**
     * @Route("/products/create", name="productscreate")
     */
    public function createAction(Request $request) {

        $product = new Product();

        $form = $this->createFormBuilder($product)
            ->add('name', TextType::class)
            ->add('price', NumberType::class)
            ->add('description', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Create Product'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // $form->getData() holds the submitted values
            // but, the original `$product` variable has also been updated
            $product = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('products');
        }

        return $this->render('product/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/products/edit/{productId}", name="productsedit")
     */
    public function editAction(Request $request, $productId)
    {

        $product = $this->getDoctrine()->getRepository(Product::class)->find($productId);

        $form = $this->createFormBuilder($product)
            ->add('name', TextType::class)
            ->add('price', NumberType::class)
            ->add('description', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Save Product'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $product = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('products');
        }

        return $this->render('product/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/products/delete/{productId}/{sure}", name="productsdelete")
     */
    public function deleteAction(int $productId, int $sure) {

        $product = $this->getDoctrine()->getRepository(Product::class)->find($productId);

        if ($sure === 1) {

            $product->setDeleted(1);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('products');

        }

        return $this->render('product/delete.html.twig', ['product' => $product]);
    }

}
