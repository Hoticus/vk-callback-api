<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class APIController extends AbstractController
{
    #[Route('/', name: 'API', methods: ['POST'])]
    public function index(Request $request): Response
    {
        $request_content = json_decode($request->getContent(), true);

        switch ($request_content['type']) {
            case 'confirmation':
                if (!isset($_ENV['VK_CONFIRMATION_TOKEN'], $_ENV['VK_GROUP_ID'])) {
                    return $this->json(
                        ['error' => ['error_msg' => 'Please define VK_CONFIRMATION_TOKEN, VK_GROUP_ID env vars']],
                        500
                    );
                }
                if (
                    $request_content['group_id'] != $_ENV['VK_GROUP_ID']
                    ||
                    (isset($_ENV['VK_SECRET_KEY'])
                        && !(isset($request_content['secret']) && $request_content['secret'] == $_ENV['VK_SECRET_KEY']))
                ) {
                    return $this->json(
                        ['error' => ['error_msg' => 'Bad request']],
                        400
                    );
                }

                $return = new Response($_ENV['VK_CONFIRMATION_TOKEN']);
                break;
            default:
                $return = $this->json(
                    ['error' => ['error_msg' => 'Bad request']],
                    400
                );
                break;
        }

        return $return ?? new Response('Ok');
    }
}
