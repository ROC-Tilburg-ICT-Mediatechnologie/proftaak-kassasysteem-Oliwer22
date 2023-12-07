<?php

namespace Acme\model;

use Acme\system\Database;

class TafelModel extends Model
{

    protected static string $tableName = "tafel";
    protected static string $primaryKey = "idtafel";

    public function __construct($env = '../.env')
    {
        parent::__construct(Database::getInstance($env));
    }

    public function getAllTafels(): array
    {
        $tafels = self::getAll();
        $result = [];

        foreach ($tafels as $tafel) {
            $result[] = [
                'idtafel' => (int)$tafel->getColumnValue('idtafel'),
                'omschrijving' => $tafel->getColumnValue('omschrijving')
            ];
        }

        return $result;
    }

    public function getTafel($idTafel): array
    {
        $tafel = self::getOne(['idtafel' => $idTafel]);
        return [
            'idtafel' => (int)$tafel->getColumnValue('idtafel'),
            'omschrijving' => $tafel->getColumnValue('omschrijving')
        ];
    }

}
