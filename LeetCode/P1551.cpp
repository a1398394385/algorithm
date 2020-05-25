#include <bits/stdc++.h>
using namespace std;
int father[600000];
int find(int node)
{
    if (father[node] == node)
        return node;
    return father[node] = find(father[node]);
}
void merge(int x, int y)
{
    int xFather = find(x);
    int yFather = find(y);
    if (xFather != yFather)
        father[xFather] = yFather;
}
int main()
{
    int n, m, p;
    scanf("%d%d%d", &n, &m, &p);
    for (int i = 1; i <= n; i++)
        father[i] = i;
    int x, y;
    for (int i = 1; i <= m; i++)
    {
        scanf("%d%d", &x, &y);
        merge(x, y);
    }
    for (int i = 1; i <= p; i++)
    {
        scanf("%d%d", &x, &y);
        if (find(x) == find(y))
            printf("Yes\n");
        else
            printf("No\n");
    }
    return 0;
}