#include <bits/stdc++.h>
#define MAX 100010
using namespace std;

int n, m, a, b;

struct edge {
    int to;
    int next;
} _map[MAX << 1];
int head[MAX], cnt;

int idx, dfn[MAX], low[MAX];

bool cut[MAX];

void add(int u, int v) {
    _map[++cnt].to = v;
    _map[cnt].next = head[u];
    head[u] = cnt;
}

void tarjan(int u, int fa) {
    dfn[u] = low[u] = ++idx;
    // 根节点子树
    int child = 0;
    for (int side = head[u]; side != 0; side = _map[side].next) {
        int v = _map[side].to;
        if (dfn[v] == 0) {
            // 递归处理直连节点
            tarjan(v, fa);
            // 回边更新可达最大祖先节点
            low[u] = min(low[v], low[u]);
            // 确定非根节点是否为割点
            if (low[v] >= dfn[u] && u != fa) cut[u] = true;
            // 根节点子树增加
            if (u == fa) child++;
        }
        // 直连边更新可达最大祖先节点
        low[u] = min(dfn[v], low[u]);
    }
    // 确定根节点是否为割点
    if (child == 2) cut[u] = true;
}

int main(int argc, char const *argv[]) {
    scanf("%d%d", &n, &m);
    for (register int i = 1; i <= m; i++) {
        scanf("%d%d", &a, &b);
        add(a, b);
        add(b, a);
    }
    for (register int u = 1; u <= n; u++) {
        if (dfn[u] == 0) tarjan(u, u);
    }
    int result = 0;
    for (register int u = 1; u <= n; u++) {
        if (cut[u]) result++;
    }
    printf("%d\n", result);
    for (register int u = 1; u <= n; u++) {
        if (cut[u]) printf("%d ", u);
    }
    return 0;
}