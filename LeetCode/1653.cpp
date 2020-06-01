class Solution
{
public:
    vector<vector<int>> findContinuousSequence(int target)
    {
        vector<vector<int>> res;
        int i = 1;
        while (target > 0)
        {
            target -= i++;
            if (target > 0 && target % i == 0)
            {
                vector<int> tmp;
                for (int j = 0; j < i; j++)
                    tmp.push_back(target / i + j);
                res.push_back(tmp);
            }
        }
        reverse(res.begin(), res.end());
        return res;
    }

    vector<vector<int>> findContinuousSequence2(int target)
    {
        int t = sqrt(target * 2) + 1;
        vector<vector<int>> res;
        for (int len = t; len >= 2; --len)
        {
            if ((target * 2) % len == 0)
            { //第一个减枝
                int tmp = target * 2 / len - len + 1;
                if (tmp > 0 && tmp % 2 == 0)
                {                    // 第二个减枝
                    int a = tmp / 2; // a为首项
                    vector<int> cur;
                    for (int i = 0; i < len; ++i)
                    {
                        cur.push_back(i + a);
                    }
                    res.push_back(cur);
                }
            }
        }
        return res;
    }
};