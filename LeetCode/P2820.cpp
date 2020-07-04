#include <algorithm>
#include <cstdio>
#include <iostream>

using namespace std;

int n, m, father[1001];

struct side {
    int from, to, val;
} sides[1001];

int find(int node) {
    if (father[node] == node) return node;
    return father[node] = find(father[node]);
}

bool findAndMerge(int x, int y) {
    int xFather = find(x);
    int yFather = find(y);
    if (xFather == yFather) return false;
    father[xFather] = yFather;
    return true;
}

bool cmp(side a, side b) { return a.val < b.val; }

int kruskal() {
    sort(sides + 1, sides + m + 1, cmp);
    for (int i = 1; i <= n; ++i) father[i] = i;
    int result = 0;
    for (int i = 1; i <= m; ++i) {
        if (findAndMerge(sides[i].from, sides[i].to)) continue;
        result += sides[i].val;
    }
    return result;
}

int main() {
    scanf("%d%d", &n, &m);
    for (int i = 1; i <= n; ++i) father[i] = i;
    for (int i = 1; i <= m; ++i)
        scanf("%d%d%d", &sides[i].from, &sides[i].to, &sides[i].val);
    printf("%d", kruskal());
    return 0;
}
