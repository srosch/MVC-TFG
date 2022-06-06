<?php

namespace Documents\Sharded;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document(collection="sharded.one")
 * @ODM\Index(keys={"k"="asc"})
 * @ODM\ShardKey(keys={"k"="asc"})
 */
class ShardedOne
{
    /** @ODM\Id */
    public $id;

    /** @ODM\Field(type="string") */
    public $title = 'test';

    /** @ODM\Field(name="k", type="string") */
    public $key = 'testing';

    /**
     * @ODM\ReferenceOne(targetDocument=ShardedUser::class)
     */
    public $user;
}
