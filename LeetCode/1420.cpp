#include <bits/stdc++.h>
using namespace std;

class Solution
{
public:
    static int numOfArrays(int n, int m, int k)
    {
        //dp[m][k]:k个cost，且max=m时的个数
        //dp[i][j] = (dp[i][j]*i)+(dp[i-1][j-1]+dp[i-2][j-1]+...+dp[1][j-1])*1;
        vector<vector<long>> cur(m + 1, vector<long>(k + 1, 0));
        vector<vector<long>> last(m + 1, vector<long>(k + 1, 0));
        vector<vector<long>> temp(m + 1, vector<long>(k + 1, 0));
        long ans = 0;
        long M = pow(10, 9) + 7;
        for (int i = 1; i <= m; i++)
            last[i][1] = 1;
        for (int i = 2; i <= n; i++)
        {
            for (int j = 1; j <= m; j++)
            {
                for (int h = 1; h <= k; h++)
                {
                    cur[j][h] = (cur[j][h] + last[j][h] * j) % M;
                    for (int t = 1; t <= j - 1; t++)
                        cur[j][h] = (cur[j][h] + last[t][h - 1]) % M;
                }
            }
            last = cur;
            cur = temp;
        }
        for (int i = 1; i <= m; i++)
            ans += (ans + last[i][k]) % M;
        return ans;
    }

    static int numOfArrays1(int n, int m, int k)
    {
        long dp[n + 1][m + 1][k + 1], mod = 1e9 + 7;
        memset(dp, 0, sizeof(dp));
        for (int i = 1; i <= m; ++i)
            dp[1][i][1] = 1;
        for (int i = 2; i <= n; ++i)
        {
            for (int j = 1; j <= m; ++j)
            {
                for (int cost = 1; cost <= k; ++cost)
                {
                    // dp[i][j][cost] 为: 长度为 i, 最大值为 j, 代价为 cost 的数组数量
                    // 转换思路要理清:
                    // 假如之前的最大值 > j, 则这次的最大值一定大于 j
                    // 假如之前的最大值 < j, 则一定是这次添加了 j. sum(dp[i-1][1~j-1][cost-1])
                    // 假如之前的最大值 == j, 则这次可以添加 1 ~ j. j * dp[i-1][j][cost]
                    // 起始条件:
                    // 对所有长度为 1 的数组, dp[1][1 ~ m][1] = 1。([1] ~ [m])
                    dp[i][j][cost] = j * dp[i - 1][j][cost];
                    for (int less = 1; less < j; ++less)
                        dp[i][j][cost] += dp[i - 1][less][cost - 1];
                    dp[i][j][cost] %= mod;
                }
            }
        }
        long res = 0;
        for (int i = 1; i <= m; ++i)
            res += dp[n][i][k];
        return res % mod;
    }
};

int main(int argc, char const *argv[])
{
    int n = 20;
    for (int k = 20; k >= 0; k--)
    {
        for (int m = 20; m >= 0; m--)
        {
            cout << Solution::numOfArrays(n, m, k) << "  ";
        }
        cout << endl;
    }
    return 0;
}
