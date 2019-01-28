<?php
namespace App\Controller\Rest\V1;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
/**
 * @Route("/V1")
 */
class AuthController extends FOSRestController
{
    /**
     * @Route("/user/info", name="get_user_info")
     */
    public function api()
    {
        $user = array(
            'data' => array(
                'name' => $this->getUser()->getUsername(),
                'roles'=> 'admin',
                'avatar' => 'https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif'
            )
        );
        //$result = json_decode($user);
        return $user;
        //return new Response(sprintf('Logged in as %s', $this->getUser()->getUsername()));
    }

    /**
     * @Route("/user/logout", name="user_logout")
     */
    public function logout()
    {
        return true;
    }
}