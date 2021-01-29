#include <bits/stdc++.h>
using namespace std;
int pre[1005];
int n, m, k, xPre, yPre;
struct line {
    int x, y, l;
} lines[10005];

bool comp(line a, line b) { return a.l < b.l; }

int find(int root) {
    if (pre[root] == root) return root;
    return pre[root] = find(pre[root]);
}

int main() {
    scanf("%d%d%d", &n, &m, &k);
    if (n < k || n - m > k) {
        printf("No Answer\n");
        return 0;
    }
    for (int i = 1; i <= n; i++) pre[i] = i;
    for (int i = 0; i < m; i++) {
        scanf("%d%d%d", &lines[i].x, &lines[i].y, &lines[i].l);
    }
    sort(lines, lines + m, comp);
    int result = 0, temp = n;
    for (int i = 0; i < m && temp > k; i++) {
        xPre = find(lines[i].x), yPre = find(lines[i].y);
        if (xPre == yPre) continue;
        temp--;
        pre[xPre] = yPre;
        result += lines[i].l;
    }
    printf("%d", result);
    return 0;
}