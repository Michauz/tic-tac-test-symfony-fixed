<?php
/**
 * Created by PhpStorm.
 * User: ami
 * Date: 10/29/15
 * Time: 10:02 AM
 */

namespace App\Tic;


class Board
{
    private $grid;
    private $boardSize;
    const NOTHING = '';
    const O = 'O';
    const X = 'X';

    /**
     * Board constructor.
     */
    public function __construct()
    {
        $this->boardSize = 3;
        $this->initGrid();
        $this->clear();
    }

    private function initGrid()
    {
        $this->grid = array(
            // array(),
            // array(),
            // array(),
        );
        for ($i=0; $i < $this->boardSize; $i++) { 
            array_push($this->grid,array());
        }
        $this->boardSize = count($this->grid);
    }

    public function clear()
    {
        for($i = 0; $i < $this->boardSize; $i++) {
            for($j = 0; $j < $this->boardSize; $j++) {
                $this->setSquare($i, $j, self::NOTHING);
            }
        }
    }

    public function getSquare($row, $col)
    {
        return $this->grid[$row][$col];
    }

    public function setSquare($row, $col, $val)
    {
        $this->grid[$row][$col] = $val;
        return $this->getSquare($row, $col);
    }

    public function isFull()
    {
        for($i = 0; $i < $this->boardSize; $i++) {
            for($j = 0; $j < $this->boardSize; $j++) {
                if(self::NOTHING == $this->getSquare($i, $j)) {
                    return false;
                }
            }
        }
        return true;
    }

    public function isEmpty()
    {
        for($i = 0; $i < $this->boardSize; $i++) {
            for($j = 0; $j < $this->boardSize; $j++) {
                if(self::NOTHING != $this->getSquare($i, $j)) {
                    return false;
                }
            }
        }
        return true;
    }

    public function loadBoard($grid)
    {
        $this->grid = $grid;
    }

    public function isBoardWon()
    {
        $res = false;
        for($i = 0; $i < $this->boardSize; $i++) {
            $res = $res || $this->isColWon($i) || $this->isRowWon($i);
        }
        $res = $res || $this->isMainDiagonWon();
        $res = $res || $this->isSecondDiagonWon();
        return $res;
    }

    public function isRowWon($row)
    {
        $square = $this->getSquare($row, 0);
        if(self::NOTHING == $square) {
            return false;
        }
        for($i = 0; $i < $this->boardSize; $i++) {
            if($square != $this->getSquare($row, $i)) {
                return false;
            }
        }
        return true;
    }

    public function isColWon($col)
    {
        $square = $this->getSquare(0, $col);
        if(self::NOTHING == $square) {
            return false;
        }
        for($i = 0; $i < $this->boardSize; $i++) {
            if($square != $this->getSquare($i, $col)) {
                return false;
            }
        }
        return true;
    }

    public function isMainDiagonWon()
    {
        $square = $this->getSquare(0, 0);
        if(self::NOTHING == $square) {
            return false;
        }
        for($i = 0; $i < $this->boardSize; $i++) {
            if($square != $this->getSquare($i, $i)) {
                return false;
            }
        }
        return true;
    }

    public function isSecondDiagonWon()
    {
        $square = $this->getSquare(0, 2);
        if(self::NOTHING == $square) {
            return false;
        }
        for($i = $this->boardSize-1,$j=0; $i >= 0; $i--,$j++) {
            if($square != $this->getSquare($i, $j)) {
                return false;
            }
        }
        return true;
    }

    /**
     * @return mixed
     */
    public function getGrid()
    {
        return $this->grid;
    }

    public function getBoardSize(){
        return $this->boardSize;
    }
    public function setBoardSize($boardSize){
        $this->boardSize = $boardSize;
        $this->initGrid();
        $this->clear();
    }

    public function loadBoardSize($boardSize){
        $this->boardSize = $boardSize;
    }
}