#include <bits/stdc++.h>
using namespace std;

int main()
{
    int bitmap[32];
    int count, value;
    int result = 0;
    scanf("%d", &count);
    for (int i = 0; i < count; i++)
    {
        scanf("%d", &value);
        int index = 31;
        while (value)
        {
            bitmap[index--] += value & 1;
            value = value >> 1;
        }
    }
    for (int i = 0; i < 32; i++)
        result = result << 1 + bitmap[i] % 3;
    printf("%d\n", result);
}
