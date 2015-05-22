<?php


use Application\SchemaValidator;

class SchemaValidatorTest extends PHPUnit_Framework_TestCase {
    public function testThatNoErrorsExistInitially() {
        $validator = $this->getMock('JsonSchema\Validator');
        $v = new SchemaValidator($validator, null);

        $this->assertEmpty($v->getMessages());
    }

    public function testThatSuccessfulValidationReturnsTrue() {
        $validator = $this->getMock('JsonSchema\Validator');
        $validator->expects($this->once())->method('check');
        $validator->expects($this->once())->method('isValid')->willReturn(true);

        $v = new SchemaValidator($validator, null);
        $this->assertTrue($v->isValid(null));
        $this->assertEmpty($v->getMessages());
    }

    public function testThatFailedValidationReturnsErrors() {
        $errors = ['stuff', 'thing'];

        $validator = $this->getMock('JsonSchema\Validator');
        $validator->expects($this->once())->method('check');
        $validator->expects($this->once())->method('isValid')->willReturn(false);
        $validator->expects($this->once())->method('getErrors')->willReturn($errors);

        $v = new SchemaValidator($validator, null);
        $this->assertFalse($v->isValid(null));
        $this->assertEquals($errors, $v->getMessages());
    }
}
