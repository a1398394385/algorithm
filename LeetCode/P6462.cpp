#include <bits/stdc++.h>

using namespace std;

#define NO              \
    {                   \
        printf("No\n"); \
        continue;       \
    }
#define YES              \
    {                    \
        printf("Yes\n"); \
        continue;        \
    }

int main() {
    long long h, x, y, t;
    cin >> t;
    while (t--) {
        scanf("%ld%ld%ld", &h, &x, &y);
        if (y >= h) YES;
        if (x >= h) NO;
        if (y == 0) NO;
        if (x == 0) YES;
        long long ti = h / x + 1;
        h = h % x;
        if (h == 0) h = x;
        if ((ti)*y >= h)
            YES;
        else
            NO;
    }
}

#include <bits/stdc++.h>

using namespace std;

int main() {
    long long h, x, y, t;
    cin >> t;
    while (t--) {
        scanf("%ld%ld%ld", &h, &x, &y);
        if (y >= h || x <= 0)
            printf("Yes\n");
        else if (h <= x || y <= 0)
            printf("No\n");
        else {
            long long num = h / x + 1;
            long long remainder = h % x;
            if (remainder == 0) remainder = x;
            if (num * y > remainder)
                printf("Yes\n");
            else
                printf("No\n");
        }
    }
    return 0;
}