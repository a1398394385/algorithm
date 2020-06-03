#include <bits/stdc++.h>
using namespace std;

int a[600001];
int t[600001];
int n, m;

inline int lowbit(int x)
{
    return x & (-x);
}

inline int accumulate(int x)
{
    int ans = 0;
    while (x > 0)
    {
        ans += t[x];
        x -= lowbit(x);
    }
    return ans;
}

inline void update(int x, int value)
{
    while (x <= n)
    {
        t[x] += value;
        x += lowbit(x);
    }
}

int main()
{
    ios::sync_with_stdio(false);
    cin.tie(0), cout.tie(0);
    cin >> n >> m;
    for (register int i = 1; i <= n; ++i)
    {
        cin >> a[i];
        update(i, a[i]);
    }
    int cmd, x, y;
    for (register int i = 1; i <= m; ++i)
    {
        cin >> cmd >> x >> y;
        if (cmd == 1)
            update(x, y);
        else
            cout << accumulate(y) - accumulate(x - 1) << endl;
    }
    return 0;
}