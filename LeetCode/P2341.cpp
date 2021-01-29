#include <bits/stdc++.h>
#define MAX 50005
using namespace std;

int n, m, a, b;

struct edge {
    int to;
    int next;
} _map[MAX];
int head[MAX], cnt;

int idx, dfn[MAX], low[MAX];

vector<int> sigMap[MAX];
int tops[MAX], topIdx, top, sig, color[MAX];
bool flag[MAX];

void add(int u, int v) {
    _map[++cnt].to = v;
    _map[cnt].next = head[u];
    head[u] = cnt;
}

void tarjan(int u) {
    dfn[u] = low[u] = ++idx;
    // 当前节点入栈
    tops[topIdx++] = u;
    for (int side = head[u]; side != 0; side = _map[side].next) {
        int v = _map[side].to;
        // 递归处理直连节点
        if (dfn[v] == 0) tarjan(v);
        // 直连边更新可达最大祖先节点
        if (!flag[v]) low[u] = min(low[v], low[u]);
    }
    // 强连通分量首节点
    if (dfn[u] == low[u]) {
        sig++;
        // 遍历栈
        do {
            top = tops[--topIdx];
            // 染色
            color[top] = sig;
            flag[top] = true;
            sigMap[sig].push_back(top);
        } while (top != u);
    }
}

// 出度是否为0
bool isZero(int sig) {
    for (int u : sigMap[sig]) {
        for (int side = head[u]; side != 0; side = _map[side].next) {
            int v = _map[side].to;
            if (color[u] != color[v]) return false;
        }
    }
    return true;
}

int main(int argc, char const *argv[]) {
    scanf("%d%d", &n, &m);
    for (register int i = 1; i <= m; i++) {
        scanf("%d%d", &a, &b);
        add(a, b);
    }
    for (register int u = 1; u <= n; u++) {
        if (dfn[u] == 0) tarjan(u);
    }
    int result = 0;
    for (register int i = 1; i <= sig; i++) {
        if (isZero(i)) {
            if (result != 0) {
                printf("0\n");
                return 0;
            }
            result = sigMap[i].size();
        }
    }
    printf("%d\n", result);
    return 0;
}