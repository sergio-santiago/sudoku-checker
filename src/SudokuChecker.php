<?php declare(strict_types=1);

namespace Secture\Sudoku;

final class SudokuChecker
{
    public function check()
    {
        //Array bidimensional
        //Primer nivel se almacenan filas del sudoku
        //En el segundo nivel se almacenan las comunas de cada fila del sudoku
        $data = $this->readCsv();
        if ($this->checkRows($data) && $this->checkColumns($data) && $this->checkSquares($data)) {
            echo "Validated";
            exit(0);
        }

        echo "NOT Validated";
        exit(0);
    }

    private function readCsv(): array
    {
        //$csvFile = file('../data/right.csv');

        $dataRaw = "1;2;3;9;8;7;6;4;5
4;5;6;3;2;1;7;8;9
7;8;9;4;5;6;1;2;3
5;1;2;8;9;3;4;6;7
3;4;8;6;7;2;5;9;1
9;6;7;1;4;5;2;3;8
6;3;4;5;1;8;9;7;2
2;9;1;7;3;4;8;5;6
8;7;5;2;6;9;3;1;4";

        $data = [];
        foreach ($dataRaw . explode("\n") as $line) {
            $data[] = str_getcsv($line, ";");
        }

        return $data;
    }

    private function checkRows(array $data): bool
    {
        foreach ($data as $rowDataSet) {
            if (!$this->checkDataSet($rowDataSet)) {
                return false;
            }
        }

        return true;
    }

    private function checkColumns(array $data): bool
    {
        for ($i = 0; $i < 9; $i++) {
            $columnDataSet = array_column($data, $i);
            if (!$this->checkDataSet($columnDataSet)) {
                return false;
            }
        }

        return true;
    }

    private function checkSquares(array $data): bool
    {
        return true;
        //Split datat in squares

        //for ($i = 0; $i < 9; $i++) {
        //    $columnDataSet = array_column($data, $i);
        //    if (!$this->checkDataSet($columnDataSet)) {
        //        return false;
        //    }
        //}
        //
        //return true;
    }

    /*
     * Filas
     * Columnas
     * 3 X 3 squares
     */
    private function checkDataSet(array $dataSet): bool
    {
        $uniqValues = array_unique($dataSet);
        if (count($uniqValues) < 9) {
            return false;
        }
        foreach ($dataSet as $item) {

            if (!is_int($item) || $item < 1 || $item > 9 || empty($item)) {
                return false;
            }
        }

        return true;
    }

}
