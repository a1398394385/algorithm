#include <bits/stdc++.h>

class Solution
{
public:
    Solution()
    {
        memset(cnt, 0, sizeof(cnt));
    }

    void Insert(char ch)
    {
        ++cnt[ch - '\0'];
        if (cnt[ch - '\0'] == 1)
            data.push(ch);
    }

    char FirstAppearingOnce()
    {
        while (!data.empty() && cnt[data.front()] >= 2)
            data.pop();
        if (data.empty())
            return '#';
        return data.front();
    }

private:
    queue<char> data;
    unsigned cnt[128];
};
