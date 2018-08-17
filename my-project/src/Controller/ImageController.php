<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\ProductCategory;
use App\Form\Image1Type;
use App\Repository\ImageRepository;
use App\Service\ImagesActions;
use App\Service\ImagesCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

/**
 * @Route("/image")
 */
class ImageController extends Controller
{
    /**
     * @Route("/{id}", name="image_delete", methods="DELETE")
     */
    public function delete(Request $request, Image $image, ImagesActions $imagesActions): Response
    {

        if ($this->isCsrfTokenValid('delete'.$image->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();

            $imagesActions->removeImage($image);

            $em->remove($image);
            $em->flush();
        }

        return $this->redirectToRoute('product_category_index');
    }
}