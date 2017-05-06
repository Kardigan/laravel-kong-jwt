<?php

use Kardigan\LaravelKongJwt\Jwt;

class JwtTest extends \PHPUnit\Framework\TestCase
{



    public function testGetClaims_Success()
    {
        $jwt = new Jwt();

        $jwt_str = 'b"{"typ":"JWT","alg":"HS256"}{"iss":"c3b43af1da10cb18bde10dcfd343bb3","permissions":["ds.screens.view","ds.playlists.view"]}¤œòº|õDSFsd\fîC\r»\x14}¸5xÈÔ‘¤¯žB—\x1CqžÊîjT\x1C"';

        $claims = $jwt->getClaims($jwt_str);

        $this->assertArrayHasKey('typ', $claims);
        $this->assertArrayHasKey('alg', $claims);
        $this->assertArrayHasKey('iss', $claims);
        $this->assertArrayHasKey('permissions', $claims);

        $this->assertEquals('JWT', $claims['typ']);
        $this->assertEquals('c3b43af1da10cb18bde10dcfd343bb3', $claims['iss']);
        $this->assertTrue(is_array($claims['permissions']));

        $this->assertEquals('ds.screens.view', $claims['permissions'][0]);
        $this->assertEquals('ds.playlists.view', $claims['permissions'][1]);
    }

    public function testParseJwtClaimsString_Success()
    {
        $jwt = new Jwt();

        $jwt_str = 'b"{"typ":"JWT","alg":"HS256"}{"iss":"c3b43af1da10cb18bde10dcfd343bb3","permissions":["ds.screens.view","ds.playlists.view"]}¤œòº|õDSFsd\fîC\r»\x14}¸5xÈÔ‘¤¯žB—\x1CqžÊîjT\x1C"';

        $data = $jwt->parseJwtClaimsString($jwt_str);

        $this->assertTrue(is_array($data));

        $this->assertCount(2, $data);

        $this->assertInstanceOf('StdClass', $data[0]);

        $this->assertInstanceOf('StdClass', $data[1]);

        $this->assertTrue(isset($data[0]->alg));

        $this->assertTrue(isset($data[0]->typ));

        $this->assertTrue(isset($data[1]->iss));

        $this->assertTrue(isset($data[1]->permissions));

    }
}