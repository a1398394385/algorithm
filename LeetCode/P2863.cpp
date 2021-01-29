#include <bits/stdc++.h>
#define MAX 100010
using namespace std;

int n, m, a, b;

struct Edge {
    int to;
    int next;
} _map[MAX << 1];
int head[MAX], cnt;

int idx, dfn[MAX], low[MAX];

int sig, tops[MAX], top, topIdx;
bool flag[MAX];
vector<int> sigMap[MAX];

void add(int u, int v) {
    _map[++cnt].to = v;
    _map[cnt].next = head[u];
    head[u] = cnt;
}

void tarjan(int u, int fa) {
    dfn[u] = low[u] = ++idx;
    tops[topIdx++] = u;
    for (int side = head[u]; side != 0; side = _map[side].next) {
        int v = _map[side].to;
        if (dfn[v] == 0) tarjan(v, u);               // 递归处理直连节点
        if (!flag[v]) low[u] = min(low[v], low[u]);  // 回边更新可达最大祖先节点
    }
    if (dfn[u] == low[u]) {
        sig++;
        do {
            top = tops[--topIdx];
            sigMap[sig].push_back(top);
            flag[top] = true;
        } while (top != u);
    }
}

int main(int argc, char const *argv[]) {
    scanf("%d%d", &n, &m);
    for (register int i = 1; i <= m; i++) {
        scanf("%d%d", &a, &b);
        add(a, b);
    }
    for (register int u = 1; u <= n; u++) {
        if (dfn[u] == 0) tarjan(u, u);
    }
    int result = 0;
    for (register int i = 1; i <= sig; i++) {
        if (sigMap[i].size() > 1) result++;
    }
    printf("%d", result);
    return 0;
}