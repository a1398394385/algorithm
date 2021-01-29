#include <cstdio>
#include <iostream>
using namespace std;
int pre[1010];

int find(int root) {
    int son, tmp;
    son = root;
    while (root != pre[root]) root = pre[root];
    while (son != root) {
        tmp = pre[son];
        pre[son] = root;
        son = tmp;
    }
    return root;
}

int find1(int root) {
    if (pre[root] == root) return root;
    return pre[root] = find1(pre[root]);
}

int main() {
    int n, m;
    while (scanf("%d%d", &n, &m) && n) {
        for (int i = 1; i <= n; i++) pre[i] = i;
        int x, y, xPrev, yPrev;
        int road = n - 1;
        while (m--) {
            scanf("%d%d", &x, &y);
            xPrev = find(x);
            yPrev = find(y);
            if (xPrev != yPrev) {
                pre[xPrev] = yPrev;
                road--;
            }
        }
        printf("%d\n", road);
    }

    return 0;
}