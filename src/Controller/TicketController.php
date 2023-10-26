<?php

namespace App\Controller;

use App\Entity\Ticket;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TicketController extends AbstractController
{
    #[Route('/tickets', name: 'app_tickets')]
    public function index(EntityManagerInterface $em): Response
    {
        $queue = 'open';
        $repo = $em->getRepository(Ticket::class);

        $tickets = $repo->findTicketsByQueue($queue);

        return $this->render('ticket/index.html.twig', [
            'queue'   => $queue,
            'tickets' => $tickets,
        ]);
    }

    #[Route('/tickets/{id}', name: 'app_ticket')]
    public function ticket(EntityManagerInterface $em, $id): Response
    {
        $repo = $em->getRepository(Ticket::class);

        $ticket = $repo->find($id);

        return $this->render('ticket/ticket.html.twig', [
            'ticket' => $ticket,
        ]);
    }
}
