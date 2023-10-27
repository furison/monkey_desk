<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Form\ReplyTicketType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TicketController extends AbstractController
{
    #[Route('/agent/tickets', name: 'app_tickets')]
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

    #[Route('/agent/tickets/{id}', name: 'app_ticket')]
    public function ticket(EntityManagerInterface $em, $id): Response
    {
        $repo = $em->getRepository(Ticket::class);

        $ticket = $repo->find($id);

        if (!$ticket) {
            throw $this->createNotFoundException('Cannot find ticket id '. $id);
        }

        $form = $this->createForm(ReplyTicketType::class, null, ['subject' => $ticket->getSubject()]);

        return $this->render('ticket/ticket.html.twig', [
            'ticket' => $ticket,
            'form'   => $form->createView(),
        ]);
    }
}
