<?php

namespace Sleimanx2\Plastic;

use Illuminate\Pagination\LengthAwarePaginator;

class PlasticPaginator extends LengthAwarePaginator
{
    /**
     * @var PlasticResult
     */
    protected $result;

    /**
     * PlasticPaginator constructor.
     *
     * @param PlasticResult $result
     * @param int           $limit
     * @param int           $page
     */
    public function __construct(PlasticResult $result, $limit, $page)
    {
        $this->result = $result;

        $hits = $result->totalHits();
        if (is_array($hits))
            $hits = $hits['value'];

        parent::__construct($result->hits(), $hits, $limit, $page,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]);

        $hitsReference = &$this->items;

        $result->setHits($hitsReference);
    }

    /**
     * Access the plastic result object.
     *
     * @return PlasticResult
     */
    public function result()
    {
        return $this->result;
    }
}
