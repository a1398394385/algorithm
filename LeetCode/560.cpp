#include <bits/stdc++.h>

class Solution
{
public:
    int subarraySum(vector<int> &nums, int k)
    {
        vector<int> cul(nums.size() + 1, 0);
        int res = 0;
        for (int i = 1; i <= nums.size(); ++i)
            cul[i] = cul[i - 1] + nums[i - 1];
        for (int i = 0; i < cul.size(); ++i)
            for (int j = i + 1; j < cul.size(); ++j)
                res += cul[j] - cul[i] == k;
        return res;
    }

    int subarraySum1(vector<int> &nums, int k)
    {
        int size = nums.size(), res = 0;
        for (int i = 0; i < size; ++i)
        {
            int sum = 0;
            for (int j = i; j < size; ++j)
            {
                sum += nums[j];
                res += sum == k ? 1 : 0;
            }
        }
        return res;
    }

    int subarraySum2(vector<int> &nums, int k)
    {
        int sum = 0, res = 0;
        unordered_map<int, int> cul;
        cul[0] = 1;
        for (auto &m : nums)
        {
            sum += m;
            res += cul[sum - k];
            ++cul[sum];
        }
        return res;
    }
};