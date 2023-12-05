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

    public function getTafel($idTafel): array
    {
        $tafel = self::getOne(['idtafel' => $idTafel]);
        return [
            (int)$tafel->getColumnValue('idtafel'),
            $tafel->getColumnValue('omschrijving')
        ];
    }

}