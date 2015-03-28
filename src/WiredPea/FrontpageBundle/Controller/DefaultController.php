<?php

namespace WiredPea\FrontpageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('WiredPeaFrontpageBundle:Default:index.html.twig', array());
    }
}
