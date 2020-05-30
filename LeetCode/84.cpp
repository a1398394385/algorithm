#include <bits/stdc++.h>
using namespace std;

class Solution
{
public:
    //这个题更最大的盛水面积有点像，必须思考的是最大的面积究竟是在什么集合当中
    //1.显然，最大面积一定产生于以当前柱子为最大高度所能覆盖的面积集合中
    //2.其次要思考面积的计算，即等于当前柱子的高度*覆盖的宽度，覆盖的宽度等于其左右第一个小于其高度的柱子的下标之差
    //3.实现方式，因为需要考虑的只有三个柱子，即当前，左边比当前高度小的第一个柱子，右边比当前高度小的第一个柱子
    //因此可以用单调栈的数据结构来实现，即大于栈顶的高度入栈，小于栈顶高度出栈，并计算当前高度的面积，此时三个
    //柱子分别是栈顶高度，紧邻栈顶的高度，以及遍历的当前高度
    //时间复杂度O(n),空间复杂度O(n)
    int largestRectangleArea(vector<int> &heights)
    {
        heights.push_back(0); //保证右边界为最后一个柱子时，方便计算
        stack<int> S;
        int maxarea(0);
        for (int i = 0; i < heights.size(); i++)
        {
            while (!S.empty() && heights[i] < heights[S.top()])
            {
                int curheight = S.top();
                S.pop();
                //判断一下如果栈顶柱子为空，则令栈顶元素为0
                int area = heights[curheight] * (!S.empty() ? (i - S.top() - 1) : i);
                maxarea = max(maxarea, area);
            }
            S.push(i);
        }
        return maxarea;
    }
};