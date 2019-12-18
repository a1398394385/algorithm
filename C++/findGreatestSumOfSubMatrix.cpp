#include <cstring>
#include <cstdio>
#include <algorithm>

using namespace std;

int n;
int matrix[110][110];
int temp[110];

int main()
{
    while (scanf("%d", &n) != EOF)
    {
        for (int i = 0; i < n; i++)
            for (int j = 0; j < n; j++)
                scanf("%d", &matrix[i][j]);

        int result = matrix[0][0];
        for (int line = 0; line < n; line++)
        {
            memset(temp, 0, sizeof(temp));
            for (int y = line; y >= 0; y--)
            {
                int maxnum, res;
                for (int index = 0; index < n; index++)
                {
                    temp[index] += matrix[y][index];
                    maxnum = index == 0 ? temp[0] : max(maxnum + temp[index], temp[index]);
                    res = index == 0 ? temp[0] : max(maxnum, res);
                }
                result = max(res, result);
            }
        }
        printf("%d\n", result);
    }

    return 0;
}
