<?php

use Memory\Memory;
use Memory\MemoryObject;

class MemoryTest extends PHPUnit\Framework\TestCase
{
    public function setUp(): void
    {
        $this->memory = new Memory();
    }

    public function testSaveAndRetrieveData()
    {
        $reference = $this->memory->save([ "foo" => "bar", ]);
        $record = $this->memory->emerge($reference);
        $this->assertEquals( [ "foo" => "bar", ], $record);
    }

    public function testDetectNumberOfRecords()
    {
        $this->memory->save([ ]);
        $this->assertEquals(1 , $this->memory->numberOfRecords());
    }

    public function testDetectRecordIdentifator()
    {
        $reference = $this->memory->save([ "foo" => "bar", ]);
        $record = $this->memory->findRecord([ "foo" => "bar", ]);
        $this->assertEquals($record, [$reference]);
    }

    public function testReturnEmptyArrayWheneverRecordIsNotFound()
    {
        $record = $this->memory->findRecord([ "foo" => "bar", ]);
        $this->assertSame($record, []);
    }

    public function testWeld()
    {
        $this->persistor = $this
            ->getMockBuilder('Memory\Persistor\PersistorPort')
            ->disableOriginalConstructor()
            ->getMock();
        $this->persistor->expects($this->once())
            ->method('know');
        $this->persistor->expects($this->once())
            ->method('persist');

        $this->memory->save([ "foo" => "bar", ]);
        $this->memory->weld($this->persistor);
    }

    public function testRetrieveAllReferenceOfAGivenRecord()
    {
        $reference = [];
        $reference[] = $this->memory->save([ "foo" => "bar", ]);
        $reference[] = $this->memory->save([ "foo" => "bar", ]);
        $reference[] = $this->memory->save([ "foo" => "bar", ]);
        $record = $this->memory->findRecord([ "foo" => "bar", ]);
        $this->assertEquals($record, $reference);
    }

    public function testFindItemsByKeys()
    {
        $this->markTestIncomplete();
    }

    public function testWeldInAppend()
    {
        $this->markTestIncomplete();
    }

    public function testLoadDataFromProducer()
    {
        $this->markTestIncomplete();
    }

    public function testExtractDataWithSelectStatement()
    {
        $this->markTestIncomplete();
    }

    public function testEnableUniqueValues()
    {
        $this->markTestIncomplete();
    }
}
