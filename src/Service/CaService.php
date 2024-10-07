<?php

namespace App\Service;

use App\Repository\InvoiceRepository;
use DateTime;

class CaService
{
    public function calculateCaByDate(InvoiceRepository $invoiceRepository, DateTime $date): float
    {
        $caj = 0;
        $invoices = $invoiceRepository->findByDate($date);
        foreach ($invoices as $invoice) {
            $caj += $invoice->getTotal();
        }
        return $caj;
    }

    public function calculateCaByMonth(InvoiceRepository $invoiceRepository, DateTime $start, DateTime $end): float
    {
        $cam = 0;
        $invoices = $invoiceRepository->findByMonth($start, $end);
        foreach ($invoices as $invoice) {
            $cam += $invoice->getTotal();
        }
        return $cam;
    }

    public function calculateCaByYear(InvoiceRepository $invoiceRepository, DateTime $start, DateTime $end): float
    {
        $caa = 0;
        $invoices = $invoiceRepository->findByYear($start, $end);
        foreach ($invoices as $invoice) {
            $caa += $invoice->getTotal();
        }
        return $caa;
    }
}
