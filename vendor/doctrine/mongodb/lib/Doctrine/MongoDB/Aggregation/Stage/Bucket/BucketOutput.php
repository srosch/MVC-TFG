<?php

namespace Doctrine\MongoDB\Aggregation\Stage\Bucket;

use Doctrine\MongoDB\Aggregation\Builder;
use Doctrine\MongoDB\Aggregation\Expr;
use Doctrine\MongoDB\Aggregation\Stage;

/**
 * Fluent interface for adding an output specification to a bucket stage.
 *
 * @author alcaeus <alcaeus@alcaeus.org>
 * @since 1.5
 */
class BucketOutput extends AbstractOutput
{
    /**
     * @param Builder $builder
     * @param Stage\Bucket $bucket
     */
    public function __construct(Builder $builder, Stage\Bucket $bucket)
    {
        parent::__construct($builder, $bucket);
    }

    /**
     * An expression to group documents by. To specify a field path, prefix the
     * field name with a dollar sign $ and enclose it in quotes.
     *
     * @param mixed|Expr $expression
     * @return Stage\Bucket
     */
    public function groupBy($expression)
    {
        return $this->bucket->groupBy($expression);
    }

    /**
     * An array of values based on the groupBy expression that specify the
     * boundaries for each bucket.
     *
     * Each adjacent pair of values acts as the inclusive lower boundary and the
     * exclusive upper boundary for the bucket. You must specify at least two
     * boundaries. The specified values must be in ascending order and all of
     * the same type. The exception is if the values are of mixed numeric types.
     *
     * @param array ...$boundaries
     *
     * @return Stage\Bucket
     */
    public function boundaries(...$boundaries)
    {
        return $this->bucket->boundaries(...$boundaries);
    }

    /**
     * A literal that specifies the _id of an additional bucket that contains
     * all documents whose groupBy expression result does not fall into a bucket
     * specified by boundaries.
     *
     * @param mixed $default
     *
     * @return Stage\Bucket
     */
    public function defaultBucket($default)
    {
        return $this->bucket->defaultBucket($default);
    }
}
