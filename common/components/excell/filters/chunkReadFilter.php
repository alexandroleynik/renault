<?php

/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 25.02.2016
 * Time: 12:29
 */
namespace common\components\excel\filters;
use PHPExcel_Reader_IReadFilter;

class chunkReadFilter implements PHPExcel_Reader_IReadFilter  {
    private $_startRow = 0;
    private $_endRow   = 0;
    public function setRows($startRow, $chunkSize) {
        $this->_startRow = $startRow;
        $this->_endRow   = $startRow + $chunkSize;
    }
    public function readCell($column, $row, $worksheetName = '') {
        if ( $row >= $this->_startRow && $row < $this->_endRow ) {
            return true;
        }
        return false;
    }
}