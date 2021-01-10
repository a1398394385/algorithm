#include <bits/stdc++.h>
using namespace std;
#define MAX 50005

int n, m, a, b, sig = 0, curr = 0, top = -1, result = 0;
int dfn[MAX], low[MAX], flag[MAX], color[MAX];
vector<int> _map[MAX], sigMap[MAX];
stack<int> _stack;

void tarjan(int u) {
    flag[u] = 1;
    _stack.push(u);
    dfn[u] = low[u] = curr++;
    for (int v : _map[u]) {
        if (flag[v] == 0) tarjan(v);
        if (flag[v] == 1) low[u] = min(low[v], low[u]);
    }
    if (low[u] == dfn[u]) {
        sig++;
        do {
            top = _stack.top();
            color[top] = sig;
            flag[top] = -1;
            sigMap[sig].push_back(top);
            _stack.pop();
        } while (top != u);
    }
}

bool isZero(int sig) {
    for (int u : sigMap[sig]) {
        for (int v : _map[u]) {
            if (color[u] != color[v]) {
                return false;
            }
        }
    }
    return true;
}

int main() {
    scanf("%d%d", &n, &m);
    while (m--) {
        scanf("%d%d", &a, &b);
        _map[a].push_back(b);
    }
    for (register int i = 1; i <= n; i++) {
        if (flag[i] == 0) tarjan(i);
    }
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