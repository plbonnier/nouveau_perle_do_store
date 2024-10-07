<?php

namespace App\Controller;

use App\Repository\InvoiceRepository;
use App\Service\CaService;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CaController extends AbstractController
{
    #[Route('/ca', name: 'app_ca')]
    public function index(
        CaService $caService,
        InvoiceRepository $invoiceRepository,
        Request $request
    ): Response {
        $dateString = $request->query->get('date');
        $date = $dateString ? new DateTime($dateString) : new DateTime();

        $caj = $caService->calculateCaByDate($invoiceRepository, $date);
        $invoices = $invoiceRepository->findByDate($date);

        return $this->render('ca/index.html.twig', [
            'ca' => $caj,
            'invoices' => $invoices,
            'selected_date' => $date->format('Y-m-d'),
        ]);
    }

    #[Route('/ca/mensuel', name: 'app_ca_monthly')]
    public function monthly(CaService $caService, InvoiceRepository $invoiceRepository, Request $request): Response
    {
        $monthString = $request->query->get('month');
        $date = $monthString ? new DateTime($monthString . '-01') : new DateTime();

        // Définir les dates de début et de fin du mois
        $start = (clone $date)->modify('first day of this month')->setTime(0, 0, 0);
        $end = (clone $date)->modify('last day of this month')->setTime(23, 59, 59);

        $cam = $caService->calculateCaByMonth($invoiceRepository, $start, $end);
        $invoices = $invoiceRepository->findByMonth($start, $end);

        $formattedDate = $date->format('F Y');

        return $this->render('ca/month.html.twig', [
            'ca' => $cam,
            'invoices' => $invoices,
            'selected_date' => $date->format('Y-m'),
            'formatted_date' => $formattedDate,
        ]);
    }

    #[Route('/ca/annuel', name: 'app_ca_year')]
    public function yearly(CaService $caService, InvoiceRepository $invoiceRepository, Request $request): Response
    {
        $yearString = $request->query->get('year');
        $date = $yearString ? new DateTime($yearString . '-01-01') : new DateTime();

        // Définir les dates de début et de fin de l'année
        $start = (clone $date)->modify('first day of this year')->setTime(0, 0, 0);
        $end = (clone $date)->modify('last day of this year')->setTime(23, 59, 59);

        $caa = $caService->calculateCaByYear($invoiceRepository, $start, $end);
        $invoices = $invoiceRepository->findByYear($start, $end);

        return $this->render('ca/year.html.twig', [
            'ca' => $caa,
            'invoices' => $invoices,
            'selected_date' => $date->format('Y'),
        ]);
    }
}
