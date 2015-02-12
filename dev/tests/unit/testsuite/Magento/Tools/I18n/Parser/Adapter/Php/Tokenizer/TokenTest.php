<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Tools\I18n\Parser\Adapter\Php\Tokenizer;

use Magento\TestFramework\Helper\ObjectManager;

/**
 * @covers \Magento\Tools\I18n\Parser\Adapter\Php\Tokenizer\Token
 */
class TokenTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;

    protected function setUp()
    {
        $this->objectManager = new ObjectManager($this);
    }

    /**
     * @covers \Magento\Tools\I18n\Parser\Adapter\Php\Tokenizer\Token::isNew
     *
     * @param int $name
     * @param string $value
     * @param bool $result
     * @dataProvider testIsNewDataProvider
     */
    public function testIsNew($name, $value, $result)
    {
        $token = $this->createToken($name, $value);
        $this->assertEquals($result, $token->isNew());
    }

    /**
     * @covers \Magento\Tools\I18n\Parser\Adapter\Php\Tokenizer\Token::isNamespaceSeparator
     *
     * @param int $name
     * @param string $value
     * @param bool $result
     * @dataProvider testIsNamespaceSeparatorDataProvider
     */
    public function testIsNamespaceSeparator($name, $value, $result)
    {
        $token = $this->createToken($name, $value);
        $this->assertEquals($result, $token->isNamespaceSeparator());
    }

    /**
     * @covers \Magento\Tools\I18n\Parser\Adapter\Php\Tokenizer\Token::isIdentifier
     *
     * @param int $name
     * @param string $value
     * @param bool $result
     * @dataProvider testIsIdentifierDataProvider
     */
    public function testIsIdentifier($name, $value, $result)
    {
        $token = $this->createToken($name, $value);
        $this->assertEquals($result, $token->isIdentifier());
    }

    /**
     * @return array
     */
    public function testIsNewDataProvider()
    {
        return [
            'new' => ['name' => T_NEW, 'value' => 'new', 'result' => true],
            'namespace' => ['name' => T_NS_SEPARATOR, 'value' => '\\', 'result' => false],
            'identifier' => ['name' => T_STRING, 'value' => '__', 'result' => false]
        ];
    }

    /**
     * @return array
     */
    public function testIsNamespaceSeparatorDataProvider()
    {
        return [
            'new' => ['name' => T_NEW, 'value' => 'new', 'result' => false],
            'namespace' => ['name' => T_NS_SEPARATOR, 'value' => '\\', 'result' => true],
            'identifier' => ['name' => T_STRING, 'value' => '__', 'result' => false]
        ];
    }

    /**
     * @return array
     */
    public function testIsIdentifierDataProvider()
    {
        return [
            'new' => ['name' => T_NEW, 'value' => 'new', 'result' => false],
            'namespace' => ['name' => T_NS_SEPARATOR, 'value' => '\\', 'result' => false],
            'identifier' => ['name' => T_STRING, 'value' => '__', 'result' => true]
        ];
    }

    /**
     * @param int $name
     * @param string $value
     * @return Token
     */
    protected function createToken($name, $value)
    {
        $line = 110;
        return $this->objectManager->getObject(
            'Magento\Tools\I18n\Parser\Adapter\Php\Tokenizer\Token',
            [
                'name' => $name,
                'value' => $value,
                'line' => $line
            ]
        );
    }
}
