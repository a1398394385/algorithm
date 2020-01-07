<?php
class AdjacencyArray
{
    protected $dataArray;
    protected $firstArray;
    protected $nextArray;
    protected $point;
    protected $sides;

    public function __construct(int $sides, array $allNode)
    {
        $this->sides = $sides;
        $this->dataArray = [
            'start'  => array_fill(1, $sides, null),
            'end'    => array_fill(1, $sides, null),
            'weight' => array_fill(1, $sides, null)
        ];
        $this->firstArray = array_fill_keys($allNode, -1);
        $this->nextArray = array_fill(1, $sides, null);
        $this->point = (int) 1;
    }

    public function insert($start, $end, $weight = null): bool
    {
        if ($this->point > $this->sides)
            return false;

        $this->dataArray['start'][$this->point]  = $start;
        $this->dataArray['end'][$this->point]    = $end;
        $this->dataArray['weight'][$this->point] = $weight;
        $this->nextArray[$this->point] = $this->firstArray[$start];
        $this->firstArray[$start] = $this->point;
        $this->point += 1;

        return true;
    }

    public function traversalNode($node)
    {
        $result = [
            'end -> weight' => []
        ];
        $point = $this->firstArray[$node];
        while ($point !== -1) {
            $result['end -> weight'][] =
                $this->dataArray['end'][$point] .
                '->' .
                $this->dataArray['weight'][$point];
            $point = $this->nextArray[$point];
        }

        return $result;
    }
}


// TODO:Test
$array = new AdjacencyArray(5, range(1, 4));
$array->insert(1, 4, 9);
$array->insert(4, 3, 8);
$array->insert(1, 2, 5);
$array->insert(2, 4, 6);
$array->insert(1, 3, 7);
var_dump($array->traversalNode(1));
