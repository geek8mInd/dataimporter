<?php

namespace App\Library\Concrete;

use App\Library\Contract\DataImporterBundle;
use Config;

/**
 * Allows to import data source from a physical file path
 */
class SourceFileDataImporter implements DataImporterBundle
{
	
	protected $config;

	public function fetchData()
	{
		$this->config = array
		(
			'resource_file_path' => Config::get('dataimporter.webservice.file_resource_path'),
			'resource_file_format' => Config::get('dataimporter.webservice.payload_format')
		);

		return $response = 'consume the resource using fread_csv()';
	}

	public function prepareData()
	{
		return $response = 'remove html entities to protect against cross site scripting';
	}

	public function importData()
	{
		return $response = 'connect on DB ORM and store to tables or collections';
	}
	
}