<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\Components]].
 *
 * @see \app\models\Components
 */
class ComponentsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\Components[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Components|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function orderByTitle()
    {
        return $this->orderBy(['title' => SORT_ASC]);
    }

    // public function getComponentLink($id)
    // {
    //     return
    //     return 'storage/components/' . $this->picture_id .'.jpg';
    // }
}
