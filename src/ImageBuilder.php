<?php

namespace pdk\osmStaticMap;

use phpdk\awt\Point;
use phpdk\net\Url;

class ImageBuilder
{
    protected $domain = 'http://staticmap.openstreetmap.de/';

    protected $zoom = 1;

    /** @var Point */
    protected $center;
    /** @var Point */
    protected $size;

    protected $markers = [];


    public function addMarker(Marker $p)
    {
        $this->markers[] = $p;
    }

    public function setCenter(Point $center)
    {
        $this->center = $center;
    }

    /**
     * @param int $zoom
     */
    public function setZoom(int $zoom): void
    {
        $this->zoom = $zoom;
    }

    public function setSize(int $width, int $height)
    {
        $this->size = new Point($width, $height);
    }

    public function build(): Url
    {
        $url = $this->domain;

        $params = [
            'aptype' => 'mapnik',
        ];

        if ($this->markers) {
            $params['markers'] = implode('|', array_map(function (Marker $marker) {
                return (string)$marker->toString();
            }, $this->markers));
        }

        if ($this->size) {
            $params['size'] = implode('x', [
                $this->size->getX(),
                $this->size->getY(),
            ]);
        }

        if ($this->zoom) {
            $params['zoom'] = $this->zoom;
        }

        if ($this->center) {
            $params['center'] = $this->center->getX() . ',' . $this->center->getY();
        }

        $url .= 'staticmap.php?' . http_build_query($params);

        return new Url($url);
    }
}
