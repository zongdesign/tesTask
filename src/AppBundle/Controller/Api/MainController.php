<?php

namespace AppBundle\Controller\Api;

use AppBundle\Dto\Api\RequestDto;
use AppBundle\Dto\Api\RequestQueryDto;
use AppBundle\Entity\RequestEntity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernel;

class MainController extends Controller
{
    /**
     * @param  Request $request
     * @param  string $route
     *
     * @Route("/storeRequest/{route}")
     * @return JsonResponse
     */
    public function storeRequestAction(Request $request, $route)
    {
        $requestDto = new RequestDto();
        $requestDto->headers   = $request->headers;
        $requestDto->body      = $request->getContent();
        $requestDto->route     = $route;
        $requestDto->method    = $request->getMethod();
        $requestDto->ip        = $request->getClientIp();
        $requestDto->createdAt = new \DateTime();

        try {
            $response = [
                'success' => 'true',
                'id'      => $this->container->get('app.request_saver')->save($requestDto)->getId()
            ];
        } catch (\Exception $e) {
            $response = [
                'success' => 'false',
                'message' => $e->getMessage()
            ];
        }

        return new JsonResponse($response);
    }

    /**
     * @param  Request $request
     *
     * @Route("/getRequest/")
     * @return JsonResponse
     */
    public function getRequestAction(Request $request)
    {
        $requestQuery = new RequestQueryDto();
        $requestQuery->id       = (int) $request->query->get('id');
        $requestQuery->method   = htmlspecialchars($request->query->get('method'));
        $requestQuery->ip       = htmlspecialchars($request->query->get('ip'));
        $requestQuery->route    = htmlspecialchars($request->query->get('route'));
        $requestQuery->search   = htmlspecialchars($request->query->get('search'));
        $requestQuery->lastDays = (int) $request->query->get('last_days');

        $result = $this->container->get('app.request_finder')->find($requestQuery);

        return new JsonResponse($result);
    }
}
