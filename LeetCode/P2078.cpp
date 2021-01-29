#include <bits/stdc++.h>
using namespace std;

int n, m, p, q, u, v, tat, tot;
map<int, int> pre;

int find(int root) {
    if (pre[root] == root) return root;
    return pre[root] = find(pre[root]);
}

void merge(int x, int y) { pre[find(x)] = find(y); }

bool judge(int x, int y) { return find(x) == find(y); }

int main() {
    scanf("%d%d%d%d", &n, &m, &p, &q);
    for (int i = -1 * m; i <= n; i++) pre[i] = i;
    for (int i = 1; i <= p + q; i++) {
        scanf("%d%d", &u, &v);
        merge(u, v);
    }
    for (int i = -1 * m; i <= -1; i++)
        if (judge(pre[i], -1)) tat++;
    for (int i = 1; i <= n; i++)
        if (judge(pre[i], 1)) tot++;

    printf("%d", min(tat, tot));
    return 0;
}