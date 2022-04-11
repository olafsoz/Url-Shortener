<?php

namespace Tests\UnitTests;

use App\Models\Url;
use PHPUnit\Framework\TestCase;

class UrlModelTest extends TestCase
{
    protected Url $url;

    public function setup(): void
    {
        $this->url = new Url(
            'https://receptes.tvnet.lv/7496381/ferrero-atsauc-konkretus-kinder-zimola-produktus-pvd-turpina-parbaudes?_ga=2.109887301.1796150967.1649143567-1829075003.1645085534',
            'localhost:8080/1hfb31V1e32',
            1
        );
    }
    /** @test */
    public function it_returns_short_url()
    {
        $result = $this->url->getShortUrl();
        $expected = 'localhost:8080/1hfb31V1e32';

        $this->assertSame($expected, $result);
    }
    /** @test */
    public function it_returns_long_url()
    {
        $result = $this->url->getLongUrl();
        $expected = 'https://receptes.tvnet.lv/7496381/ferrero-atsauc-konkretus-kinder-zimola-produktus-pvd-turpina-parbaudes?_ga=2.109887301.1796150967.1649143567-1829075003.1645085534';

        $this->assertSame($expected, $result);
    }
    /** @test */
    public function it_returns_id()
    {
        $result = $this->url->getId();
        $expected = 1;

        $this->assertSame($expected, $result);
    }
}