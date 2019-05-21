<?php

namespace Memory\Unit;

use Memory\Services\Memory;
use PHPUnit\Framework\TestCase;

class MemoryTest extends TestCase
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

        $record = $this->memory->findRecordBy(
            [ "foo" => "bar", ],
            Memory::FILL_REFERENCE
        );

        $this->assertEquals($record, [$reference]);
    }

    public function testReturnEmptyArrayWheneverRecordIsNotFound()
    {
        $record = $this->memory->findRecordBy(
            [ "foo" => "bar", ],
            Memory::FILL_REFERENCE
        );
        $this->assertSame($record, []);
    }

    public function testRetrieveAllReferenceOfAGivenRecord()
    {
        $reference = [];
        $reference[] = $this->memory->save([ "foo" => "bar", ]);
        $reference[] = $this->memory->save([ "foo" => "bar", ]);
        $reference[] = $this->memory->save([ "foo" => "bar", ]);
        $record = $this->memory->findRecordBy(
            [
                "foo" => "bar",
            ], Memory::FILL_REFERENCE
        );
        $this->assertEquals($record, $reference);
    }

    public function testFindItemsByKeys()
    {
        $this->memory->save([
            "foo2" => "bar1",
            "foo1" => "bar1",
        ]);

        $firstMatch = $this->memory->save([
            "foo2" => "bar2",
            "foo1" => "bar2",
        ]);

        $this->memory->save([
            "foo2" => "bar3",
            "foo1" => "bar3",
        ]);

        $secondMatch = $this->memory->save([
            "foo2" => "bar4",
            "foo1" => "bar2",
        ]);

        $record = $this->memory->findRecordBy([
            "foo1" => "bar2",
        ]);

        $this->assertEquals($record, [
            $firstMatch,
            $secondMatch,
        ]);
    }

    public function testFindItemsByMoreKeysAndValues()
    {
        $r = [];

        $r[] = $this->memory->save([
            "foo2" => "bar1",
            "foo1" => "bar1",
            "aaa"  => "aaa",
        ]);

        $this->memory->save([
            "foo2" => "bar2",
            "foo1" => "bar2",
        ]);

        $r[] = $this->memory->save([
            "foo2" => "bar3",
            "bbb"  => "bbb",
            "foo1" => "bar3",
        ]);

        $r[] = $this->memory->save([
            "foo2" => "bar4",
            "foo1" => "bar2",
            "bbb"  => "bbb",
        ]);

        $record = $this->memory->findRecordBy([
            "aaa" => "aaa",
            "bbb" => "bbb",
        ]);

        $this->assertEquals($record, $r);
    }

    public function testRetrieveAllDataOfAGivenRecord()
    {
        $first = $this->memory->save([ "foo" => "bar", ]);

        $results = $this->memory->findRecordBy([ "foo" => "bar", ], Memory::FILL_DATA);

        $this->assertEquals($results, [
            $first => $this->memory->emerge($first),
        ]);
    }

    public function testDoNotMatchWrongKeyValuePair()
    {
        $memory = new Memory();

        $memory->save([ 'name' => 'Simone', 'cognome' => 'Gentili' ]);
        $memory->save([ 'name' => 'Ilaria', 'cognome' => 'Monti' ]);

        $result = $memory->findRecordBy([
            'cognome' => 'Simone',
        ], Memory::FILL_DATA);

        $this->assertEquals([], $result);
    }
}
