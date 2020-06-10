#include <bits/stdc++.h>
using namespace std;

class Solution
{
public:
    const int N = 0;  // North
    const int E = 1;  // East
    const int S = 2;  // South
    const int W = 3;  // West
    const int I = -1; // Impassable
    const int DP[4][7] = {
        {I, I, N, W, E, I, I}, // 北
        {I, E, I, S, I, N, I}, // 东
        {I, I, S, I, I, W, E}, // 南
        {I, W, I, I, S, I, E}, // 西
    };
    const int DIRX[4] = {-1, 0, 1, 0}; //DIRX,DIRY组成了4个列向量，分别是四个方向的单位向量
    const int DIRY[4] = {0, 1, 0, -1};

    bool onfoot(int direction, vector<vector<int>> &grid)
    {
        int x = 0, y = 0;
        // 起点就是目的地
        if (0 == grid.size() - 1 && 0 == grid[0].size() - 1)
            return true;
        while (0 <= x && x < grid.size() && 0 <= y && y < grid[0].size())
        {
            // 朝着direction方向前进一个单位
            x += DIRX[direction];
            y += DIRY[direction];
            if (x >= 0 && y >= 0 && x < grid.size() && y < grid[0].size())
                direction = DP[direction][grid[x][y]]; //更新下一次行走的方向
            if (direction == I)
                return false; // 无法行走，可能是两种路口不相通
            if (x == grid.size() - 1 && y == grid[0].size() - 1)
                return true; // 到达目的地
        }
        return false;
    }

    bool hasValidPath(vector<vector<int>> &grid)
    {
        int direction = -1;
        if (grid[0][0] == 1 || grid[0][0] == 6) // 起始只能向东
            return onfoot(E, grid);
        if (grid[0][0] == 2 || grid[0][0] == 3) // 起始只能向南
            return onfoot(S, grid);
        if (grid[0][0] == 4) // 起始向东/南
            return onfoot(E, grid) || onfoot(S, grid);
        return false;
    }
};