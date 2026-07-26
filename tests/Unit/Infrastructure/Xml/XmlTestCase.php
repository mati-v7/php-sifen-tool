<?php

namespace Nyxcode\PhpSifenTool\Tests\Unit\Infrastructure\Xml;

use PHPUnit\Framework\TestCase;
use SimpleXMLElement;

abstract class XmlTestCase extends TestCase
{
    protected function assertXmlEquals(
        string $expected,
        string $actual,
    ): void {
        $this->assertXmlStringEqualsXmlString(
            $expected,
            $actual,
        );
    }

    protected function evaluateXPath(string $xml, string $xpathRoute): ?string
    {
        $simpleXml = new SimpleXMLElement($xml);
        $result = $simpleXml->xpath($xpathRoute);

        if ($result === false || empty($result)) {
            return null;
        }

        return (string) $result[0];
    }

    protected function assertXmlPathValue(
        string $expected,
        string $xpathRoute,
        string $xml
    ): void {
        $actualValue = $this->evaluateXPath($xml, $xpathRoute);

        $this->assertSame(
            $expected,
            $actualValue,
            "Failed to validate that the node at '$xpathRoute' was '$expected'. Actual value: '$actualValue'."
        );
    }
}
