<?php
class Solution
{
    public array $map;
    public array $colors;

    /**
     * 着色法 + DFS
     * 
     * @param Integer $N
     * @param Integer[][] $dislikes
     * @return Boolean
     */
    function possibleBipartition($N, $dislikes): bool
    {
        if ($dislikes == null || count($dislikes) == 0) return true;
        $this->map = array_fill(1, $N, []);
        $this->colors = array_fill(1, $N, 0);
        foreach ($dislikes as $dislike) {
            $this->map[$dislike[0]][] = $dislike[1];
            $this->map[$dislike[1]][] = $dislike[0];
        }

        for ($i = 1; $i <= $N; $i++) {
            if ($this->colors[$i] == 0 && $this->dfs($i, 1) == false)
                return false;
        }

        return true;
    }

    /**
     * @param int $i 节点号
     * @param int $color 颜色 => 1:red | -1:blue
     */
    public function dfs(int $i, int $color): bool
    {
        $this->colors[$i] = $color;
        foreach ($this->map[$i] as $dislike) {
            if ($this->colors[$dislike] == $color) return false;
            if ($this->colors[$dislike] == 0 && $this->dfs($dislike, -$color) == false) return false;
        }
        return true;
    }
}
