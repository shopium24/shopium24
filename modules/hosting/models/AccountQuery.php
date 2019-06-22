<?php

namespace app\modules\hosting\models;

use panix\engine\traits\query\DefaultQueryTrait;
use yii\db\ActiveQuery;

class AccountQuery extends ActiveQuery
{

    use DefaultQueryTrait;

    public function excludeRoot()
    {
        // $this->addWhere(['condition' => 'id != 1']);
        $this->andWhere(['!=', 'id', 1]);
        return $this;
    }
}
