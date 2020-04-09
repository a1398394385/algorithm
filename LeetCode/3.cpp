#include <bits/stdc++.h>
using namespace std;

class Solution
{
public:
    int lengthOfLongestSubstring(string s)
    {
        int result = 0, p1 = 0, p2 = 0, map[256] = {0};
        memset(map, -1, sizeof(map));
        for (; p2 < s.length(); p2++)
        {
            result = max(result, p2 - p1);
            p1 = map[s[p2]] >= p1 ? map[s[p2]] + 1 : p1;
            map[s[p2]] = p2;
        }
        return max(result, p2 - p1);
    }
};
