#include <bits/stdc++.h>
using namespace std;

int sum = 0;
const int N = 100003;
vector<int> v[N];

void DFS(int x, int pre, int w)
{
    for (int i = 0; i < v[x].size(); i++)
    {
        if (v[x][i] != pre)
            DFS(v[x][i], x, w + 1);
    }
    sum = max(sum, w);
}

int main()
{
    int n, x, y;
    cin >> n;
    for (int i = 1; i <= n - 1; i++)
    {
        cin >> x >> y;
        v[x].push_back(y);
        v[y].push_back(x);
    }
    DFS(1, -1, 0);
    cout << 2 * (n - 1) - sum << endl;
    return 0;
}
