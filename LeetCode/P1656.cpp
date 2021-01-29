#include <bits/stdc++.h>
#define MAX 10000
using namespace std;

int n, m, a, b;

struct Edge {
    int to;
    int next;
} _map[MAX << 1];
int head[MAX], cnt;

int idx, dfn[MAX], low[MAX];

struct CutEdge {
    int u;
    int v;
} cut[MAX];
int cutIdx;

void add(int u, int v) {
    _map[++cnt].to = v;
    _map[cnt].next = head[u];
    head[u] = cnt;
}

void addCut(int u, int v) {
    cutIdx++;
    cut[cutIdx].u = min(u, v);
    cut[cutIdx].v = max(u, v);
}

bool compare(const CutEdge a, const CutEdge b) {
    if (a.u != b.u) return a.u < b.u;
    return a.v < b.v;
}

void tarjan(int u, int fa) {
    dfn[u] = low[u] = ++idx;
    for (int side = head[u]; side != 0; side = _map[side].next) {
        int v = _map[side].to;
        if (dfn[v] == 0) {
            // 递归处理直连节点
            tarjan(v, u);
            // 回边更新可达最大祖先节点
            low[u] = min(low[v], low[u]);
            // 当前节点无法回到父节点及其上级节点,直连边即为桥
            if (low[v] > dfn[u]) addCut(u, v);
        }
        // 直连边更新可达最大祖先节点(越过与父级的直连边)
        if (v != fa) low[u] = min(dfn[v], low[u]);
    }
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
    sort(cut, cut + cutIdx + 1, compare);
    for (register int i = 1; i <= cutIdx; i++) {
        printf("%d %d\n", cut[i].u, cut[i].v);
    }
    return 0;
}