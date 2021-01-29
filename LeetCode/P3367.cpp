#include <cstdio>
#include <iostream>
using namespace std;
int pre[10005];
int n, m, z, x, y, xPrev, yPrev;

int find(int root) {
    if (pre[root] == root) return root;
    return pre[root] = find(pre[root]);
}

int main() {
    scanf("%d%d", &n, &m);
    for (int i = 1; i <= n; i++) pre[i] = i;
    while (m--) {
        scanf("%d%d%d", &z, &x, &y);
        xPrev = find(x);
        yPrev = find(y);
        if (z == 1) {
            pre[xPrev] = yPrev;
        } else {
            if (xPrev != yPrev) {
                printf("N\n");
            } else {
                printf("Y\n");
            }
        }
    }

    return 0;
}