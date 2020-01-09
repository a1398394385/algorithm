#include <bits/stdc++.h>

using namespace std;

struct TreeNode
{
    int val;
    struct TreeNode *left;
    struct TreeNode *right;
    TreeNode(int x) : val(x), left(NULL), right(NULL) {}
};

class LongestPath
{
public:
    int maxLen = 0;

    int getPath(TreeNode *root)
    {
        if (root == NULL)
            return 0;

        int temp, left = 0, right = 0;
        if (root->left != NULL)
        {
            temp = getPath(root->left);
            if (root->val == root->left->val)
                left = temp;
        }
        if (root->right != NULL)
        {
            temp = getPath(root->right);
            if (root->val == root->right->val)
                right = temp;
        }

        maxLen = max(maxLen, (left + right + 1));
        return max(left, right) + 1;
    }

    int findPath(TreeNode *root)
    {
        if (root == NULL)
            return 0;
        getPath(root);
        return maxLen;
    }
};
