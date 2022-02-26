<?php
namespace App\Library\Contract;

interface DataImporterBundle {
	function fetchData();
	function prepareData();
	function importData();
}