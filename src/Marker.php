<?php

namespace pdk\osmStaticMap;

use phpdk\awt\Point;
use phpdk\lang\TObject;
use phpdk\lang\TString;

class Marker extends TObject
{
    const TYPE_LIGHT_BLUE = 'lightblue';

    /** @var int */
    protected $number;

    /** @var Point */
    protected $point;

    /** @var string */
    protected $type;

    /**
     * Marker constructor.
     * @param Point $point
     * @param string $type
     * @param int $number
     */
    public function __construct(Point $point, string $type = self::TYPE_LIGHT_BLUE, int $number = null)
    {
        $this->number = $number;
        $this->point = $point;
        $this->type = $type;
    }

    public function toString(): TString
    {
        return (new TString(strtr("{x},{y},{type}{number}", [
            '{x}' => $this->point->getX(),
            '{y}' => $this->point->getY(),
            '{type}' => $this->type,
            '{number}' => $this->number,
        ])));
    }
}
