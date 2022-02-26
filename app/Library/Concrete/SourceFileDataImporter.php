<?php

namespace App\Library\Concrete;

use App\Library\Contract\DataImporterBundle;
use Illuminate\Support\Facades\Config;

/**
 * Allows to import data source from a physical file path
 */
class SourceFileDataImporter implements DataImporterBundle
{
	
	protected $config;

	public function __construct()
	{
		$this->config = array
		(
			'resource_file_path' => '/path/to/resource/file',
			'resource_file_format' => 'csv' 
		);
	}

	public function fetchData()
	{
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