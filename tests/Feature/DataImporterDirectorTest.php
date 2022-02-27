<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Library\Concrete\WebserviceDataImporter;
use App\Library\Concrete\SourceFileDataImporter;
use App\Library\Contract\DataImporterBundle;
use App\Library\DataImporter;

class DataImporterDirectorTest extends TestCase
{

    protected $director;

    protected function setUp()
    {
        dd(getenv('DATAIMPORTER_URL'));
        parent::setUp();
        $this->director = new DataImporter();
    }

    /**
     * @dataProvider dataImporterPlatformsDataProvider
    */
    public function testIfDataImporterDirectorIsNotCoupled(DataImporterBundle $platform)
    {
        $instance = $this->director->makeImporter($platform);
        $this->assertInstanceOf(DataImporterBundle::class, $instance);
    }

    public function dataImporterPlatformsDataProvider()
    {
        return array(
            array(new SourceFileDataImporter()),
            array(new WebserviceDataImporter())
        );
    }

    public function tearDown()
    {
        parent::tearDown();
        $this->director = null;
    }

}
