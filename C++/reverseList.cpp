#include <iostream>
using namespace std;
// 只需要完成逆置链表函数
struct ListNode
{
    int val;
    struct ListNode *next;
    ListNode(int x) : val(x), next(NULL)
    {
    }
};

class Solution
{
public:
    ListNode *ReverseList(ListNode *pHead)
    {
        if (pHead == NULL || pHead->next == NULL)
            return pHead;
        ListNode *pReverseNode = ReverseList(pHead->next);
        pHead->next->next = pHead;
        pHead->next = NULL;

        return pReverseNode;
    }
};
