<?php

namespace Acme\classes;

use Acme\model\ProductModel;
use Acme\model\ProductTafelModel;
use Acme\model\TafelModel;
use DateTime;

class Rekening
{
    public function setPaid($idTafel): void
    {
        // Update the 'betaald' flag in the database for the specific table
        $tm = new TafelModel();
        $tm->markTableAsPaid($idTafel);
    }

    public function getBill($idTafel)
    {
        $bill = [];
        $bm = new ProductTafelModel();
        $bestelling = $bm->getBestelling($idTafel);

        $tm = new TafelModel();

        $bill['tafel'] = $tm->getTafel($idTafel);
        $bill['datumtijd'] = [
            'timestamp' => $bestelling['datumtijd'],
            'formatted' => date('d-m-Y', $bestelling['datumtijd']) // Fix the date format
        ];

        if (isset($bestelling['products'])) {
            foreach ($bestelling['products'] as $idProduct) {
                if (!isset($bill['products'][$idProduct]['data'])) {
                    $bill['products'][$idProduct]['data'] = (new ProductModel())->getProduct($idProduct);
                }
                if (!isset($bill['products'][$idProduct]['aantal'])) $bill['products'][$idProduct]['aantal'] = 0;
                $bill['products'][$idProduct]['aantal']++;
            }
        }

        // Calculate the total and add it to the bill
        $bill['totaal'] = $this->calculateTotal($bill['products']);

        return $bill;
    }

    /**
     * Calculate the total based on the products and their quantities
     *
     * @param array $products
     * @return float
     */
    private function calculateTotal(array $products): float
    {
        $total = 0.0;

        foreach ($products as $product) {
            $total += $product['data']['prijs'] * $product['aantal'];
        }

        return $total;
    }
}
