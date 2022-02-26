<?php
namespace App\Library;

use App\Library\Contract\DataImporterBundle;
use Illuminate\Support\Facades\Config;

class DataImporter
{

	protected $dataimporter;

	public function setImporter(DataImporterBundle $dataimporter)
	{
		return $this->dataimporter = $dataimporter;
	}

	public function makeImporter(DataImporterBundle $dataimporter)
	{
		$this->setImporter($dataimporter);

		$this->dataimporter->fetchData();
		$this->dataimporter->prepareData();
		$this->dataimporter->importData();

		return $this->dataimporter;
	}
}