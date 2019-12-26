/* 题目描述
给定一个二维整型矩阵，已知矩阵的每一行都按照从小到大的顺序排列，每一列也都按照从小到大的顺序排列。现在给出一个数，请写一个函数返回该数是否存在于矩阵中。
矩阵中出现的数字与需要查找的数(k)都为0~100000之间的整数，且矩阵的大小在3000*3000以内。
在保证正确性的基础上，请尽量给出比较高效的解法。请列出你的算法时间复杂度与空间复杂度分别是多少？

输入描述:

输入两个整数m,n, 且 0<m<=3000, 0<n<=3000。

接着输入一个vector<vector<int>> matrix矩阵，大小为m行n列，与一个int k，为需要查找的数字。

输出描述:

输出true或者false，true表示该数k存在于该matrix矩阵中，false表示该数k不存在于该matrix矩阵中。
 */
#include <iostream>

using namespace std;

int main()
{
    ios_base::sync_with_stdio(false);
    int m, n, number;
    cin >> m >> n;
    int matrix[m][n];
    for (auto &line : matrix)
        for (auto &column : line)
            cin >> column;
    cin >> number;
    int x = 0, y = n - 1;
    while (x < m && y >= 0)
    {
        if (matrix[x][y] < number)
            x++;
        if (matrix[x][y] > number)
            y--;
        if (matrix[x][y] == number)
        {
            cout << "true" << endl;
            return 0;
        }
    }
    cout << "false" << endl;
    return 0;
}
